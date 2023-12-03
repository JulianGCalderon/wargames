Primero, hayamos los puertos abiertos en el rango indicado
a través del comando `nmap`

```bash
$ nmap localhost -p 31000-32000
Starting Nmap 7.80 ( https://nmap.org ) at 2023-12-02 16:05 UTC
Nmap scan report for localhost (127.0.0.1)
Host is up (0.00014s latency).
Not shown: 996 closed ports
PORT      STATE SERVICE
31046/tcp open  unknown
31518/tcp open  unknown
31691/tcp open  unknown
31790/tcp open  unknown
31960/tcp open  unknown

Nmap done: 1 IP address (1 host up) scanned in 0.12 seconds
```

Luego, realizamos una inspección mas profunda de los puertos abiertos, para
obtener el servicio utilizado

```bash
$ nmap -sV -T4 localhost -p 31046,31518,31691,31790,31960
Starting Nmap 7.80 ( https://nmap.org ) at 2023-12-02 16:06 UTC
Nmap scan report for localhost (127.0.0.1)
Host is up (0.00088s latency).

PORT      STATE SERVICE     VERSION
31046/tcp open  echo
31518/tcp open  ssl/echo
31691/tcp open  echo
31790/tcp open  ssl/unknown
31960/tcp open  echo
1 service unrecognized despite returning data. If you know the service/version, please submit the following fingerprint at https://nmap.org/cgi-bin/submit.cgi?new-service :
SF-Port31790-TCP:V=7.80%T=SSL%I=7%D=12/2%Time=656B5632%P=x86_64-pc-linux-g
SF:nu%r(GenericLines,31,"Wrong!\x20Please\x20enter\x20the\x20correct\x20cu
SF:rrent\x20password\n")%r(GetRequest,31,"Wrong!\x20Please\x20enter\x20the
SF:\x20correct\x20current\x20password\n")%r(HTTPOptions,31,"Wrong!\x20Plea
SF:se\x20enter\x20the\x20correct\x20current\x20password\n")%r(RTSPRequest,
SF:31,"Wrong!\x20Please\x20enter\x20the\x20correct\x20current\x20password\
SF:n")%r(Help,31,"Wrong!\x20Please\x20enter\x20the\x20correct\x20current\x
SF:20password\n")%r(SSLSessionReq,31,"Wrong!\x20Please\x20enter\x20the\x20
SF:correct\x20current\x20password\n")%r(TerminalServerCookie,31,"Wrong!\x2
SF:0Please\x20enter\x20the\x20correct\x20current\x20password\n")%r(TLSSess
SF:ionReq,31,"Wrong!\x20Please\x20enter\x20the\x20correct\x20current\x20pa
SF:ssword\n")%r(Kerberos,31,"Wrong!\x20Please\x20enter\x20the\x20correct\x
SF:20current\x20password\n")%r(FourOhFourRequest,31,"Wrong!\x20Please\x20e
SF:nter\x20the\x20correct\x20current\x20password\n")%r(LPDString,31,"Wrong
SF:!\x20Please\x20enter\x20the\x20correct\x20current\x20password\n")%r(LDA
SF:PSearchReq,31,"Wrong!\x20Please\x20enter\x20the\x20correct\x20current\x
SF:20password\n")%r(SIPOptions,31,"Wrong!\x20Please\x20enter\x20the\x20cor
SF:rect\x20current\x20password\n");

Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
Nmap done: 1 IP address (1 host up) scanned in 98.68 seconds
```

Notamos que hay un puerto que no detecta el servicio, ya que no es un *echo
server*. Nos conectaremos a este server y le enviaremos la clave actual.
Obtendremos una clave privada

