#!/bin/bash
ruta=$(pwd)
nameFile="$1"
urldestino=$2
cd sh/files 2>/dev/null
SAVEIFS=$IFS; 
IFS=$(echo -en "\n\b");

# echo $1
# for i in * ; do mv -- "${i}" "${i//['][!”#$%&’()*+,/ :;<=>?@\^`{\|}~-']/_}" ; done


curl -F file1=@$nameFile $urldestino


IFS=$SAVEIFS

