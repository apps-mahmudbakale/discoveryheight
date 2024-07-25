<?php
include "../classes/Init.php";
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$file = "db/backup_at_".date('y-m-d-h-i-s').'.sql';
exec("mysqldump --host=localhost --user=mahmudbakale --password=root skul>$file");
?>