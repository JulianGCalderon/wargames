Si el comando tiene espacios, las palabras se tomaran como archivos distintos

```bash
$ cat spaces in this filename
cat: spaces: No such file or directory
cat: in: No such file or directory
cat: this: No such file or directory
cat: filename: No such file or directory
```

Debemos escapar los caracteres para que los tome como un espacio en el nombre

```bash
$ cat spaces\ in\ this\ filename
aBZ0W5EmUfAf7kHTQeOwd8bauFJ2lAiG
```

