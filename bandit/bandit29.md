Una vez clonado el repositorio, podemos inspeccionarlo

```bash
$ cd bandit29-git
$ ls
README
$ cat README
# Bandit Notes
Some notes for bandit30 of bandit.

## credentials

- username: bandit30
- password: <no passwords in production!>
```

Vemos que las credenciales no estan disponibles en producción. Esto nos da a
entender que las credenciales estan en la rama de desarrollo 

```bash
$ git branch -a
* (HEAD detached at origin/dev)
  master
  remotes/origin/HEAD -> origin/master
  remotes/origin/dev
  remotes/origin/master
  remotes/origin/sploits-dev
```

Vemos que hay una rama de producción, por lo que nos movemos a ella y leemos el
archivo de README

```bash
$ git checkout dev
$ cat README.md
# Bandit Notes
Some notes for bandit30 of bandit.

## credentials

- username: bandit30
- password: xbhV3HpNGlTIdnjUrdAlPzc2L6y9EOnS
```
