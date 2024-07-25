<?php
include 'classes/Init.php';
$app_id = base64_decode($_GET['id']);
$app = new Application();
$row = $app->conn->Row("SELECT *,YEAR(approval_date) AS d FROM applicant  INNER JOIN student  USING(app_id) INNER JOIN class USING(class_id) WHERE app_id ='$app_id'");
?>
<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maryam Quran Schools, Gusau</title>
</head>
<body>
<h2 align="center"><img src="dist/img/logo.png" width="100" height="100"></h2>
  <h2 align="center"> MARYAM QURAN SCHOOLS, GUSAU, ZAMFARA STATE</h2>
  
  <table style="padding: 34px;border:#ccc 1px solid" width="50%" align="center">
   <tr>
      <td colspan="2">
       <b><?php echo strtoupper($row['first_name'].' '.$row['other_names']) ?>, </b><br/>
       <?php echo "Address: ". $row['address']; ?><br/>
       <?php echo "Phone Number: ". $row['phone_number']; ?><br/>
      </td>
      <td width="20%" rowspan="1" valign="top">
        <img src="passport/<?php echo $row['image']  ?>" width="100" height="100">
      </td>
    </tr>
    <tr>
      <td colspan="3">
         <h3 align="center">Admission Letter</h3>
         Dear <?php echo $row['first_name'].' '.$row['other_names'] ?>, 
         <p></p>
         I am pleased to offer you an admission into <b><?php echo $row['class'] ?></b>
         Maryam Quran Schools, Gusau, Zamfara State, Nigeria.<br/>
         <p></p>
         Your Admission Number is <b>MQS/<?php echo $row['admission_number'] ?></b>.
         <p></p>
         Proceed To Cashier For School Fees Payment and Receipt Collection  
         <p></p>
         Please accept Our Congratulations<br/>
         <p></p>
         Thank you.
         <p>&nbsp;</p>
         <p style="text-align:left">Maryam Quran, <br/>Admission Office<br/></p>
      </td>
    </tr>
  </table>
  <p style="text-align:center"><button onclick="window.print();window.location='Applicants.php'">Print</button></p>
</body>
</html>
