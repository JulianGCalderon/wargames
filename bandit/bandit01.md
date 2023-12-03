Debido a que el archivo se llama "-", entonces no podremos utilizar el comando
`cat` de forma tradicional.

```bash
$ cat -
```

El simbolo - se utiliza para indicar que queremos leer de la stdin, en lugar de
un archivo particular. Para solucionarlo, debemos indicar el path
con el directorio actual.

```bash
$ cat ./-
rRGizSaX8Mk1RTb1CNQoXTcYZWU6lgzi
```

