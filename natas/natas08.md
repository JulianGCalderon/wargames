Si inspeccionamos el HTML, notamos un formulario, similar al del nivel 6. Si
accedemos al código fuente, notamos:

```php
<?

$encodedSecret = "3d3d516343746d4d6d6c315669563362";

function encodeSecret($secret) {
    return bin2hex(strrev(base64_encode($secret)));
}

if(array_key_exists("submit", $_POST)) {
    if(encodeSecret($_POST['secret']) == $encodedSecret) {
    print "Access granted. The password for natas9 is <censored>";
    } else {
    print "Wrong secret";
    }
}
?>
```

Tras aplicar una codificación en base64, invertir el string, y convertir a
hexadecimal, entonces nuestra contraseña debe ser igual a 3d3d516343746d4d6d6c315669563362.

Debemos hacer el camino inverso, comenzando por una conversión a string a partir
de un hexadecimal, invirtiendo el string, y luego decodificarlo en base64.

```bash
$ echo 3d3d516343746d4d6d6c315669563362 | xxd -r -p | rev | base64 -d
oubWYf2kBq
```

Al insertar la contraseña en el formulario, obtenemos la contraseña para el
siguiente nivel

```html
Access granted. The password for natas9 is Sda6t0vkOPkM8YeOZkAGVhFoaplvlJFd
```
