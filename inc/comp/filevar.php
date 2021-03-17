<?php 
include 'xion/conexion.php';

if ($_GET['page']) {
	// $u = $_GET['page'];

	$id = $_GET['page'];
	$sql_unico = 'SELECT * FROM pelis WHERE id=?';

	$gsent_unico = $pdo->prepare($sql_unico);
	$gsent_unico->execute(array($id));

	$resultado_unico = $gsent_unico->fetch();

	// var_dump($resultado_unico);

		$links = unserialize($resultado_unico['links']);
		$name = $resultado_unico['nombre'];
        $calidad = $resultado_unico['calidad'];
        $idioma = $resultado_unico['idioma'];
		$id = $resultado_unico['id'];
		$TMDBid = $resultado_unico['TMDB'];
		$u = $resultado_unico['TMDB'];
        $linksdescarga = $resultado_unico['DLinks'];
        $LFREE = $resultado_unico['LFREE'];
        $LVIP = $resultado_unico['LVIP'];
        $convervip = $resultado_unico['7VIP'];
		$converfree = $resultado_unico['7FREE'];
		$backup_url_up = unserialize($resultado_unico['Backup']);



		
		// $links = str_replace("https://", " https://", $links);
		// $enlaces = explode("|", $links);


		// $enlaces = $links;

        $enlacesdes = $links;




        $dlinks = array(
                        "verystream" => $enlacesdes[0],
                        "mega" => $enlacesdes[1],
                        "drive" => $enlacesdes[2],
                        "macortado" => $enlacesdes[3],
                        "dacortado" => $enlacesdes[4]
                        );


		// API TMDB
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
		//curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/search/movie?query=Monsters+University&api_key=$MYAPIKEY");
		curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/movie/$u?api_key=$MYAPIKEY");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response, true);
		 // echo("<img src='". $config['images']['base_url'] . $config['images']['poster_sizes'][4] . $result['poster_path'] . "'/>");

		$titleOriginal = $result['original_title'];


		require_once('comp/funtions.php');
		$enlaces = array();
		$enlaces["verystream.com"] = (buscarDato($links,"verystream.com")) ? $links[buscarDato($links,"verystream.com")] : "No hay enlaces";
		$enlaces["hqq.to"] = (buscarDato($links,"hqq.to")) ? $links[buscarDato($links,"hqq.to")] : "No hay enlaces";
		$enlaces["drive.google.com"] = (buscarDato($links,"export=download")) ? $links[buscarDato($links,"export=download")] : "No hay enlaces";
		$enlaces["drive.google.com.VIP"] = (buscarDato($links,"drive.google.com/open?id")) ? $links[buscarDato($links,"drive.google.com/open?id")] : "No hay enlaces";
		$enlaces["mega.nz"] = (buscarDato($links,"mega.nz")) ? $links[buscarDato($links,"mega.nz")] : "No hay enlaces";
		$enlaces["short.pe"] = (buscarDato($links,"short.pe")) ? $links[buscarDato($links,"short.pe")] : "No hay enlaces";
		$enlaces["ouo.io"] = (buscarDato($links,"ouo.io")) ? $links[buscarDato($links,"ouo.io")] : "";
		$enlaces["jetload.net"] = (buscarDato($links,"jetload.net")) ? $links[buscarDato($links,"jetload.net")] : "No hay enlaces";
		$enlaces["fembed.com"] = (buscarDato($links,"fembed.com")) ? $links[buscarDato($links,"fembed.com")] : "No hay enlaces";
		$enlaces["uptobox.com"] = (buscarDato($links,"uptobox.com")) ? $links[buscarDato($links,"uptobox.com")] : "No hay enlaces";
		$enlaces["gounlimited.to"] = (buscarDato($links,"gounlimited.to")) ? $links[buscarDato($links,"gounlimited.to")] : "No hay enlaces";
		$enlaces["clicknupload.org"] = (buscarDato($links,"clicknupload.org")) ? $links[buscarDato($links,"clicknupload.org")] : "No hay enlaces";
		$enlaces["dropapk.to"] = (buscarDato($links,"dropapk.to")) ? $links[buscarDato($links,"dropapk.to")] : "No hay enlaces";
		$enlaces["prostream.to"] = (buscarDato($links,"prostream.to")) ? $links[buscarDato($links,"prostream.to")] : "No hay enlaces";
		$enlaces["upstream.to"] = (buscarDato($links,"upstream.to")) ? $links[buscarDato($links,"upstream.to")] : "No hay enlaces";
		$enlaces["mystream.to"] = (buscarDato($links,"mystream.to")) ? $links[buscarDato($links,"mystream.to")] : "No hay enlaces";

		// if (!empty($backup_url_up)) {
			
		// 	preg_match('/(?:https?:\/\/)?(?:[\w\-]+\.)*(?:drive|docs)\.google\.com\/(?:(?:folderview|open|uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation)\/d\/|spreadsheet\/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=)([\w\-]{28,})/i', $backup_url_up[1] , $match);
		// 	$backup_urll = $match[1];
			
		// 	$api = 'http://167.86.105.129/panel/inc/comp/apis/drive_estado_720.php?id='.$backup_urll;
		// 	$averigurarCalidad = json_decode(file_get_contents($api));

		// }elseif (!empty($enlaces["drive.google.com"])) {

		// 	preg_match('/(?:https?:\/\/)?(?:[\w\-]+\.)*(?:drive|docs)\.google\.com\/(?:(?:folderview|open|uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation)\/d\/|spreadsheet\/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=)([\w\-]{28,})/i', $enlaces["drive.google.com"] , $match);
		// 	$backup_urll = $match[1];
		// 	$backup_url_up[1] = $enlaces["drive.google.com"];
			
		// 	$api = 'http://167.86.105.129/panel/inc/comp/apis/drive_estado_720.php?id='.$backup_urll;
		// 	$averigurarCalidad = json_decode(file_get_contents($api));
		// }
		
}


if ($_GET['s']) {

	$id = $_GET['s'];
	$sql_unico = 'SELECT * FROM seriess WHERE id=?';

	$gsent_unico = $pdo->prepare($sql_unico);
	$gsent_unico->execute(array($id));

	$resultado_unico = $gsent_unico->fetch();

		$name = $resultado_unico['nombre'];
		$temporada = $resultado_unico['temp'];
        $calidad = $resultado_unico['calidad'];
        $idioma = $resultado_unico['idioma'];
		$id = $resultado_unico['id'];
		$TMDBid = $resultado_unico['TMDB'];
        $linksdescarga = $resultado_unico['links'];

		// $varlinkk = explode('||', $linksdescarga);
		$varlinkk = unserialize($linksdescarga);
		$varlink = array();
		foreach ($varlinkk as $key => $value) {
			$varlink[$key] = unserialize($value);
		}


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

	curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/tv/".$TMDBid."?api_key=$MYAPIKEY");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$response = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($response, true);


	$titleOriginal = $result['original_name'];

	// $DDD = str_replace(".", " ", "$DD");
}



// }
//  if ($_GET['search']) {
//  	$buscar = $_GET['search']
// 	$sql_leer = "SELECT * FROM pelis WHERE nombre LIKE '%$buscar%' ORDER BY nombre";
// 	$gsent = $pdo->prepare($sql_leer);
// 	$gsent->execute();

// 	$resultado = $gsent->fetchAll();
// print "\n";
// 	foreach ($resultado as $datos) {
// 		echo $datos['nombre']." ".$datos['calidad']." ".$datos['idioma'];
// 		print "\n";
// 	}
// print "\n";
//  }