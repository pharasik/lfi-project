# Jaki jest tego powód? [MECHANIKA]

Od wersji PHP 8.1.0 dostępna jest funkcjonalność odczytywania pełnej ścieżki wysłanego pliku za pomocą $_FILES[$filename]['full_path']

https://www.php.net/manual/en/features.file-upload.post-method.php

Jest to niebezpieczne pole zmiennej globalnej $\_FILES, ponieważ można wysłać spreparowaną ścieżkę. Nie zaleca wię więc korzystanie z niego.

# Jak zapobiec?

Najlepiej jest korzystać z pola 'name', ponieważ nie zawiera ono informacji o ścieżkach. Jednak dla pewności należy użyć dodatkowo funkcji basename().
