<?php
$curl = curl_init();
$user = 'nike90al@gmail.com';
$password = 'altlvc123!';
$login = "login=".$user."&password=".$password;

curl_setopt_array($curl, array(
CURLOPT_URL => "https://uptobox.com/login",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HEADER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_SSL_VERIFYHOST => 0,
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => $login,
));

$response = curl_exec($curl);
$err = curl_error($curl);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
$cookies = array();
foreach($matches[1] as $item) {
parse_str($item, $cookie);
$cookies = array_merge($cookies, $cookie);
}

curl_close($curl);

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $cookies['xfss'];
}
?>
