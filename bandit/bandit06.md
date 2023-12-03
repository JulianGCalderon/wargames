Similar a el nivel anterior, podemos buscar por grupo y usuario. También podemos
redirigir la salida para de error para que no molesten los errores

```bash
$ find / -size 33c -group bandit6 -user bandit7 2> /dev/null
/var/lib/dpkg/info/bandit7.password
```

Luego lo leemos normalmente

```bash
$ cat /var/lib/dpkg/info/bandit7.password
z7WtoNQU2XfjmMtWA8u5rN4vzqu4v99S
```

