<?php 
$id = $_GET['id']; 
$ur = 'http://drive.google.com/get_video_info?docid=';
$url = $ur . $id;
$result = file_get_contents($url);
// echo('<pre>');
// var_dump($result);
// echo('</pre>');
if (strpos($result, 'status=ok') !== false) {

    preg_match('/(&fmt_stream_map=)(.*)(&url_encoded_fmt_stream_map)/', $result, $matches);
    $result = urldecode($matches[2]);
    $ru = explode('|', $result);
    // $ru[1] 360
    // $ru[2] 720
    // $ru[3] 1080
    // $ru[4] 480
    echo('<pre>');
    print_r($ru);
    echo('</pre>');

    $inicial = substr($ru[2], 0, -3);
    echo $inicial;
}else {
    echo "false";
}

?>  