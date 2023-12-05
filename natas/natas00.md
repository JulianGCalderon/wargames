Nos conectamos al nivel a través del navegador, podemos utilizar el comando
`firefox`.

```bash
firefox natas0.natas.labs.overthewire.org
```

Si inspeccionamos el HTML, podremos encontrar la contraseña para el siguiente
nivel como un comentario en el código.

```html
<div id="content">
You can find the password for the next level on this page.

<!--The password for natas1 is g9D9cREhslqBKtcA2uocGHPfMZVzeFK6 -->
</div>
```
