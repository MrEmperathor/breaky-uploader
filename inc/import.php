<?php
include 'xion/conexion.php';

$id_min = 7801;
$id_max = 8212;
// $id_min = 4885;      //maxpelis.tk
// $id_max = 4886;
$hd     = 33;
$cam    = 34;
$dvd    = 32070;


function buscarDuplicadoWp($tmdb, $domi = "https://maxpeliculas.net")
{

    $wp_host = $domi;
    $wp_url = $wp_host."/wp-json/bk-auto-generate-buscar-id/v2/postID/".$tmdb."/api/4cd9cd25-fc28-4089-9977-70377dc6cd4f";

    $wp_result = file_get_contents($wp_url);
    $wp_result = json_decode($wp_result, true);
    
    return $wp_result;

}

function buscarDato($arrayExample,$termToSearch)
{
	$matches = array_filter($arrayExample, function($var) use ($termToSearch) { return stristr($var, $termToSearch); });
	if($matches)
	{	
		foreach ($matches as $match) 
		{
			$very = array_search($match, $arrayExample, true);
    	}
	    return $very;
	}
}
function createPost($value, $calidad, $app = false){

    $enlaces        = array();
    $type           = array();
    $tmdb           = $value["TMDB"];
    $idioma         = array();
    $enlace_max     = json_decode(buscarDuplicadoWp($tmdb), true)[0]["link"];
    
    
    foreach (unserialize($value["links"]) as $j => $v){
        if (parse_url($v, PHP_URL_HOST) == "formatearwindows.net") {
            array_unshift($enlaces, $v);
            array_unshift($type, 1);
        }
        if (parse_url($v, PHP_URL_HOST) == "hqq.to") {
            $enlaces[]      = $v;
            $type[]         = 1;
        }

        if (parse_url($v, PHP_URL_HOST) == "mega.nz") {
            $enlaces[]      = ($app) ? $enlace_max : $v;
            $type[]         = 2;
        }
        
        if (parse_url($v, PHP_URL_HOST) == "fembed.com") {
            $enlaces[]      = ($app) ? $enlace_max : $v;
            $type[]         = 2;
            $enlaces[]      = str_replace("fembed.com/f/","fembed.com/v/",$v);
            $type[]         = 1;
        }
        
        if (parse_url($v, PHP_URL_HOST) == "uptobox.com") {

            if(!buscarDato($enlaces, "uptobox")) {
                $enlaces[] = ($app) ? $enlace_max : $v;
                $type[]    = 2;
            }
        }
        
    }
    for ($a=0; $a < count($enlaces); $a++) { 
        if ($value["idioma"] == "LAT"){
            $idioma[]   = "Latino";
            $addlink    = 29;
        }elseif($value["idioma"] == "ESP"){
            $idioma[]   = "Castellano";
            $addlink    = 1559;
        }elseif($value["idioma"] == "SUB"){
            $idioma[]   = "Subtitulado";
            $addlink    = 31;
        }   
    }
    $poster                 = base64_encode("null");
    $calidad_api            = base64_encode(json_encode($calidad));
    $enlaces_api            = base64_encode(json_encode($enlaces));
    $type_api               = base64_encode(json_encode($type));
    $idioma_api             = base64_encode(json_encode($idioma));

    $url = "https://maxpeliculas.net/wp-json/bk-dcms-seo-yoast-generate-post/v2/postID/{$tmdb}/api/4cd9cd25-fc28-4089-9977-70377dc6cd4f/blinks/{$enlaces_api}/blang/{$idioma_api}/bcalidad/{$calidad_api}/type/create/tr/{$type_api}/poster/{$poster}/addlink/{$addlink}";

    $url2 = "https://maxpelis.tk/rest-api/v130/createMovies?API-KEY=b61gaoi3iq2sdzrs5j2n1sbv&postID={$tmdb}&blinks={$enlaces_api}&blang={$idioma_api}&bcalidad={$calidad_api}&type=create&tr={$type_api}&addlink={$addlink}";
            
    // https://music.dix.com.co:8090/px?url=https://maxpelis.tk/rest-api/v130/createMovies?API-KEY=b61gaoi3iq2sdzrs5j2n1sbv&postID=293670&blinks=WyJodHRwczovL2Zvcm1hdGVhcndpbmRvd3MubmV0L2VtYmVkLmh0bWwjY0hkbFNHVTJWamN6VVVWUE9ETk5VWEkwVVdWcFRFazNTR0ZMYmpaYVdVTlFkU3R2VkdFelVHYzROVkpOWjNBdmMzUnVkbE53V2xkUVR6WnRTazVHY1ZKbWQwSlhRalJuZEdzemIyUmpVbVZMTnpkSlNYUXlUSGxtU0d4cllVWjZTM2xqUmtKM2VXeElZVXAwTldKMVN6VkZVelZTTms0d1pISjNPVnBGV1VaeGJEaGlVakl5VlNzMGJqbDROR1kzVG0xQ05rcEJQVDAiLCJodHRwczovL2hxcS50by9lL2JIVkRWWEo1YTJNd2NXTm9jR1U0ZUhOSGNHTXhVVDA5IiwiaHR0cHM6Ly9mZW1iZWQuY29tL3YvNnozM3FmMHd3ZWs2cTFkIiwiaHR0cHM6Ly9tZWdhLm56LyMhWFE0VWtSWkwhc0hER1R4MjhtLUUxd1FhcHBpX09RNk1EMmNiVnFOeDB5NWxYSHJIblZjcyIsImh0dHBzOi8vdXB0b2JveC5jb20vOG0ycmhxMGpjamZoIiwiaHR0cHM6Ly9mZW1iZWQuY29tL2YvNnozM3FmMHd3ZWs2cTFkIl0==&blang=WyJMYXRpbm8iLCJMYXRpbm8iLCJMYXRpbm8iLCJMYXRpbm8iLCJMYXRpbm8iLCJMYXRpbm8iXQ===&bcalidad=MzM==&type=create&tr=WyIxIiwiMSIsIjEiLCIyIiwiMiIsIjIiXQ==&addlink=29

    // print_r($url);
    if($app){
        print_r(json_decode(file_get_contents($url2), true));
    }else{
        print_r(json_decode(file_get_contents($url), true));
    }
}
print("INICIANDO...");
// $sql_leer = "SELECT * FROM pelis WHERE id LIKE '%$id_db%' ORDER BY id";
$sql_leer = "SELECT * FROM pelis WHERE id BETWEEN '{$id_min}' AND '{$id_max}'";
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();

foreach ($resultado as $key => $value) {
    
    if ($value["calidad"] == "HD" || $value["calidad"] == "(HD)") {

        for ($i=0; $i < count($value["links"]); $i++) { 
            $calidad[$i] = $hd;
        }
        // createPost($value, $calidad, true);
        createPost($value, $calidad);
    }elseif($value["calidad"] == "CAM" || $value["calidad"] == "(CAM)"){

        for ($i=0; $i < count($value["links"]); $i++) { 
            $calidad[$i] = $cam;
        }
        // createPost($value, $calidad, true);
        createPost($value, $calidad);
    }elseif($value["calidad"] != "(1080)" && $value["calidad"] != "1080"){

        for ($i=0; $i < count($value["links"]); $i++) { 
            $calidad[$i] = $dvd;
        }
        // createPost($value, $calidad, true);
        createPost($value, $calidad);
    }

    

}




?>
