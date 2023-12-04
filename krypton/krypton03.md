Creamos una carpeta temporal en la que trabajaremos

```bash
$ cd $(mktemp -d)
$ cp /krypton/krypton3/* -t .
```

Primero combinamos los archivos en un único archivo.

```bash
$ cat found* > found
```

Podemos contar la frecuencia de los caracteres de los cifrados encontrados,
utilizando `sed` para colocar cada caracter en una nueva linea, y contarlos con
`sort` y `uniq`.


```bash
$ sed 's/\(.\)/\1\n/g' found | sort | uniq -c | sort -n -r
    704
    456 S
    340 Q
    301 J
    257 U
    246 B
    240 N
    227 G
    227 C
    210 D
    132 Z
    130 V
    129 W
     86 M
     84 Y
     75 T
     71 X
     67 K
     64 E
     60 L
     55 A
     28 F
     19 I
     12 O
      4 R
      4 H
      2 P
```

Buscamos las letras mas frecuentes del ingles americano, y reemplazamos según el
mismo orden.

```bash
$ cat krypton4 | tr "SQJUBNGCDZVWMYTXKELAFIORHP" "ETAOINSHRDLCUMWFGYPBVKJXQZ" > cracking
```

Podemos ahora leer la contraseña, pero resaltando las letras mas populares (de
esta forma, podemos concentranos en las que tienen mas probabildiad de ser
ciertas)

```bash
$ cat cracking | grep -e E -e T -e A
GELLC ISEAR ELEKE LFIUN MTOOG INCHO BNUAE
```

Debido a que no tiene mucho sentido, modifico levemente el orden hasta encontrar
algo con sentido

```bash
$ cat krypton4 | tr "SQJUBNGCDZVWMYTXKELAFIORHP" "EATSORNIHCLDUPGFWYMBKVJXQZ"  > cracking
$ cat cracking
WELLD ONETH ELEVE LFOUR PASSW ORDIS BRUTE 
```

Reordenando los espacios, queda: "WELL DONE THE LEVEL FOUR PASSWORD IS BRUTE"
