#!/bin/bash

LVL=$1
KEY=$2
exec sshpass -p $2 ssh -p 2220 bandit$1@bandit.labs.overthewire.org
