# Wykonanie

Formularz przyjmuje pliki .pdf. Załóżmy, że implementacja sprawdzania jest niepoprawna. Jaki byłby najprostszy błąd?

Sprawdzanie czy dany ciąg zawiera w sobie frazę ".pdf"! To oznacza że plik może nazywać się dowolnie, ważne by znajdował się tam szukany ciąg.

Chcemy wykonać atak przy pomocy kodu php. Na ogół rozszerzenie .php nie jest wymagane do załączania pliku w PHP, ale nasza aplikacja przyjmuje tylko takie pliki (z .php na samym końcu nazwy).

Przykładowa plik może nazywać się tak:

```
evil.pdf.php
```
