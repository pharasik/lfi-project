# Wykonanie

Formularz przyjmuje pliki .pdf. Jak pewnie się domyśliłeś(-aś) sprawdzania rozszerzenia zostało zaimplementowane niepoprawnie. Jaki byłby najprostszy błąd implementacji takiego mechanizmu?

Otóż najprościej jest użyć złej funkcji np. sprawdzającej, czy dany ciąg zawiera w sobie frazę ".pdf". To oznacza, że plik może się nazywać dowolnie, ważne by znajdował się tam szukany ciąg ".pdf".

Z polecenia wiemy, że wysyłamy kod PHP (na marginesie, nie musi to być kod PHP, może to być plaintext, html, a nawet javascript - wynika to z tego, że .php rozszerza .html). Na ogół rozszerzenie nie jest wymagane do załączania pliku w PHP, ale nasza aplikacja załącza tylko pliki zakończone ".php".

Przykładowy plik, który obejdzie zabezpieczenie może nazywać się tak:

```
evil.pdf.php
```
