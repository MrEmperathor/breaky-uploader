#!/usr/bin/php
<?php 

$link = $argv[1];

if (!preg_match('@https?://(?:[\w\-]+\.)*(?:drive|docs)\.google\.com/(?:(?:folderview|open|(?:a/[\w\-\.]+/)?uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation|spreadsheets)/d/|spreadsheet/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=|drive/folders/)([\w\-]{28,})@i', $link, $ID)) echo('File/Folder ID not found at link.');

echo $ID[1];

?>