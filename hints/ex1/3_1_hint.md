# Jak wygląda struktura bazy danych? [PODPOWIEDŹ]

Na bazę danych aplikacji składają się 3 tabele:

- users - tabela zawierająca podstawowe informacje o użytkowniku,
- modules - tabela zawierająca informacje o module,
- permissions - tabela wiążąca użytkowników z modułami (uprawnia do otworzenia modułu).

W pierwszych dwóch tabelach kluczem jest kolumna id. Tabela permissions nie posiada własnego klucza, ale odnosi się do kluczy tabel users i modules.
