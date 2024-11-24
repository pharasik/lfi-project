# Jaki jest tego powód? [MECHANIKA]

Od wersji PHP 8.1.0 dostępna jest funkcjonalność odczytywania pełnej ścieżki wysłanego pliku za pomocą $_FILES[$filename]['full_path']

https://www.php.net/manual/en/features.file-upload.post-method.php

Jest to niebezpieczne pole zmiennej globalnej $\_FILES, ponieważ można wysłać spreparowaną ścieżkę. Nie zaleca się, więc korzystanie z niego.

Fragment kodu, który jest odpowiedzilny za takie zachowanie:

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

Jak widać "uploads/" jest konkatenowane z niebezpiecznym polem "full_path", bez żadnego filtrowania. Ktoś mógłby zastanowić się, czy pole "tmp_name" też nie powinno podlegać filtrowaniu. Akurat wartość tej zmiennej, generowana jest przez PHP. Jest to ścieżka do wysłanego pliku, który tymczasowo jest przechowywany po stronie serwera, więc nie ma takiej potrzeby.

# Jak zapobiec?

Najlepiej korzystać z pola 'name', ponieważ nie zawiera ono informacji o ścieżkach. Jednak, dodatkowo dla pewności, należy użyć funkcji basename().
