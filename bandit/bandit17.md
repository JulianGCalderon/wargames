El comando `diff` nos mostrara la diferencia entre dos archivos

```bash
$ diff passwords.old passwords.new
42c42
< p6ggwdNHncnmCNxuAt0KtKVq185ZU7AW
---
> hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
```

La constraseña será la ultima linea (la mas reciente)

```bash
$ diff passwords.old passwords.new | tail -1
> hga5tuuCLF6fFzUpnagiMN8ssu9LFrdg
```
