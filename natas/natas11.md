Si inspeccionamos el HTML, vemos que es similar al del nivel anterior.
Inspeccionamos el código fuente.

En primer lugar tenemos definiciones de los valores por
defecto

```php
$defaultdata = array( "showpassword"=>"no", "bgcolor"=>"#ffffff");
```

Luego se define una función que encripta una entrada, realizando XOR caracter a
caracter con una clave que se repite.

```php
function xor_encrypt($in) {
    $key = '<censored>';
    $text = $in;
    $outText = '';

    // Iterate through each character
    for($i=0;$i<strlen($text);$i++) {
    $outText .= $text[$i] ^ $key[$i % strlen($key)];
    }

    return $outText;
}
```

Luego se define una función que lee las cookies, desencripta la información, y
la devuelve. Si no hay cookies se devuelve un valor por defecto.

```php
function loadData($def) {
    global $_COOKIE;
    if(array_key_exists("data", $_COOKIE)) {
    $mydata = $def;
    $tempdata = json_decode(xor_encrypt(base64_decode($_COOKIE["data"])), true);
    if(is_array($tempdata) && array_key_exists("showpassword", $tempdata) && array_key_exists("bgcolor", $tempdata)) {
        if (preg_match('/^#(?:[a-f\d]{6})$/i', $tempdata['bgcolor'])) {
        $mydata['showpassword'] = $tempdata['showpassword'];
        $mydata['bgcolor'] = $tempdata['bgcolor'];
        }
    }
    }
    return $mydata;
}
```

Análogamente, esta función establece las cookies encriptandolas primero.

```php
function saveData($d) {
    setcookie("data", base64_encode(xor_encrypt(json_encode($d))));
}
```

El funcionamiento entonces de la pagina, es verificar el color enviado como
parámetro, y establecer las cookies encriptadas

```php
$data = loadData($defaultdata);

if(array_key_exists("bgcolor",$_REQUEST)) {
    if (preg_match('/^#(?:[a-f\d]{6})$/i', $_REQUEST['bgcolor'])) {
        $data['bgcolor'] = $_REQUEST['bgcolor'];
    }
}

saveData($data);
```

Finalmente, se decide si mostrar o no la contraseña dependiendo del valor de la
cookie...

```php
if($data["showpassword"] == "yes") {
    print "The password for natas12 is <censored><br>";
}
```

Definimos entonces una script que encuentre la clave de la encriptación. Nos
aprovecharemos de la propiedad de las operaciones de XOR, donde si A ⊕ B = C,
entonces A ⊕ C = B.

```php
function xor_encrypt($plain, $key)
{
    $cipher = '';

    for ($i = 0; $i < strlen($plain); $i++) {
        $cipher .= $plain[$i] ^ $key[$i % strlen($key)];
    }

    return $cipher;
}

$start = array("showpassword" => "no", "bgcolor" => "#ffffff");
$end = "MGw7JCQ5OC04PT8jOSpqdmkgJ25nbCorKCEkIzlscm5oKC4qLSgubjY%3D";

$json_start = json_encode($start);
$xord_end = base64_decode($end);

$key = xor_encrypt($json_start, $xord_end);

echo $key;
echo "\n";
```

Asi obtendremos la contraseña:

```bash
$ php crack-natas11.php 
KNHLKNHLKNHLKNHLKNHLKNHLKNHLKNHLKNHLKNHLK
```

Una vez tenemos la contraseña, podemos hacer otro script que se encargue de
encriptar las cookies que querramos enviar al servidor.

```php
function xor_encrypt($plain, $key)
{
    $cipher = '';

    for ($i = 0; $i < strlen($plain); $i++) {
        $cipher .= $plain[$i] ^ $key[$i % strlen($key)];
    }

    return $cipher;
}

$start = array("showpassword" => "yes", "bgcolor" => "#ffffff");
$key = "KNHL";

$json_start = json_encode($start);
$xor_json = xor_encrypt($json_start, $key);
$base64_xor = base64_encode($xor_json);

echo $base64_xor;
echo "\n";
```

Lo ejecutamos, y asi obtendremos las cookies encriptadas:

```bash
$ php encode-natas11.php
MGw7JCQ5OC04PT8jOSpqdmk3LT9pYmouLC0nICQ8anZpbS4qLSguKmkz
```

Establecemos las cookies y recargamos la página, asi obtendremos la información.

```txt
The password for natas12 is YWqo0pjpcXzSIl5NMAVxg12QxeC1w9QG
```
