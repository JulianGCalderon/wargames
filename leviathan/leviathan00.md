Nos conectamos al primer nivel utilizando el bash script `sshleviathan`, que
utiliza internamente `sshpass` para conectarse al nivel

```bash
$ ./sshleviathan.sh 0 leviathan0
```

Inspeccionando la carpeta de usuario, notamos un archivo
`.backup/bookmarks.html`. Si buscamos por la palabra `password` dentro del
archivo, podremos encontrar la contraseña del siguiente nivel

```bash
$ cat bookmarks.html | grep password
... password for leviathan1 is PPIfmI1qsA ...
```
