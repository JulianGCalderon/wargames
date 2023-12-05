Primero necesitamos un texto para darle al algoritmo. Podemos descargar un texto
de prueba de "http://metaphorpsum.com".

```
$ curl http://metaphorpsum.com/paragraphs/1/10 | tr -c -d '[:alpha:]' | tr [:lower:] [:upper:] > sample-plain.txt
```

Luego, la encriptaremos utilizando el ejecutable, desde la terminal de krypton.

```
$ cd /krypton/krypton6/
$ tmp=$(mktemp -d)
$ chmod 777 $tmp
$ echo "AWHALE...THERNET" > $tmp/sample.txt
$ ./encrypt6 $tmp/plain $tmp/sample.cipher
```

Luego, lo descargamos desde nuestra terminal. Debemos reemplazar `$tmp` por la
dirección de nuestra carpeta temporal.

```bash
$ sshpass -p RANDOM scp -P 2231 krypton6@krypton.labs.overthewire.org:$tmp/sample.cipher .
```

Debemos realizar una operación de RESTA entre el archivo cifrado y el archivo
inicial, para obtener la clave con la que se encripto. Utilizaremos el script
`str_sub.pl`

```bash
$ perl str_sub.pl sample.cipher sample.txt
EICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRFXYCPFUEOCKRNEICTDGYIYZKTHNSIRF
```

Notamos que la contraseña se repite cada 30 caracteres, por lo que la
encriptación se puede pensar como una encriptación vigenere de longitud de clave
30, y de valor: "EICTDGYIYZKTHNSIRFXYCPFUEOCKRN".

Reutilizamos el script `vigenere_decode.pl` para desencriptar la contraseña del
siguiente nivel.

```
$ KEY="EICTDGYIYZKTHNSIRFXYCPFUEOCKRN" perl vinegere_decode.pl krypton7
LFSRISNOTRANDOM
```

