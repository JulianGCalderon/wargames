Si inspeccionamos el HTML, hay un comentario que nos indica que ni Google podrá
encontrar el archivo secreto. Si buscamos en google, notamos que para que google
ignore un archivo debemos crear un archivo `robots.txt`. Lo inspeccionamos...

```bash
$ curl http://natas3.natas.labs.overthewire.org/robots.txt --user natas3:G6ctbMJ5Nb4cbFwhpMPSvxGHhQ7I6W8Q
User-agent: *
Disallow: /s3cr3t/
```

Al revisar la carpeta oculta, encontramos que refeire a un archivo oculto que
contiene la contraseña...

```bash
$ curl http://natas3.natas.labs.overthewire.org/s3cr3t/users.txt --user natas3:G6ctbMJ5Nb4cbFwhpMPSvxGHhQ7I6W8Q
natas4:tKOcJIbzM4lTs8hbCmzn5Zr4434fGZQm
```
