En primer lugar, leemos los archivos del directorio `cron.d` para obtener las
tareas creadas

```bash
$ ls -al /etc/cron.d/
```

Leemos el archivo de la tarea del proximo nivel

```bash
$ cat /etc/cron.d/cronjob_bandit22
@reboot bandit22 /usr/bin/cronjob_bandit22.sh &> /dev/null
* * * * * bandit22 /usr/bin/cronjob_bandit22.sh &> /dev/null
```

Vemos que en cada minuto, se ejecuta el script `cronjob_bandit22.sh`. Lo abrimos
para ver que hace:

```bash
$ cat /usr/bin/cronjob_bandit22.sh
#!/bin/bash
chmod 644 /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv
cat /etc/bandit_pass/bandit22 > /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv
```

Vemos que crea un archivo temporal accesible para todos, y guarda la contraseña
del proximo nivel allí. Lo leemos normalmente.

```bash
$ cat /tmp/t7O6lds9S0RqQh9aMcz6ShpAoZKF7fgv
WdDozAdTM2z9DiFEQ2mGlwngMfj4EZff
```

