Una vez clonado el repositorio, podemos inspeccionarlo

```bash
$ cd bandit28-git
$ ls
README
$ cat README
# Bandit Notes
Some notes for level29 of bandit.

## credentials

- username: bandit29
- password: xxxxxxxxxx
```

Vemos que las credenciales no estan disponibles, pero podemos inspeccionar
commits anteriores para ver si están.

```bash
$ git log
commit 14f754b3ba6531a2b89df6ccae6446e8969a41f3
Author: Morla Porla <morla@overthewire.org>
Date:   Thu Oct 5 06:19:41 2023 +0000

    fix info leak

commit f08b9cc63fa1a4602fb065257633c2dae6e5651b
Author: Morla Porla <morla@overthewire.org>
Date:   Thu Oct 5 06:19:41 2023 +0000

    add missing data

commit a645bcc508c63f081234911d2f631f87cf469258
Author: Ben Dover <noone@overthewire.org>
Date:   Thu Oct 5 06:19:41 2023 +0000

    initial commit of README.md
```

Para ver el estado del repositorio en el commit anterior, podemos ejecutar

```bash
$ git checkout HEAD~
```

Una vez en el commit anterior, podemos volver a leer el archivo

```bash
$ cat README.md
# Bandit Notes
Some notes for level29 of bandit.

## credentials

- username: bandit29
- password: tQKvmcwNYcFS6vmPHIUSI3ShmsrQZK8S
```
