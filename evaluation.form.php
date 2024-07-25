<?php
include 'classes/Init.php';
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$id = base64_decode($_GET['id']);

$row = $db->Row("SELECT * FROM staff_evaluation INNER JOIN users ON staff_evaluation.staff_id = users.user_id WHERE staff_evaluation.eva_id ='$id'");

?>
<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maryam Quran Schools, Gusau</title>
 <link rel="stylesheet" href="dist/bootstrap.min.css"> 
   <script src="plugins/jquery/jquery.min.js"></script>
</head>
<body id="print">
  <div class="container-fluid">
    <h2 align="center"><img src="dist/img/logo.png" width="100" height="100"></h2>
      <h2 align="center"> MARYAM QURAN SCHOOLS, GUSAU, ZAMFARA STATE</h2>
      
        <h4 align='center'>Motto:Islam is Light.</h4>
        <h4 align='center'>Address: No. 1 GRA Sokoto Road Gusau, Zamfara State.</h4>
        <h4 align='center'>P.O.BOX 236, GUSAU, Zamfara State.</h4>
        <h4 align='center'>TEL: 080987654321</h4>
        <p>&nbsp;</p>
        <h3 align='center'><u>STAFF MONTHLY SALARY CLEARANCE FORM</u></h3>
        <table class="table table-striped">
          <tr>
            <th class="success">STAFF NAME:</th>
            <th><?php echo $row['firstname']." ".$row['lastname'] ?></th>
            <th class="success">MONTH</th>
            <th><?php echo date('M', strtotime('2020-'.$row['month'].'-01')) ?></th>
            <th class="info">YEAR:</th>
            <th><?php echo $row['year']; ?></th>
          </tr>
        </table>
        <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">POINTS OBTAINED</p>
        <p></p> 
          <table width='100%' class="table table-striped table-responsive" class='col-lg-12 col-md-12 col-sm-12' style='border-collapse:collapse' border='1'>
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Evaluation</th>
                    <th>Points</t>
                  </tr>
                </thead>
                <tbody>
                 <tr>
                   <td>1</td>
                   <td>Attendane</td>
                   <td><?php echo $row['attendance'] ?></td>
                 </tr>
                 <tr>
                   <td>2</td>
                   <td>Lesson Note</td>
                   <td><?php echo $row['lesson_note'] ?></td>
                 </tr>
                 <tr>
                   <td>3</td>
                   <td>Lesson Plan</td>
                   <td><?php echo $row['lesson_plan'] ?></td>
                 </tr>
                 <tr>
                   <td>4</td>
                   <td>Assign Duties</td>
                   <td><?php echo $row['assign_duties'] ?></td>
                 </tr>
                 <tr>
                   <td>5</td>
                   <td>Extra Curricular</td>
                   <td><?php echo $row['extra'] ?></td>
                 </tr>
                 <tr>
                   <td>6</td>
                   <td>Morning Assembly</td>
                   <td><?php echo $row['assembly'] ?></td>
                 </tr>
                </tbody>
          </table>
          <div class="row">
            <div class="col-lg-6">
              <hr style="border-color: black; width: 235px;"><br><p align="center">Staff Signature</p>
            </div>
            <div class="col-lg-6">
              <hr style="border-color: black; width: 235px;"><br><p align="center">Principal Sign & Official Stamp</p>
            </div>
            <br>
            <div align="center" class="col-lg-12">
              <hr style="border-color: black; width: 235px;"><br><p>Chairman/Staff Officer</p>
            </div>
          </div>
  </div>

  <p style="text-align:center"><button onclick="window.print();window.close();">Print</button></p>
  <script>
        function printFormat() {
        var content = $('#print').html();
        var title = 'Staff Evaluation Form';


        var newWindow = window.open('',content);
        newWindow.document.write("<html><head><title>"+title+"</title><link rel='stylesheet' type='text/css' href='stylesheets/bootstrap.min.css'/><link rel='stylesheet' type='text/css' media='print' href='stylesheets/styles.css'/></head><body>"+content+"</body></html>");
        newWindow.print();

      }
  </script>
</body>
</html>
