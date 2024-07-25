<?php
include "../classes/Init.php";
$start = microtime();
$size = $_GET['size'];
$file = "../db/".date('y-m-d-h-i-s').'.sql';
$uploaded_size = @filesize($file);
$uploaded_size = $uploaded_size == 0 ? $size : $uploaded_size;
echo round(($uploaded_size/$size)*100,1);
?>