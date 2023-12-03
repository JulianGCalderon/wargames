A partir del comando `tr`, podemos reemplazar caracteres por otros. Se pueden
definir individualmente, o por rangos, lo cual nos simplifica el ejercicio.

```bash
$ cat data.txt | tr "a-zA-Z" "n-za-mN-ZA-M"
The password is JVNBBFSmZwKKOP0XbFXOoW8chDz5yVRv
```

