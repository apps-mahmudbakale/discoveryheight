<?php  
include 'classes/Init.php';
$section_id = $_GET['section_id'];
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);

$rows = $db->Rows("SELECT * FROM class INNER JOIN section_class USING(class_id) WHERE section_id='$section_id'");


foreach ($rows as $row) {
	echo "<option value='{$row['class_id']}'>{$row['class']}</option>";
}

?>