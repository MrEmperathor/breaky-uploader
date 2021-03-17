#!/usr/bin/php
<?php 
// $a = '<html>';
// $a .= '<h1>HOLAAA</h1>';
// $a .= '<p>Testo de relleno</p>';
// $a = '</html>';

// var_dump($a);


// AGREGAR FILTRO A ENLACES
unset($argv[0]);
$enalaces_todos = implode("|", $argv);
echo $enalaces_todos;

// $arrayExample = array('Zapatillas de running', 'Zapatillas de tenis', 'Zapatillas de basket');
// $termToSearch = 'zapatillas';
// $matches = array_filter($arrayExample, function($var) use ($termToSearch) { return stristr($var, $termToSearch); });
// if($matches) {
//     echo 'Se ha encontrado el termino "'.$termToSearch.'" en los siguientes campos: <br>';
//     foreach ($matches as $match) {
//         echo $match.'<br>';
//     }
// } else {
//     echo 'El termino "'.$termToSearch.'" no se ha encontrado en el array.';
// }

 ?>