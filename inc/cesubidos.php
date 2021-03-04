<?php

// ini_set('error_reporting', E_ALL|E_STRICT);
// ini_set('display_errors', '1');

$id_db = $_GET['iddb'];

if (!empty($id_db)) {

    $permiso = 'admin2';
    include 'xion/conexion.php';

    // $sql_leer = 'SELECT * FROM pelis WHERE id=?';
    // $gsent = $pdo->prepare($sql_leer);
    // $gsent->execute(array($id));

    // $resultado = $gsent->fetch();

    // echo 'el id: '.$id_db . '<br>';

    $sql_unico = 'SELECT * FROM pelis WHERE id=?';

	$gsent_unico = $pdo->prepare($sql_unico);
	$gsent_unico->execute(array($id_db));

    $resultado_unico = $gsent_unico->fetch();
    
    $links = unserialize($resultado_unico['links']);
    

    require_once 'comp/funtions.php';

    // $host = array('hqq.tv','drive.google.com/open','drive.google.com/uc','mega.nz','short.pe','ouo.io');
    $host = array('hqq.tv','drive.google.com/open','drive.google.com/uc','mega.nz');
    $comprobados = array();

    foreach ($host as $key => $value) {

        if(!buscarDato($links, $value)) $comprobados[] = $value;
    }
    echo json_encode($comprobados);
    
}

?>