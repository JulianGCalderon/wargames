Si inspeccionamos el HTML, hay un comentario que nos indica que para acceder a
la página, debemos venir de http://natas5.natas.labs.overthewire.org.

La información de la página anterior viene de un header en el HTTP request,
llamado Referer. Debemos modificarlo para engañar a la página web.

```bash
$ curl --referer http://natas5.natas.labs.overthewire.org/ http://natas4.natas.labs.overthewire.org --user natas4:tKOcJIbzM4lTs8hbCmzn5Zr4434fGZQm
...
Access granted. The password for natas5 is Z0NsrtIkJoKALBCLi5eqFfcRN82Au2oD
...
```

Otra forma de resolverlo es utilizando BURP, interceptando la petición y
modificando el Referer.
