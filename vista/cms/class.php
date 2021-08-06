<?php 
class ExtraEnlaces{

    public function EnlacesHome($url){
        
        $html = file_get_html($url);

        $links = array();
        $img = array();
        $title = array();
        $calidad = array();
        $ano = array();
        foreach($html->find('div#archive-content') as $ii => $i) {
            // EXTRAER IMAGENES 
            foreach ($i->find('img') as $ee => $e) {
                $img[] = $e->src;
            }
            // ESTRAER ENLACES HOMBE
            foreach ($i->find('a[href*="movies"]') as $aa => $a) {
                if ($aa % 2) {
                    $links[] = $a->href;
                }
            }
            // EXTRAER TITULOS
            foreach ($i->find('h3') as $tt => $t) {
                $title[] = trim($t->plaintext);
            }
            // EXTRAER CALIDADES
            foreach ($i->find('span.quality') as $cc => $c) {
                $calidad[] = trim($c->plaintext);
            }
            // EXTRAER ANO
            foreach ($i->find('div.data span') as $ann => $an) {
                if($ann % 2) $ano[] = trim($an->plaintext);
            }
        }
        
        $respose = array("imagen" => $img, "enlace" => $links, "title" => $title, "calidad" => $calidad, "ano" => $ano);
        $html->clear();
        unset($html);
        return $respose;
    }

    public function EnlacePlayerIdioma($link){

        if (is_array($link)) {

            $player = array();
            foreach ($link as $key => $linu) {
                
                $htmll = file_get_html($linu);
                // EXTRAER PLAYER
                foreach ($htmll->find('iframe.metaframe') as $pp => $p) {
                        
                    if (substr($p->src, -2) == "mx") {

                        $player[$key]["latino"] = "https:".$p->src;

                    }elseif (substr($p->src, -2) == "en") {

                        $player[$key]["ingles"] = "https:".$p->src;

                    }elseif (substr($p->src, -2) == "es") {

                        $player[$key]["castellano"] = "https:".$p->src;

                    }else {
                        $player[$key][$pp] = "https:".$p->src;
                    }
                }

                // foreach ($htmll->find('div.custom_fields span.valor') as $key2 => $value) {
                //     // if($value->plaintext == "Título original") $player[$key]["name_original"] = $value->plaintext;
                //     $player[$key]["name_original"] = $value->plaintext;
                // }
                // $ret = $html->find('div[class=custom_fields]');
                $player[$key]["name_original"] = $htmll->find("div.custom_fields span.valor", 0)->plaintext;
                
                $htmll->clear();
                unset($htmll);
            }
        }
        
        return $player;
    }

    public function EnlacePlayerLink($playerl){

        $htmllp = file_get_html($playerl);
        $link_players = array();
        $link_sub = array();
        $test = array();

        foreach ($htmllp->find('div#player') as $key => $lp) {
            foreach ($lp->find('ul li.option') as $ey => $lpinternos) {
                // $link_players[] = urldecode('https:'.$lpinternos->attr["data-playerid"]);
                preg_match('/url=(.*?)&sub/', urldecode('https:'.$lpinternos->attr["data-playerid"]), $drive);
                preg_match('/file=(.*?)&sub/', urldecode('https:'.$lpinternos->attr["data-playerid"]), $driveFile);
                preg_match('/&sub=(.*)/', urldecode('https:'.$lpinternos->attr["data-playerid"]), $sub);
                if(!empty($driveFile)) $drive[1] = $driveFile[1]; 
                // $test[] = 'https:'.$lpinternos->attr["data-playerid"];
                // $test[] = $drive;
                // $test[] = $sub;
                
                $datos_post = http_build_query(
                    array(
                        'url' => $drive[1],
                        'sub' => $sub[1]
                    )
                );
                $opciones = array('http' =>
                    array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $datos_post
                    )
                );
                $contexto = stream_context_create($opciones);
                // $resultado = file_get_contents('https://streamango.poseidonhd.me/repro/r.php', false, $contexto);
                file_get_contents('https://streamango.poseidonhd.cc/repro/r.php', false, $contexto);
                // $test[] = buscarDato($http_response_header,'premiumstream');


                $http_buscar = (preg_match('/location/', $http_response_header[6])) ? $http_response_header[6] : $http_response_header[5];
                preg_match('/location\: (.*)/', $http_buscar, $enlaceListo);
                
                $link_players[] = $enlaceListo[1];
                $link_sub[] = $sub[1];   
            }
            // $link_players[] = $lp->find('ul li.option')[0]->attr["data-playerid"];
        }
        // return $resultado;
        $salida = array("links" => $link_players, "sub" => $sub[1]);

        $htmllp->clear();
        unset($htmllp);

        return $salida;
        // return $test;
    }
    public function BuscarPeso($id){

        $urlDrive = 'https://drive.google.com/uc?id='.$id;
        $html = file_get_html($urlDrive);

        

        $peso = array();
        foreach ($html->find('.uc-name-size') as $key => $vg) {
            $peso = $vg->plaintext;
        }
        return $peso;

    }
}

?>