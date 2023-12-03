#!/bin/bash

LVL=$1
KEY=$2
exec sshpass -p $2 ssh -p 2231 krypton$1@krypton.labs.overthewire.org
