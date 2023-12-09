Si inspeccionamos el HTML, vemos que hay un formulario. Al momento de enviarlo
con una contraseña arbitraria, nos devuelve que la contraseña es incorrecta.

Si vemos el codigo fuente, encontramos el siguiente código:

```php
<?
include "includes/secret.inc";

    if(array_key_exists("submit", $_POST)) {
        if($secret == $_POST['secret']) {
        print "Access granted. The password for natas7 is <censored>";
    } else {
        print "Wrong secret";
    }
    }
?>
```

Vemos que refiere a un archivo `includes/secret.inc`. Accedemos a este archivo y
asi obtendremos la contraseña para el formulario

```php
<?
$secret = "FOEIUWGHFEEUHOFUOIU";
?>
```

Insertamos esta contraseña en el fomrulario y asi obtendremos la contraseña para
el siguiente nivel:

```html
Access granted. The password for natas7 is jmxSiH3SP6Sonf8dv66ng8v1cIEdjXWr
```
