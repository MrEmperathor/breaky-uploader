#!/bin/bash/php
<?php

$url = $argv[1];

$context = stream_context_create(
  array(
      "http" => array(
          "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
      )
  )
);

$data = file_get_contents("$url", false, $context);

$data = json_decode($data,true);


?>
