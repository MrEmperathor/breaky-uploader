<?php
ini_set('error_reporting', E_ALL|E_STRICT);
ini_set('display_errors', '1');
require('dom/simple_html_dom.php');
$token = "b9d54811cbcacc462be76437ee8c46f36ycyv";

// $url = 'https://uptobox.com/api/user/me?token='.$token; //www70.uptobox.com/upload?sess_id=x1h07ne4xz8b40j8
$url = 'https://uptobox.com';

$html = file_get_html($url);
$rrl = "https:".$html->find('form[id=fileupload]', 0)->attr['action'];
$sses_id = "x1h07ne4xz8b40j8";
$rrr = $rrl."?sess_id=".$sses_id;
$file = "JHWK39412.avi";


if (function_exists('curl_file_create'))
{
    $cFile = curl_file_create($file);
} else 
  {
    $cFile = '@' . realpath($file);
  }

  // POST the file & user_id to the server
$post = array('file'=> $cFile);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$rrr);
curl_setopt($ch, CURLOPT_POST,0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec ($ch);
curl_close ($ch);
$result = json_decode($result, true);
print $result['files'][0]['url'];

// $resultt = substr($result,0,-1);
// $obj = json_decode($result);
// print $obj->{'url'}; // 12345

// $resultt = $result;
// print_r(json_decode($resultt));
// echo $resultt;


// $resultt = {"files":[{"name":"JHWK39411.avi","size":1075240548,"url":"https://uptobox.com/ws2ty809g7x0","deleteUrl":"https://uptobox.com/ws2ty809g7x0?killcode=bmcr9vy5dc"}]};
// echo('<pre>');
// print_r(json_decode($result, true));
// // $resultt = json_decode($resultt, true);
// // var_dump($resultt);
// echo('</pre>');

// var_dump($resultt['files'][0]['name']);
// echo substr($result,0,-1)."";











// echo('<pre>');
// var_dump($html->find('form[id=fileupload]', 0)->attr['action']);
// echo('</pre>');
// // Find all images
// foreach($html->find('img') as $element){

//        echo $element->src . '<br>';
// }

// // Find all links
// foreach($html->find('a') as $element){
//        echo $element->href . '<br>';
// }
?>