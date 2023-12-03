Para descubrir cual es la shell por defecto del usuario bandit27, leemos el
archivo `/etc/passwd`.

```bash
$ cat /etc/passwd | grep bandit27:
bandit27:x:11027:11027:bandit level 27:/home/bandit27:/bin/bash
```

Leemos el script para ver de que se trata

```bash
$ cat /usr/bin/showtext
#!/bin/sh

export TERM=linux

exec more ~/text.txt
exit 0
```

Vemos que se esta ejecutando el comando `more`. 

Nos descargamos la clave con `scp` y nos conectamos al siguiente nivel desde
nuestra computadora local.

```bash
$ sshpass -p p7TaowMYrmu23Ol8hiZh9UvD0O9hpx8d scp -P 2220 bandit25@bandit.labs.overthewire.org:bandit26.sshkey bandit26.sshkey
$ ssh bandit26@bandit.labs.overthewire.org -p 2220 -i bandit26.sshkey
```

Si tenemos la pantalla grande, entonces el comando `more` finalizará
inmediatamente, por lo que debemos achicar la ventana de la terminal. Para poder
tener mas control, apretamos la tecla 'v' para abrir `vim`. Desde allí podremos
configurar la shell por defecto con `:set shell=/bin/bash`, y abrimos la shell
con `:shell`.

Desde la shell podremos hayar la contraseña del propio nivel, para no depender
de una clave privada.

```bash
$ cat /etc/bandit_pass/bandit26
c7GvcKlw9mC7aUQaPx7nwFstuAIBw1o1
```

