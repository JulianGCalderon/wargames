Nos conectamos al primer nivel utilizando el bash script `sshkrypton`, que
utiliza internamente `sshpass` para conectarse al nivel

```bash
$ ./sshkrypton.ssh 1 KRYPTONISGREAT
```

Buscamos el archivo en algún lugar del sistema

```bash
$ find . -name krypton2 2> /dev/null
./etc/krypton_pass/krypton2
./home/krypton2
./krypton/krypton2
./krypton/krypton1/krypton2
$ find . -name krypton2 2> /dev/null | xargs cat
cat: ./etc/krypton_pass/krypton2: Permission denied
cat: ./home/krypton2: Is a directory
cat: ./krypton/krypton2: Is a directory
YRIRY GJB CNFFJBEQ EBGGRA
```

Probamos con una simple rotación "rot13".

```bash
$ cat /krypton/krypton1/krypton2 | tr 'A-Za-z' 'N-ZA-Mn-za-m'
LEVEL TWO PASSWORD ROTTEN
```

La contraseña es `ROTTEN`.
