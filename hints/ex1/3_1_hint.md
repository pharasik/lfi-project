# Jak wygląda struktura bazy danych? [PODPOWIEDŹ]

Na bazę danych aplikacji składają się 4 tabele, ale tak naprawdę 3 nas będą interesować:

- **users** - zawierająca podstawowe informacje o użytkownikach,
- **modules** - zawierająca informacje o modułach,
- **permissions** - wiążąca użytkowników z modułami (uprawnia do otworzenia modułu),
- login_logs - zawierająca dane o próbie logowania.

W pierwszych dwóch tabelach kluczem jest kolumna id. Tabela permissions nie posiada własnego klucza, ale odnosi się do kluczy tabel users i modules.
