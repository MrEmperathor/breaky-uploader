<?php
if (isset($_POST['valorCaja1']) && isset($_POST['valorCaja2'])) {
    $nombre = $_POST['valorCaja1'];
    $apellido = $_POST['valorCaja2'];

    echo "Usuario" . $nombre . " " . $apellido . " fue creado felixente"; 
}