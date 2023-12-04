Creamos una carpeta temporal en la que trabajaremos

```bash
$ cd $(mktemp -d)
$ cp /krypton/krypton4/* -t .
```

Como sabemos la longitud de la clave, debemos analizar juntas las letras que
serían codificadas con el mismo elemento de la clave. Si la clave tiene seis
letras, entonces haremos un análisis de las frecuencias para las letras en las
posiciones 0, 6, 12, 18, ...

Podemos utilizar sed para quitar los espacios, y luego colocaremos cada seis
letras en una linea distinta. Hacemos esto para ambos archivos, asi obtenemos un
único archivo.

```bash
$ sed 's/ //g' found1 found2 | sed 's/\(.\{,6\}\)/\1\n/g' | found
```

Luego, creamos un script de perl que lea cada linea, haga un análisis de
frecuencias distinto para cada posición, y devuelve la letra más común en cada
uno.

```bash

```
