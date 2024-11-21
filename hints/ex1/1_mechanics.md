# Struktura aplikacji [MECHANIKA]

## Moduły

Aplikacja została zaprojektowana z zamysłem rozszerzania jej funkcjonalności modułami. Moduły te są niczym innym jak plikami .php z bardzo ważną (bo zawsze wywoływaną) funkcją renderModule().

## Autoryzacja

Taki moduł jest zaciągany do index.php poprzez dyrektywę require, ale zanim zostanie dołączony, to musi on przejść przez proces autoryzacji. Sprawdzane jest z bazą danych, czy użytkownik jest podpięty pod żądany moduł, jeśli tak to moduł taki jest wczytywany.

Ważna uwaga! W bazie danych przechowywana jest informacja o nazwie pliku odpowiedzialnego za dany moduł (tak przynajmniej planował autor), ale w rzeczywistości to pojęcie jest rozszerzone, bo tak naprawdę zapisana jest ścieżka do pliku (będąc dokładnym - jej fragment).

Wynika to z tej linii:

```php
// index.php
// line 20
require "lib/modules/".$module;
```

Oraz tych linii:

```php
// lib/utils.php
// line 25
if ($row["path"] === $requestedModule) {
  $module = $requestedModule.".php";
  break;
}
```

Dla aplikacji baza danych jest zaufanym zasobem, dlatego nie dochodzi do żadnego filtrowania, ponieważ wartości w tabeli modules zostały raczej dodane przez administratora/programistę (tak przynajmniej może się wydawać).

Z racji tego, że dodajemy ściężkę z poziomu systemu operacyjnego (?????), to możemy dołączyć tak naprawdę każdy plik... zakończony jako .php. Więc /etc/passwd niestety odpada. Oczywiście byłaby taka możliwość, gdyby fragment kodu z lib/utils.php nie konkatenował na koniec rozszerzenia ".php".

# Jak temu zaradzić?

Pierwsze co przychodzi na myśl to sanityzować (filtrować) na wszelki wypadek dane z bazy danych. To rozsądne podejście dla aplikacji wielomodułowej.

Jeśli to możliwe, to lepiej zrezygnować z wyselekcjonowanego przypisywania użytkownikom uprawnień do modułów na rzecz systemu ról. Wtedy moduły i ich ścieżki można zhardcode'ować w kodzie strony i poprzez odpytanie bazy danych odpowiednio mapować zwróconą rolę użytkownika na zestawy modułów i odpowiadających im ścieżek do plików.
