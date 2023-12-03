Si probamos acceder al binario desde otro usuario, no podremos, ya que está en
una carpeta privada. La única forma de salir será desde el propio usuario

En `dash`, se puede acceder a los argumentos del programa con `$1`, `$2`, `$3`,
etc. `$0` siempre tomára el valor del nombre de la shell, por lo que podemos
ejecutar el siguiente comando

```bash
$ $0
```

La variable `$0` se expanderá a `sh` cuando se interpreta, por lo que no se
pasará a mayuscula. Esto implica que se ejecutara una shell `dash` tradicional.

Desde aquí, podemos obtener la contraseña como usuario bandit32, para el usuario
bandit33

```bash
$ whoami
bandit33
$ cat /etc/bandit_pass/bandit33
odHo63fHiFqcWWJG9rLiLDtPm45KzUKy
```
