# Zmienna $\_FILES [MECHANIKA]

## Wyjaśnienie dotyczące mechanizmu sesji

W PHP istnieje mechanizm sesji, który umożliwia przechowywanie danych związanych z użytkownikiem w czasie korzystania przez niego z aplikacji m.in: identyfikatorów, ról, komunikatów o błędach itp. Dla każdej sesji generowany jest unikalny identyfikator.
W naszej aplikacji sesja ustanawiana jest tuż po zażądaniu przez użytkownika dostępu do strony.

```php
// index.php
// line 1
<?php
  session_start();
  // ...
```

Do informacji sesyjnych można odwoływać się (tylko po stronie serwera) zmienną globalną $\_SESSION[parametr]. Na poziomie protokołu HTTP, identyfikator sesji (dla PHP) przechowywany jest w ciasteczku **PHPSESSID**. Stąd, po zalogowaniu, należało zebrać zawartość tego ciasteczka.

## Path traversal po całym systemie plików

Od wersji PHP 8.1.0 dostępna jest funkcjonalność odczytywania pełnej ścieżki wysłanego pliku za pomocą $_FILES[$filename]['full_path']

https://www.php.net/manual/en/features.file-upload.post-method.php

Jest to niebezpieczne pole zmiennej globalnej $\_FILES, ponieważ można wysłać spreparowaną ścieżkę. Nie zaleca się, więc korzystania z niego.

Fragment kodu, który jest odpowiedzialny za takie zachowanie:

```php
// lib/modules/upload.php
// line 21
if (isset($_POST["submit"])) {
  $dstPath = "uploads/".$_FILES["file"]["full_path"];
  if (checkFile($_FILES["file"], $dstPath)) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $dstPath)) {
      header("Location: index.php");
      exit();
    }
  }
}
```

Jak widać, **"uploads/"** jest konkatenowane z niebezpiecznym polem **"full_path"** bez żadnego filtrowania. Ktoś mógłby zastanowić się, czy pole **"tmp_name"** też nie powinno być filtrowane. Akurat wartość tej zmiennej generowana jest przez PHP. Jest to ścieżka do wysłanego pliku, który tymczasowo jest przechowywany po stronie serwera, więc nie ma takiej potrzeby.

# Jak zapobiec?

Najlepiej korzystać z pola 'name', ponieważ nie zawiera ono informacji o ścieżkach. Dodatkowo dla pewności, należy użyć funkcji basename().
