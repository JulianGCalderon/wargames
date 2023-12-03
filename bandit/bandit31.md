Una vez clonado el repositorio, podemos inspeccionarlo

```bash
$ cd bandit30-git
$ ls
README
$ cat README
This time your task is to push a file to the remote repository.

Details:
    File name: key.txt
    Content: 'May I come in?'
    Branch: master
```

Creamos un archivo con las propiedades indicadas, y tratados de dejarlo como
*staged* utilizando `git add`

```bash
$ git add -f key.txt 
```

Luego realizamos un commit, y pusheamos

```bash
$ git commit -m "Please?"
$ git push
...
...
remote: ### Attempting to validate files... ####
remote:
remote: .oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.
remote:
remote: Well done! Here is the password for the next level:
remote: rmCBvG56y58BXzv98yZGdO7ATVL5dW8y
remote:
remote: .oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.oOo.
```

