Al comenzar, realizamos lo mismo que en ejercicio anterior.

```bash
$ ls -al /etc/cron.d/
$ cat /etc/cron.d/cronjob_bandit23
$ cat /usr/bin/cronjob_bandit23.sh
#!/bin/bash

myname=$(whoami)
mytarget=$(echo I am user $myname | md5sum | cut -d ' ' -f 1)

echo "Copying passwordfile /etc/bandit_pass/$myname to /tmp/$mytarget"

cat /etc/bandit_pass/$myname > /tmp/$mytarget
```

Vemos que ahora el archivo lo guarda en el resultado del comando `$(echo I am user $myname | md5sum | cut -d ' ' -f 1)`, con `myname=bandit23`. Ejecutamos el comando y luego, utilizando `xargs`, leemos el archivo con el nombre indicado de la carpeta `tmp`.

```bash
$ echo I am user bandit23 | md5sum | cut -d ' ' -f 1 | xargs -i cat /tmp/{}
QYw0Y2aiA672PsMmh9puTQuhoz8SyR2G
```

