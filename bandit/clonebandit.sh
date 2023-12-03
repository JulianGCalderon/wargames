#!/bin/bash

LVL=$1
KEY=$2
exec sshpass -p $2 git clone ssh://bandit$1-git@bandit.labs.overthewire.org:2220/home/bandit$1-git/repo bandit$1-git
