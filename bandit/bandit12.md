Debido a que debemos trabajar sobre archivos temprales, crearemos una carpeta
sobre la cual trabajar, y moveremos el archivo inicial allí.

```bash
$ cd $(mktemp -d)
$ cp ~/data.txt hexdump
```

Luego, convertiremos el archivo hexdump en su binario original 
con el comando `xxd`

```bash
$ xxd -r hexdump data
```

A partir del comando `file`, podemos definir en que formato
fue comprimido el archivo. Luego le cambiamos el nombre para que
respete el formato y lo descomprimimos

```bash
$ file data
data: gzip compressed data, was "data2.bin", last modified: Thu Oct  5 06:19:20 2023, max compression, from Unix, original size modulo 2^32 573
$ mv data data2.gz
$ gunzip data2.gz
```

Esto debemos repetirlo hasta obtener el archivo original.

```bash
$ file data
...
```

Eventualmente, llegaremos a un archivo de texto.

```
$ file data
data: ASCII text
$ cat data
The password is wbWdlBxEir4CaE8LaPhauuOo6pwRmrDw
```

