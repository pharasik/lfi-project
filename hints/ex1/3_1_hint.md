# Jak wygląda struktura bazy danych? [PODPOWIEDŹ]

Na bazę danych aplikacji składają się 3 tabele:

- users - zawierająca podstawowe informacje o użytkownikach,
- modules - zawierająca informacje o modułach,
- permissions - wiążąca użytkowników z modułami (uprawnia do otworzenia modułu).

W pierwszych dwóch tabelach kluczem jest kolumna id. Tabela permissions nie posiada własnego klucza, ale odnosi się do kluczy tabel users i modules.
