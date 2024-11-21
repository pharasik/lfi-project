# Dlaczego tak się da? [MECHANIKA]

Powodem, dla którego możliwym jest wysłanie dowolnego pliku jest nieodpowiednie dobranie funkcji sprawdzającej rozszerzenie pliku.

```php
// lib/module/upload.php
// line 2
function checkFile($file, $dstPath) {
  $uploadOk = true;

  if (file_exists($dstPath)) {
    $uploadOk = false;
  }

  if ($file["size"] > 200000) {
    $uploadOk = false;
  }

  if (!str_contains($dstPath, ".pdf")) {
    $uploadOk = false;
  }

  return $uploadOk;
}
```

Wykorzystana w tym kodzie funkcja to str_contains(), która sprawdza czy podany ciąg znaków zawiera szukany ciąg. Jest to oczywiście błąd, który pozwala na oszukanie sprawdzania poprzez opakowania ciągu ".pdf" dowolnym prefixem (nazwą) i sufixem (rzeczywistym rozszerzeniem pliku).

Prawidłowa obsługa oprócz tego, że powinna sprawdzać cechy charakterystyczne dla danego rozszerzenia (np. magic number), to przede wszystkim powinna sprawdzać rozszerzenie dedykowaną funkcją pathinfo($name, PATHINFO_EXTENSION)

Ta funkcja zwraca rozszerzenie pliku - w tym kodzie prezentowałaby się ona tak:

```php
// ...
$extension = strtolower(pathinfo($dstPath, PATHINFO_EXTENSION))
if ($extension != ".pdf") {
  $uploadOk = false;
}

return $uploadOk;
```

W zadaniu 2 zostanie poruszony problem manipulacji nazwą pliku, ale już stricte z zamysłem wykonania ataku path traversal.
