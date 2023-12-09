Si inspeccionamos el HTML, vemos que hay algunos botones que nos redirigen a
`index.php?page=home` y a `index.php?page=about` respectivamente.

Si el servidor devuelve el contenido de la pagina en la dirección enviada por
parámetro, entonces podriamos pedirle el archivo `/etc/natas_webpass/natas8`.
Enviamos esta dirección como parámetro a `index.php`, y asi obtendremos la
contraseña.

```html
a6bZCNYwdKqN5cGP11ZdtPg0iImQQhAB
```
