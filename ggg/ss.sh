#!/bin/bash
showopts () {
  while getopts ":pq:" optname
    do
      case "$optname" in
        "p")
          echo "Se ha especificado la opción $optname"
          ;;
      "q")
        echo "La opción $optname tiene el valor $OPTARG"
        ;;
        "?")
          echo "Opción desconocida $OPTARG"
        ;;
        ":")
          echo "Sin valor de argumentos para la opción $OPTARG"
        ;;
        *)
        # Should not occur
        echo "Error desconocido mientras se procesaban las opciones"
        ;;
      esac
    done
  return $OPTIND
}
 
showargs () {
  for p in "$@"
    do
      echo "[$p]"
    done
}
 
optinfo=$(showopts "$@")
argstart=$?
arginfo=$(showargs "${@:$argstart}")
echo "ARGSTART ES:"
echo "${@:$argstart}"
echo "Los argumentos son:"
echo "$arginfo"
echo "Las opciones son:"
echo "$optinfo"

# echo "OPTIND inicia en $OPTIND"
# v=1
# while getopts ":pq:n:" optname
#   do
#     case "$optname" in
#       "p")
#         echo "Se ha especificado la opción $optname y su valor es $OPTARG"
#         ;;
#       "q")
#         echo "La opción $optname tiene el valor $OPTARG"
#         ;;
#         "n")
#         echo "La opción $optname tiene el valor $OPTARG"
#         ;;
#       "?")
#         echo "Opción desconocida $OPTARG"
#         ;;
#       ":")
#         echo "Sin valor de argumentos para la opción $OPTARG"
#         ;;
#       *)
#       # Should not occur
#         echo "Error desconocido mientras se procesaban las opciones"
#         ;;
#     esac
#     echo "OPTIND ahora es $OPTIND"
#     echo "----VUELTA # $v -------"
#     ((v++))
#   done