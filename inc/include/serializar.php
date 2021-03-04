#!/usr/bin/php
<?php 
unset($argv[0]);
$tEn = base64_encode(serialize($argv));
echo $tEn;

 ?>
