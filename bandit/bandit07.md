A partir del operador de piping `|`, podemos filtrar la salida del comando
`cat`, pidiendo solo las lineas que contengan la palabra "millionth"

```bash
$ cat data.txt | grep millionth
millionth       TESKZC0XvTetK0S9xNwm25STk5iWrBvP
```

Si queremos solo quedarnos con el resultado, podemos utilizar `cut`

```bash
$ cat data.txt | grep millionth | cut -f 2
TESKZC0XvTetK0S9xNwm25STk5iWrBvP
```
