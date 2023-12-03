A partir del comando `find`, podemos buscar todos los archivos que cumplan con
las propiedades dadas. El `!` implica que debemos negar la siguiente condición,
y con `-exec` indicamos que queremos correr el comando `file` con cada archivo
de la salida

```bash
$ find -type f -size 1033c ! -executable -exec file '{}' \;
./inhere/maybehere07/.file2: ASCII text, with very long lines (1000)
```

Luego lo leemos normalmente

```bash
cat ./inhere/maybehere07/.file2
P4L4vucdmLnm8I7Vl7jG1ApGSfjYKqJU
```

