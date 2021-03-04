<?php
// include_once('comp/filevar.php');

    $u = $_GET['id'];
    $MYAPIKEY = 'be58b29465062a3b093bc17dacef8bf3';
	$ca = curl_init();
	curl_setopt($ca, CURLOPT_URL, "http://api.themoviedb.org/3/configuration?api_key=$MYAPIKEY");
	curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ca, CURLOPT_HEADER, FALSE);
	curl_setopt($ca, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$response = curl_exec($ca);
	curl_close($ca);

	$config = json_decode($response, true);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/tv/".$u."?api_key=$MYAPIKEY");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$response = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($response, true);


echo "esta es mi api";
echo('<pre>');
var_dump($config);
echo('</pre>');
echo "-------------";
echo('<pre>');
var_dump($result);
echo('</pre>');
echo "**************<br>";
echo $config['images']['base_url'].'<br>';
echo $config['images']['backdrop_sizes'][3].'<br>';
echo $result['backdrop_path'].'<br>';

echo("<img src='". $config['images']['base_url'] . $config['images']['backdrop_sizes'][3] . $result['backdrop_path'] . "'/>");
?>