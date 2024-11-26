# Konsekwencje ataku [MECHANIKA]

Uruchomienie złośliwego modułu wykonuje wstrzyknięty kod. Ten kod właściwie może wykonać dowolną akcję na serwerze ofiary. Mimo, że skrypt interpretowany jest przez PHP, to można próbować odwołać się do innych języków.

W przykładowym złośliwym kodzie, zaproponowaliśmy wykonanie skryptów powłoki, a takim sposobem można próbować eskalować swoje uprawnienia.

Przykładową komendą, jaką można wykonać jest sprawdzenie logów:

```sh
cat ../../../var/log/apt/history.log
```

Można też próbować utworzyć odwróconą powłokę, czy też wysłać dodatkowy plik napisany w np. Bashu lub dowolnym innym języku i uruchomić go złośliwym modułem.

# Jak zapobiec?

Sęk w tym, że niepoprawnie skonfigurowane konto serwera www, może pozwolić na przemieszczanie się po całym systemie plików. Dobrą praktyką jest uwięzienie takiego użytkownika w folderze roboczym aplikacji. Można to wykonać komendą **chroot** lub za pomocą specjalnie do tego przeznaczonych aplikacji.
