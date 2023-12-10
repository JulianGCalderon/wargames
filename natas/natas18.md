En este nivel vemos un formulario para ingresar un usuario y contraseña.
Obtenemos el código fuente.

```php
$showform = true;
if(my_session_start()) {
    print_credentials();
    $showform = false;
} else {
    if(array_key_exists("username", $_REQUEST) && array_key_exists("password", $_REQUEST)) {
    session_id(createID($_REQUEST["username"]));
    session_start();
    $_SESSION["admin"] = isValidAdminLogin();
    debug("New session started");
    $showform = false;
    print_credentials();
    }
}
```

Si puede iniciar una sesión, se imprimen las credenciales. Si sesión no puede,
crea una sesión no admin e imprime las credenciales.

```php
function my_session_start() {
    if(array_key_exists("PHPSESSID", $_COOKIE) and isValidID($_COOKIE["PHPSESSID"])) {
    if(!session_start()) {
        debug("Session start failed");
        return false;
    } else {
        debug("Session start ok");
        if(!array_key_exists("admin", $_SESSION)) {
        debug("Session was old: admin flag set");
        $_SESSION["admin"] = 0; // backwards compatible, secure
        }
        return true;
    }
    }

    return false;
}
```

para iniciar sesión, busca en la cookie PHPSESSID y trata de iniciar la sesión
con dicho ID.

Debido a que solo hay 640 sesiones, podemos probar con cada uno hasta llegar a
la sesión que sea válida.

```txt
You are an admin. The credentials for the next level are:
Username: natas19
Password: 8LMJEhKFbMKIL2mxQKjv0aEDdk7zpT0s
```
