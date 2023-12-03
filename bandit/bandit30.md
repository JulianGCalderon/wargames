Una vez clonado el repositorio, podemos inspeccionarlo

```bash
$ cd bandit30-git
$ ls
README
$ cat README
just an epmty file... muahaha
```

Debido a que no hay ramas, ni commits en el log, buscamos algún tag

```bash
$ git tag
secret
```

Vemos que existe un tag secret, por lo que lo podemos ver con `git show`.

```bash
$ git show secret
OoffzGDlzhAlerFJ2cAiz1D41JW1Mhmt
```

