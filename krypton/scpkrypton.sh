#!/bin/bash

LVL=$1
KEY=$2
DST=$3

mkdir -p $DST
exec sshpass -p $KEY scp -P 2231 krypton$LVL@krypton.labs.overthewire.org:/krypton/krypton$LVL/* $DST

