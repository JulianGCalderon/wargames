Similar al nivel anterior, pero esta vez utilizaremos `openssl s_client` para
conectarnos utiilzando encriptación ssl.

```bash
$ echo jN2kgmIXJ6fShzhT2avhotn4Zcka6tnt | openssl s_client -connect localhost:30001 -ign_eof
...
...
Correct!
JQttfApK4SeyHwDlI9SXGR50qclOAil1

closed
```

La salida contiene mucha información, pero solo nos interesa la porción final.

