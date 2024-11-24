# Dlaczego tak się da?

## SQLi

Omówmy to w telegraficznym skrócie, dlaczego tak się dzieje. Jeśli jesteś chętny(-a) poznać więcej o tym temacie, to odsyłamy Ciebie do prezentacji projektu o SQLi. Ewentualnie możemy wyjaśnić po prezentacji.

Winne jest pozwolenie na wykonanie wielu poleceń SQL i pełne zaufanie do tego co wprowadza użytkownik.

## Relacja bazy danych

Tak jak zostało to napisane w [podpowiedzi](3_1_hint.md) istnieją 3 tabele.

Obsługa logiki modułów wygląda w następujący sposób:

1. Zapytaj bazę danych jakie moduły można wyświetlić użytkownikowi

W module głównym wywoływana jest funkcja odpowiedzialna za wyświetlenie menu nawigacyjnego.

```php
// lib/modules/main.php
// line 2
function renderModule($db) {
  echo "<ul>";
  echo makeNav($db);
  echo "</ul>";
}
```

Ciało tej funkcji prezentuje się następująco:

```php
// lib/utils.php
// line 36
function makeNav($db) {
  $query = "SELECT path, name FROM permissions INNER JOIN modules ON permissions.module_id = modules.id WHERE permissions.user_id = ".getLoggedUserId();
  $html = "";
  if ($result = $db->query($query)) {
    foreach ($result as $row) {
      $html .= "<li><a href='?module=".$row["path"]."'>".$row["name"]."</a></li>";
    }
    $result->free_result();
  }
  $html .= "<li><a href='?module=logout'>Wyloguj</a></li>";
  return $html;
}
```

Wykonywane jest zapytanie o ścieżkę do modułu oraz jego nazwę. Dokonywane jest złącznie tych dwóch tabel w oparciu o id zalogowanego użytkownika.

```php
$query = "SELECT path, name FROM permissions INNER JOIN modules ON permissions.module_id = modules.id WHERE permissions.user_id = ".getLoggedUserId();
// ...
  if ($result = $db->query($query)) {
```

2. Wyświetl te moduły

Następnie dla każdej pary informacji o module (ścieżka, nazwa) dostępnym dla użytkownika generowana jest lista z odnośnikiem:

```php
foreach ($result as $row) {
  $html .= "<li><a href='?module=".$row["path"]."'>".$row["name"]."</a></li>";
}
```

3. Gdy użytkownik wybierze jakiś moduł, sprawdź czy faktycznie, to o co prosi może zostać mu wyświetlone

Tutaj musimy się przenieść do pliku index.php

```php
// index.php
// line 12
if (isUserLogged()) {
  $module = "main.php";
  if (!empty($_GET["module"]))
    $module = authorizeModuleAccess($db, $_GET["module"]);
} else {
  $module = "login.php";
}
```

Powyższy kod dla nie zalogowanego użytkownika wyświetli panel logowania, a dla zalogowanego:

- moduł główny, gdy o nic nie prosi;
- moduł, który wskaże.

```php
// lib/utils.php
// line 14
function authorizeModuleAccess($db, $requestedModule) {
  if ($requestedModule === "logout") {
    return "logout.php";
  }

  $module = "main.php";

  $query = "SELECT path, name FROM permissions INNER JOIN modules ON permissions.module_id = modules.id WHERE permissions.user_id = ".getLoggedUserId();
  if ($result = $db->query($query)) {
    foreach ($result as $row) {
      if ($row["path"] === $requestedModule) {
        $module = $requestedModule.".php";
        break;
      }
    }
    $result->free_result();
  }
  return $module;
}
```

Dostęp do wskazanego modułu, może być przyznany tylko, gdy są udzielone odpowienie uprawnienia. Wyżej znajduje się identyczne zapytanie jak to, które było wykorzystane do generowania panelu nawigacyjnego. Różnicą jest tylko to co dzieje się z uzyskanymi danymi:

```php
// lib/utils.php
// line 14
foreach ($result as $row) {
  if ($row["path"] === $requestedModule) {
    $module = $requestedModule.".php";
    break;
  }
}
// ...
return $module;
```

są one porównywane z żądanym zasobem. I gdy ten znajdzie się na liście autoryzowanych modułów, to do pliku index.php zwracana jest ścieżka do żądanego modułu poszerzona o rozszerzenie ".php".

## Gdzie jest błąd i jak go uniknąć?

Tak jak było to wspomniane w [kroku 1.](1_mechanics.md#jak-temu-zaradzić) błędem jest brak filtrowania danych. Akurat w naszym wypadku tymi danymi są ścieżki, więc w celu zabezpieczenia ich możemy wykorzystać polecenie basename(), które usuwa niechciane znaki ze ścieżek. Poprawny kod wyglądałby tak:

```php
foreach ($result as $row) {
  if ($row["path"] === $requestedModule) {
    $module = basename($requestedModule).".php";
    break;
  }
}
// ...
return $module;
```

## Czy w tej konkatenacji błędem jest użycie $requestedModule pochodzącego od użytkownika?

Ciężko ocenić... Mogłoby się wydawać, że żądana ścieżka przecież będzie taka sama zarówno w bazie jak i zmiennej. Jednak może się okazać, że jakaś wyrafinowana metoda ataku, będzie w stanie tę linijke nadużyć, a w przypadku danych pochodzących z bazy istnieje możliwość, że zostały one przygotowane na taką możliwość. Więc mimo wszystko wychodząc z założenia, że nie warto ufać użytkownikowi, powinniśmy poprawić kod w następujący sposób:

```php
  $module = basename($row["path"]).".php";
```
