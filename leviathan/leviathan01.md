Encontramos un archivo ejecutable en el directorio de usuario llamado `check`. Si lo
ejecutamos con `ltrace`, podemos ver que llamadas a bibliotecas se realizaron

```bash
$ ltrace ./check
...
strcmp("pas", "sex")
...
```

Luego, vemos que la contraseña es `sex`. Al ejecutar nuevamente el programa, la
contraseña nos abrira una `shell` como usuario leviathan2, la que podemos
utilizar para obtener su contraseña

```bash
$ cat /etc/leviathan_pass/leviathan2
mEh5PNl10e
```
