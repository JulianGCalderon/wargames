Comenzaremos un servidor TCP que enviara la propia contraseña al cliente que se
conecte, y lo dejaremos en background.

```bash
$ echo "VxCazJaVykI6W36BkBU0mJTCM8rR95XT" | nc -l -v -p 0 &
Listening on 0.0.0.0 35451
```

Utilizaremos el binario provisto para obtener la contraseña siguiente

```bash
$ ./suconnect 35451
Connection received on localhost 41970
Read: VxCazJaVykI6W36BkBU0mJTCM8rR95XT
Password matches, sending next password
NvEJF7oVjkddltPSrdKEFOllh9V1IBcq
```

La contraseña es la ultima linea del resultado
