<?php 
require_once '../../classes/Init.php';

$card = $_GET['card'];

$pin = new Pin();

$rows = $pin->conn->SqlRows('pin',array('card_number'),array($card));
if($rows == 1)
	 echo "Valid Pin";
else
	echo "Invalid Pin";
 ?>