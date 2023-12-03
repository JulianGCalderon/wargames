Notamos que hay un archivo ejecutable en el directorio de usuario que espera una
contraseña. Ejecutamos `ltrace`.

```bash
$ ltrace ./level3
strcmp("h0no33", "kakaka")                              = -1
printf("Enter the password> ")                          = 20
fgets(Enter the password> mypass
"mypass\n", 256, 0xf7e2a620)                      = 0xffffd2ec
strcmp("mypass\n", "snlprintf\n")                       = -1
puts("bzzzzzzzzap. WRONG"bzzzzzzzzap. WRONG
)                              = 19
```

Vemos que la contraseña esperada es "snlprintf".

```bash
$ ./level3
Enter the password> snlprintf
[You've got shell]!
$ cat /etc/leviathan_pass/leviathan4
AgvropI4OA
```

Notemos que si ejecutamos con `ltrace`, se cambiarán los permisos y no podremos
leer la contraseña.

