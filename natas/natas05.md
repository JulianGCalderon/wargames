Si inspeccionamos el HTML, hay un comentario que nos indica que no hemos
iniciado sesión. Si revisamos las cookies, notamos que hay un atributo
`loggedin` que tiene un valor de `0`.

Lo establecemos en `1` y recargamos la página. Obtendremos la contraseña:

```html
Access granted. The password for natas6 is fOIvE0MDtPTgRhqmmvvAOt2EfXR6uQgR
```

Otra opcion es directamente establecer el atributo desde BURP. Desde allí
podemos obervar que en respuesta a nuestro primer `GET`, el servidor nos
devuelve un mensaje `HTTP` con la cookie `loggedin=0`.
