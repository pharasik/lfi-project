# Cos

Uruchomienie złośliwego modułu wykonuje wstrzyknięty kod. Ten kod właściwie może wykonać dowolną akcję na serwerze ofiary. Mimo, że skrypt interpretowany jest przez PHP, to można próbować odwołać się do innych języków.

W przykładowym złośliwym kodzie zaproponowaliśmy wykonanie komend powłoki, a stąd można próbować eskalować swoje uprawnienia.

Przykładową komendą jaką można wykonać jest sprawdzenie logów:

```sh
cat ../../../../etc/logs
```

Można też próbować otworzyć odwróconą powłokę, czy wysłać dodatkowy plik napisany w np. Bashu i uruchomić go złośliwym modułem.

# Jak zapobiec?

Sęk w tym, że niepoprawnie skonfigurowane konto serwera www, może przemieszczać się po całym systemie plików. Dobrą praktyką jest uwięzienie takiego użytkownika w folderze roboczym aplikacji. Można to wykonać komendą **chroot**.
