# Wykonanie [ROZWIĄZANIE]

## Metoda SQLi

Nie rozwodząc się za bardzo...

## PhpMyAdmin

Zalogować się do panelu (localhost:8081) \
Należy rozwinąć bazę danych **baim_db** \
Wybrać tabelę **modules**

![Widok phpmyadmin](images/phpmyadmin.png)

Przyciskiem na górze przejść do zakładki **Insert**

![Przycisk insert](images/insert.png)

Wpisać następujące wartości (nie trzeba id) i kliknąć GO

![Widok insert modules](images/modules.png)

Następnie przejść do tabeli **permissions** i dodać dla użytkownika **baim** dostęp do modułu o id=2

![Widok insert permissions](images/permissions.png)

Tabele powinny wyglądać tak:

![Modules](images/modules1.png)
![Permissions](images/permissions1.png)

Po odświeżeniu panelu testowanej aplikacji (localhost:8080), powinien pojawić się moduł o nazwie **evil**
