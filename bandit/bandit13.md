Primero, debemos guardar la clave en nuestra computadora local. Ejecutamos
entonces en nuestra shell propia.

```bash
$ sshpass -p wbWdlBxEir4CaE8LaPhauuOo6pwRmrDw scp -P 2220 bandit13@bandit.labs.overthewire.org:sshkey.private bandit14.sshkey
```

Antes de usarla, debemos cambiarle los permisos

```bash
$ chmod 400 bandit14.sshkey
```

Con la opción `-i`, podemos indicarle a `ssh` que queremos utilizar una clave
privada para autenticarnos. 

```bash
$ ssh bandit14@bandit.labs.overthewire.org -p 2220 -i bandit14.sshkey
```

Una vez en el siguiente nivel, podemos leer la propia clave desde
la siguiente ubicación

```bash
$ cat /etc/bandit_pass/bandit14
fGrHPx402xGC7U7rXKDaxiWFTOiF0ENq
```

