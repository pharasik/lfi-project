# Cos

Uruchomienie złośliwego modułu wykonuje wstrzyknięty kod. Ten kod właściwie może wykonać dowolną akcję na serwerze ofiary. Mimo, że skrypt interpretowany jest przez PHP, to można próbować z niego wyjść.

W przykładowym złośliwym kodzie zaproponowaliśmy wykonanie komend powłoki, a stąd można próbować eskalować swoje uprawnienia.

Przykłądową komendą jaką można wykonać jest sprawdzenie logów:

```sh
cat ../../../../etc/logs
```

Można też próbować otworzyć odwróconą powłokę.