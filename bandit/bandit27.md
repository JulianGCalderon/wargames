Para clonar el repositorio, utilizamos el comando `git clone` con el formato
`ssh`.

```bash
git clone ssh://bandit27-git@bandit.labs.overthewire.org:2220/home/bandit27-git/repo bandit27-git
```

Para simplificar los futuros ejercicios, se abrevio este comando en el script

```bash
$ ./gitbandit.sh $LVL $KEY
```

Una vez clonado, podemos inspeccionarlo

```bash
$ cd bandit27-git
$ ls
README
$ cat README
The password to the next level is: AVanL161y9rsbcJIsFHuw35rjaOM19nR
```

