<?php 
// $_POST['valor1'] = "este es mi valor";
// $_POST['valor1'] = "";
$array = array("mi pelicula 03", "mi pelicula 01", "mi pelicula 04", "mi pelicula 02");


foreach ($array as $key => $value) {
    $_POST['valor1'] .= $value;


// PASAR VARIABLES PHP A JAVASCRIP
echo "<script>\n";
echo "var fruits = '';";
echo "fruits += '".$_POST['valor1']."'\n";
// echo "fruits += 'el amoor'; \n";
echo "</script>";
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 <body>

 <button onclick="myFunction()">Try it</button>

 <p id="orden"></p>

     <script>
     alert(fruits);
     </script>

    <script>
    // var fruits = ["mi pelicula 03", "mi pelicula 01", "mi pelicula 04", "mi pelicula 02"];
    document.getElementById("orden").innerHTML = fruits;

    function myFunction() {
        fruits.sort();
        var text = "";
        var i;
        for (i = 0; i < fruits.length; i++) {
            text += fruits[i] + "<br>";
        }
        document.getElementById("orden").innerHTML = text;
    }
    </script>


 </body>
 </html>