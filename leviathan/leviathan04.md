Notamos que hay un archivo ejecutable en la careta `.trash` que devuelve un
valor en binario. 

```bash
$ .trash/bin
01000101 01001011 01001011 01101100 01010100 01000110 00110001 01011000 01110001 01110011 00001010
```

Ejecutamos con `ltrace`.

```bash
$ ltrace .trash/bin
__libc_start_main(0x80491a6, 1, 0xffffd4f4, 0 <unfinished ...>
fopen("/etc/leviathan_pass/leviathan5", "r")          = 0
+++ exited (status 255) +++
```

Vemos que lee el archivo de la contraseña, pero lo devuelve como un binario, por
lo que debemos convertirlo a utf8.

Para hacerlo, interamos cada byte del resultado del ejecutable, lo interpetamos
como binario con `$((2#$byte))`, y lo convertimos a hexadecimal con `printf
"%x"`. El resultado de esto tendrá formato de hexdump, por lo que se lo pasamos
a `xxd` para convertirlo devuelta al contenido original.

```bash
$ for byte in $(.trash/bin); do printf "%x" $((2#$byte)); done | xxd -r -p 
EKKlTF1Xqs
```

También puede realizarse con el interprete de `perl`.

```bash
$ .trash/bin | perl -ape '$_=pack"(B8)*", @F'
EKKlTF1Xqs
```