```bash
$ echo JQttfApK4SeyHwDlI9SXGR50qclOAil1 | openssl s_client -connect localhost:31790
...
...
-----BEGIN CERTIFICATE-----
MIIDCzCCAfOgAwIBAgIEI76iwDANBgkqhkiG9w0BAQUFADAUMRIwEAYDVQQDDAls
b2NhbGhvc3QwHhcNMjMxMTMwMDczNDExWhcNMjMxMTMwMDczNTExWjAUMRIwEAYD
VQQDDAlsb2NhbGhvc3QwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDu
XqqjB5Fgt1IlPMN7whPXkqXP+XflSZ/1AXB1CGu3P1N+AD96CngE5aKIXm2A5lsH
YU3Co7yxoap+jCULSbpMHD5dyT64T0IE4OsKH/UEp8IHW6yLSrA2kMRqL4sqE5vS
imnohwrPiv/KvvKW9206MgUTzGqDrLUwFU9DwbPxE5MPE1RBQ1LPI8Q1/lzPbrrz
FDesDUI8pvWX/wpSGl7WYDwIyLsiumU7P7TfitVaXzZr8xJ9uMMYz4rE+lt0r8eu
jZz5sTqmUCKF8MDU0lCzyI7DCP3yLMcJZo5s9MKQ3fZp+Mxk3+Xe3zWTabuZlij/
14pJfKnefyF+874wMtxNAgMBAAGjZTBjMBQGA1UdEQQNMAuCCWxvY2FsaG9zdDBL
BglghkgBhvhCAQ0EPhY8QXV0b21hdGljYWxseSBnZW5lcmF0ZWQgYnkgTmNhdC4g
U2VlIGh0dHBzOi8vbm1hcC5vcmcvbmNhdC8uMA0GCSqGSIb3DQEBBQUAA4IBAQDA
tnK1IQphRl8yagCeCxP7rTYpbxgMa9zC0nNGCbj3I/3bb33amiPX4MXCeHBWji5O
oEfUvN99OD5Mwhzv8tH/OS3mtmdVjwnJ1gmrhhv33mbs5hzsii4gHn2ZTCoK4Br9
hMH0lYk43YCRnRnz6ppw0TdwULhjaC1xj0MTyvOkfTv6Ldrlwhb4eIT/AilfwLIz
RzmcrxE3EHiM05J5JUSwVDzBGR3ZAAkbhAZDw/x13Xl2CaYRlz2L0gK7TPZHcvYV
Xh/qy++n7eT23n3T385eGrXmKcCCxZyLwMDtSAPI143/9SWRhad9YRG+vZakj//7
djEsGge3kvgW7zW6vniC
-----END CERTIFICATE-----
...
...
```

Si queremos obtener únicamente el certificado, utilizamos el comando `sed` para
obtener el texto dentro de dos patrones. Antes de guardar el archivo, crearemos
un directorio temporal

```bash
$ cd $(mktemp -d)
$ echo JQttfApK4SeyHwDlI9SXGR50qclOAil1 | openssl s_client -connect localhost:31790 -ign_eof | sed -n '/-----BEGIN RSA PRIVATE KEY-----/, /-----END RSA PRIVATE KEY-----/p' > bandit17.sshkey
```

Luego, descargamos la clave en nuestra computadora como hicimos previamente.
Debemos poner la ubicación de nuestra carpeta temporal

```bash
$ sshpass -p JQttfApK4SeyHwDlI9SXGR50qclOAil1 scp -P 2220 bandit16@bandit.labs.overthewire.org:/tmp/tmp.wBpOUSSszE/bandit17.sshkey bandit17.sshkey
```

Antes de utilizar la clave, debemos hacerla darle permisos mas restricticos.
Luego nos conectamos al siguiente nivel y obtenemos la clave propia como hicimos
previamente

```bash
$ chmod  400 bandit17.sshkey
$ ssh bandit17@bandit.labs.overthewire.org -p 2220 -i bandit17.sshkey
```

Una vez conectados, podemos obtener la clave propia

```bash
$ cat /etc/bandit_pass/bandit17
VwOSWtCA7lRKkTfbr2IDh6awj9RNZM5e
```

