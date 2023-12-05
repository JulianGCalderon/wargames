Podemos ejecutar el script del ejercicio anterior, pero con distintas
longitudes.

```bash
$ for length in {5..10}; do
>     export LENGTH=$length
>     export KEY=$(LENGTH=$length perl vigenere_crack.pl krypton5/found*)
>     echo $(perl vigenere_decode.pl krypton5/krypton6)
> done
UXRULS
HLEEZM
ILYHYL
HXEBEO
RANDOM
HXNUYM
```

Vemos que la contraseña "RANDOM" es la que tiene mas sentido, por lo que nos
quedamos con esa.
