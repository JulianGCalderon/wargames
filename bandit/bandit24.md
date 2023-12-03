Comenzamos creando un script en una carpeta temporal

```bash
$ cd $(mktemp -d)
$ vim cracker.sh
```

Nuestro script escribirá a stdout todas las posibles combinaciones
```bash
#!/bin/bash

pass=VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar
for i in {0000..9999}; do
        echo $pass $i;
done
```

Luego le damos permisos de ejecución, y enviamos el resultado de su ejecución a
`nc`. Para evitar que se impriman muchos mensajes de error, utilizamos `uniq`.

```bash
$ chmod +x cracker.sh
$ ./cracker.sh | nc localhost 30002 -v | uniq
...
...
The password of user bandit25 is p7TaowMYrmu23Ol8hiZh9UvD0O9hpx8d
```

