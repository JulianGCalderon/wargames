Una vez tenemos una shell en el nivel 26, entonces podremos analizar el
directorio actual y ejecutar `bandit27-do` para obtener la contraseña del
proximo nivel.

```bash
$ ls
bandit27-do  text.txt
$ ./bandit27-do cat /etc/bandit_pass/bandit27
YnQpBuifNMas1hcUFk70ZmqkhUU2EuaS
```

