<?php 
session_start();
include 'classes/Init.php';
$pin = new Pin();
 ?>
 <html>
  <head>
  	<title>Maryam Quran, Schools.</title>
  </head>
  <body>
  	<?php
  	 $id = base64_decode($_GET['id']);
  	
  	 $row = $pin->conn->Row("SELECT * FROM pin WHERE pin_id='$id'");
  	 $card = $row['card_number'];
  	 $section_id = $_SESSION['section'];
  	 $user_id = $_SESSION['user_id'];
  	 echo "<hr />";
  	 echo "<h3 align='center'>$row[card_number]</h3>";
  	 echo "<hr/>";
     ?>
      <button onclick="window.print();window.location='pins.php'">Print</button>
     <?php
  	 $pin->conn->query("INSERT INTO issued_pin SET pin='$card', section_id ='$section_id', user_id='$user_id'");
  	?>
  </body>
</html>