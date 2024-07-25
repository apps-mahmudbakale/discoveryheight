<?php
include '../classes/Init.php';
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);

if (isset($_POST['price']) && isset($_POST['id'])) {
	$price = $_POST['price'];
	$class_price_id = $_POST['id'];
	$admno = $_POST['admno'];
	$count = $db->NumRows("SELECT * FROM temp_invoice WHERE class_price_id ='$class_price_id' AND status='0'");
	if ($count >= 1) {
		$db->query("DELETE FROM temp_invoice WHERE class_price_id ='$class_price_id' AND status='0'");
	}else{
		$db->query("INSERT INTO `temp_invoice`(`tem_inv_id`, `admno`, `class_price_id`, `price`) VALUES (NULL, '$admno','$class_price_id','$price')");
	}

	$row = $db->Row("SELECT SUM(price) AS value FROM temp_invoice WHERE status ='0'");
	$total = $row['value'];
    
	$words = new NumberFormatter("En", NumberFormatter::SPELLOUT);
    $text = strtoupper($words->format($total))." NAIRA ONLY";


	
}
$data = array('total'=>number_format($total), 'text'=>$text);

	echo json_encode($data);
 ?>