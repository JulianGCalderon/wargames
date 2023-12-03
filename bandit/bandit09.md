Con el comando `strings` hayamos las cadenas de texto que tienen caracteres
legibles, y luego filtramos por aquellas que comiencen por al menos de signos de
igual `=`

```bash
strings data.txt | grep ^==
========== passwordk^
========== is
========== G7w8LIi6J3kTb8A7j9LgrywtEUlyyp6s
```

Podemos quedarnos solamente con el ultimo resultado, con 

```bash
$ strings data.txt | grep ^== | tail -1
========== G7w8LIi6J3kTb8A7j9LgrywtEUlyyp6s
```
