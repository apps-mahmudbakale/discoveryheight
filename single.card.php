<?php  
include 'classes/Init.php';
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);

$staff = base64_decode($_GET['staff']);

$row = $db->Row("SELECT * FROM `staff_data` INNER JOIN users USING(user_id) INNER JOIN section USING(section_id) WHERE staff_data.staff_id='$staff'");
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Maryam Quran Schools | Staff ID Card</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">    
  <!-- Main content -->
  <br>
    <div class="content">
      <div class="container" id="print">
        <div class="row border border-primary" style="border-radius: 4px;">
          <!-- /.col-md-6 -->
          <div class="col-md-6 border border-success">
              <table class="table">
  
  <tbody>
    <tr>
    <td colspan="3" align="center">
       <img src="dist/img/stock-manager.fw.png"  class="img-responsive" width="380" height="60" alt="Maryam Quran Schools">
      <div class="form_label">STAFF IDENTIFICATION CARD
</div>
</td>
  </tr>
  <tr>
    <td width="30%">&nbsp;</td>
    <td width="53%">&nbsp;</td>
    <td width="57%" rowspan="9" align="center">
        <img id="preview" src="http://localhost:9000/passport/<?php echo $row['image'] ?>" class="img img-thumbnail" style="margin-left: 3%;" width="250px" height="220px"/><br/>
    </td>
  </tr>
  <tr>
    <td><div class="labelxx">Full Name</div></td>
     <td><div class="labelx"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;"><?php echo strtoupper($row['lastname'])." ".$row['firstname']; ?></span></div></td>
  </tr>
  <tr>
    <td><div class="labelxx">Phone</div></td>
    <td><div class="labelx"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;"><?php echo $row['phone'];?></span></div></td>
  </tr>
  <tr>
    <td><div class="labelxx">Section</div></td>
    <td><div class="labelx"> <?php echo $row['section']; ?></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div class="labelxx">Expiry Date</div></td>
    <td><div class="labelx"><?php echo date('Y') + 2?></div></td>
    <td>&nbsp;</td>
  </tr>
</tbody>
</table>
          </div>
          <div class="col-md-6  border-success border">
            <div class="col-lg-12" style="text-align: center;">
              <p></p>
            This Card is responsibility of the person whom it is described, Please if found return to the school Authorities</div>
            <br>
            <img src='barcode.php?codetype=Code128&size=70&text=<?php echo $staff; ?>&print=true' align="center" width="500" style="margin: 10px auto 20px; display: block;" alt="">
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      <br>
      <center>
        <button type="button" onclick="printDiv('print');window.location='staff.card.php'" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
      </center>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
 <script>
function printDiv(id){
        var printContents = document.getElementById(id).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
}
  </script>
</body>
</html>
