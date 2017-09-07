<?php

date_default_timezone_set('Asia/Tokyo');
$timestamp = time();
$name = "watch";
$content = date( "H時i分s秒" , $timestamp );
echo "{ 'name' : '" . $name . "', 'content' : '" . $content . "' }";
?>
