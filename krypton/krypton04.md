Debido a que la desencriptación se puede ejecutar local utilizamos el script
`scpkrypton.sh` para descargar los archivos necesarios.

```bash
$ ./scpkrypton.sh 4 BRUTE krypton04/
```

Primero, eliminamos los espacios de los archivos de entrada, con:

```bash
sed 's/ //g'
```

Despues, separamos las palabras cada seis letras, para poder analizarlas según
la parte de la clave utilizada.

```bash
sed 's/\(.\{,6\}\)/\1\n/g'
```

El siguiente paso consiste en obtener la letra mas común para cada columna,
podemos hacerlo con `perl`.

```bash
perl -F'' -M"List::UtilsBy max_by" -lane 'END { for $e (@A) { print max_by { %$e{$_} } keys %$e }} while (my ($i, $e) = each @F) { $A[$i]{$e}++}'
```

Finalmente, realizamos un aritmetica con los codigos ascii de las letras mas
comunes del cifrado, y la letras más común del ingles, para obtener la clave
original.

```bash
perl -lpne '$_ = chr((ord($_) - ord("E")) % 26 + ord("A"))'
```

Finalmente juntamos en una sola linea:

```bash
tr -d '\n'
```

El resultado de todos estos comandos en cadena nos da una clave probable del
cifrado:

```bash
$ sed 's/ //g' found1 found2 | sed 's/\(.\{,6\}\)/\1\n/g' | perl -F'' -M"List::UtilsBy max_by" -lane 'END { for $e (@A) { print max_by { %$e{$_} } keys %$e }} while (my ($i, $e) = each @F) { $A[$i]{$e}++}' | perl -lpne '$_ = chr((ord($_) - ord("E")) % 26 + ord("A"))' | tr -d '\n'
FREKEY
```

Una vez tenemos el código, podemos desencriptar los archivos. Primero quitamos
los espacios y separamos cada 6 caracteres, y luego utilizamos `perl` para aplicar la rotación inversa.

```bash
sed 's/ //g' krypton5 | sed 's/\(.\{,6\}\)/\1\n/g' |  perl -F'' -lane 'BEGIN { $KEY = "FREKEY"} while (($i, $e) = each @F) { print(chr(((ord($e) - ord(substr($KEY, $i, 1))) % 26) + ord("A")))}' 
```

Finalmente unimos el resultado en una sola linea, con `tr`.

```bash
tr -d '\n'
```

El resultado de estos comandos en cadena nos da la contraseña desencriptada.

```bash
$ sed 's/krypton5 | sed 's/\(.\{,6\}\)/\1\n/g' |  perl -F'' -lane 'BEGIN { $KEY = "FREKEY"} while (($i, $e) = each @F) { print(chr(((ord($e) - ord(substr($KEY, $i, 1))) % 26) + ord("A")))}' | tr -d '\n'
CLEARTEXT
```

Si se prefiere armar scripts para un código mas prolijo, podemos utilizar
únicamente perl.

Primero necesitamos un script que obtenga la clave de encriptado a partir de
textos encriptados. Esta utilizará los archivos enviados por parámetro para
desencriptar una clave de longitud especificada por variable de entorno LENGTH:
`vignere_crack.pl`.

Luego necesitamos otro script que se encargue de la desencriptación. Este
recibira la clave como variable de entorno, y decodificara los archivos enviados
por parámetro: `vignere_decode.pl`.

