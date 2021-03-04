#!/bin/bash
servidor="ftp.mystream.to"
usuario="cine24h xk6f1qkok043sm6z"
# nombreFichero="$USERNAME-cs-$( date +%Y%m%d%k%M%S).tar"
nombreFichero="$1"

echo "machine ftp.mystream.to
login cine24h
password xk6f1qkok043sm6z" > /root/.netrc ; chmod 0600 /root/.netrc

echo "Comprimiendo directorio …"
# tar -zcvf "/home/nacho/Scripts/tars/comprimido/$nombreFichero" /home/nacho/Scripts/tars/comprimir/*
echo "Subiendo fichero $nombreFichero por ftp"
# ftp -n << EOF
# passive
# open $servidor
# user $usuario
# put "$nombreFichero" /$nombreFichero
# quit
# EOF

ftp -v << EOF > .evoload.log
open $servidor
user $usuario
ls
put "$nombreFichero"
quit
EOF
echo "Fichero $nombreFichero subido correctamente"

