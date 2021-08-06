<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// include the tmdb class
    include('TMDb.php');
 
    $tmdb = new TMDb('be58b29465062a3b093bc17dacef8bf3', 'es');
    $pelis = $tmdb->searchMovie('Superman: Red Son');


    // ID PELIS
    // echo $pelis["results"][0]['id'];
    // echo $pelis["results"][0]['title'];
    // echo $pelis["results"][0]['original_title'];
    // echo $pelis["results"][0]['backdrop_path'];
    // echo $pelis["results"][0]['poster_path'];
    // echo $pelis["results"][0]['release_date'];
    foreach ($pelis["results"] as $key => $value) {
        // echo('<pre>');
        // print_r($value)."<br>";
    
        // echo('</pre>');
        echo $value["id"]."<br>";
     
    }


    echo('<pre>');
    // print_r($pelis);
    echo('<hr>');
    // var_dump($session);

    echo('</pre>');
 
     
    // //Title to search for
    // $title = $_POST['title'];
 
    // //Search Movie with default return format
    // $xml_movies_result = $tmdb_xml->searchMovie($title);
     
    // $xml = simplexml_load_string($xml_movies_result);
 
    // echo '<table>';
    // echo '<tr>';
    // echo '<th>Cover</th>';
    // echo '<th>Info</th>';
    // echo '</tr>';
    // foreach ($xml->movies->movie as $movie) {
    //         $moviename = $movie->name;
    //         $imdbid = $movie->imdb_id;
    //         $posterimg = $movie->images->image[3]['url'];  

 
             
    //         echo '<tr>';
    //         if (!empty($posterimg)) {
    //             echo '<td><a target="_blank" href="'.$movie->url.'"></a></td>';
    //         } else {
    //             echo '<td>No image</td>';
    //         }
    //         echo '<td><a target="_blank" href="'.$movie->url.'"><strong>'.$moviename.'</strong></a> ('.substr($movie->released, 0, 4).')<br /><br />';
    //         echo $movie->overview;
    //         echo '</td>';
    //         echo '</tr>';
    // }
    // echo '</table>';

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>api tmdb</title>
</head>
<body>

<div class="card-deck">
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
</body>
</html>