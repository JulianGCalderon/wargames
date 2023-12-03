#!/bin/bash

LVL=$1
KEY=$2
exec sshpass -p $2 ssh -p 2223 leviathan$1@leviathan.labs.overthewire.org
