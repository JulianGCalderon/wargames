Notamos que hay un archivo ejecutable en la carpeta de usuario `leviathan5` 

```bash
$ ./leviathan6
usage: ./leviathan6 <4 digit code>
```

Ni `strings` ni `ltrace` parece darnos información, por lo que podriamos hacerlo
con fuerza bruta, aunque utilizaremos otra solución que involucra un poco de
ingeniería inversa, utilizando el debugger `gdb`.

```bash
$ gdb leviathan6
(gdb) start 0000
(gdb) disassemble main
...
...
0x08049222 <+76>:    call   0x80490b0 <atoi@plt>
0x08049227 <+81>:    add    $0x10,%esp
0x0804922a <+84>:    cmp    %eax,-0xc(%ebp)
0x0804922d <+87>:    jne    0x804925a <main+132>
0x0804922f <+89>:    call   0x8049060 <geteuid@plt>
...
...
```

Notamos que luego de la llamada a `atoi`, compara el contenido del registro
`%eax` con `%ebp`. Si son distintos, sale. Podemos saltarnos esta parte,
saltando directamente a la dirección luego de la comparación. Una vez obtenida
la shell, podemos obtener la contraseña del siguiente nivel

```bash
(gdb) j 0x0804922f
$ cat /etc/leviathan_pass/leviathan7
8GpZ5f8Hze
```

Si en su lugar queremos obtener la contraseña, podemos directamente leer el
valor por el cual se compara. Con el comando `break` podemos colocar un
breakpont justo en la comparación. Con el comando `continue` avanzamos hasta
dicho breakpoint. Con el comando `info register` podemos
obtener información de los registroes en el comento

```bash
(gdb) break *0x0804922a
Breakpoint 2 at 0x804922a
(gdb) continue
Continuing.

Breakpoint 2, 0x0804922a in main ()
(gdb) info registers
eax            0x0                 0
ecx            0x0                 0
edx            0xffffd65d          -10659
ebx            0xf7e2a000          -136142848
esp            0xffffd3e0          0xffffd3e0
ebp            0xffffd3f8          0xffffd3f8
```

Vemos que `%eax` contiene nuestra entrada, mientras que `%ebp` contiene
información sobre como llegar a la clave. Tal como se indica en el codigo
assembly, la dirección de la contraseña esta en `%ebp-0xc`

```bash
(gdb) print $ebp-0xc
$1 = (void *) 0xffffd3ec
(gdb) print *0xffffd3ec
$2 = 7123
```

Una vez tenemos la contraseña, podemos volver a ejecutar la aplicación para
obtener un shell

```bash
$ ./leviathan 7123
$ cat /etc/leviathan_pass/leviathan7
8GpZ5f8Hze
```
