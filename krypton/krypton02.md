Creamos una carpeta temporal en la que trabajaremos

```bash
$ cd $(mktemp -d)
$ chmod 777 .
$ ln -s /krypton/krypton2/keyfile.dat
$ ln -s /krypton/krypton2/krypton3
```

Creamos un archivo con el abecedario y lo encriptamos, para descubrir la
clave.

```bash
$ echo "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" > plaintext
$ /krypton/krypton2/encrypt plaintext
$ cat ciphertext
MNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKL
```

Ahora implementamos un desencriptador utilizando el comando `tr`

```bash
$ cat krypton3 | tr "[M-ZA-L]" "[A-Z]"
CAESARISEASY
```
