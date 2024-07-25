<?php 
session_start();  
include "../config/Database.php";
include "../models/Order.php";
//Instantiate Database & Connect
$database = new Database();
$db = $database->Connect();


echo $invoice = $_POST['invoice'];

$query = $db->prepare("SELECT * FROM sales_order WHERE invoice='$invoice'");

$query->execute();


while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	print_r($row);
	$insert = $db->prepare("INSERT INTO `sales`(`invoice`, `item_id`, `qty`, `amount`) VALUES (:invoice,:item_id,':qty',:amount");

	$insert->execute(['invoice' =>$row['invoice'], 'item_id' =>$row['item_id'], 'qty'=>$row['qty'], 'amount' =>$row['amount']]);
}


 ?>