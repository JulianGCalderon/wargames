Utilizamos `sshpass` para poder pasar la contraseña como argumento al programa.

```bash
ssh -p 2220 bandit0@bandit.labs.overthewire.org 
sshpass -pbandit0 ssh -p 2220 bandit0@bandit.labs.overthewire.org
```

Para simplificar la conexión, esto se abrevió en el script
```bash
$ ./sshbandit.sh $LVL $KEY
```

Una vez dentro, seguimos las instrucciones y leemos el archivo `readme`.

```bash
$ cat readme
NH2SXQwcBdpmTEzi3bvBHMM9H66vVXjL
```
