<?php  
include 'classes/Init.php';
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
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

  <title>Maryam Quran Schools | Import</title>

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
          <div class="col-md-12">
            <?php
              if (isset($_POST['upload'])) {

                     $data = array();
                     move_uploaded_file($_FILES['file']['tmp_name'], 'data.csv');
                     $file = fopen("data.csv", "r");

                     $number = array();
                     $score = array();

                     $data = [];

                     while($row = fgetcsv($file,100000,',')) {
                        
                          $x['othername'] = $row[0];
                          $x['firstname'] = $row[1];
                          $x['gender'] = $row[2];
                          $x['guardian'] = $row[3];
                          $x['phone'] = $row[4];
                           if ($row[5] == 'NURSERY') {
                             $x['section'] = '1';
                          }else if ($row[5] == 'PRIMARY') {
                            $x['section'] = '1';
                          }elseif ($row[5] == 'TAHFIZ') {
                             $x['section'] = '2';
                          }elseif ($row[5] == 'SECONDARY') {
                            $x['section']= '3';
                          }
                          if ($row[6] == 'ONE') {
                              $class = $row[5]." 1";
                          }elseif($row[6] == 'TWO'){
                            $class = $row[5]." 2";
                          }elseif ($row[6] == 'THREE') {
                            $class = $row[5]." 3";
                          }elseif ($row[6] == 'FOUR') {
                            $class = $row[5]." 4";
                            
                          }elseif ($row[6] == 'FIVE') {
                            $class = $row[5]." 5";
                          }elseif ($row[6] == 'SIX') {
                            $class = $row[5]." 6";
                          }

                          if ($row[6] == 'JSS ONE') {
                              $class = 'JSS 1';
                          }elseif ($row[6] == 'JSS TWO') {
                            $class = 'JSS 2';
                          }

                          if ($row[5] == 'TAHFIZ') {
                              $class = "Faslu ".$row[6];
                          }

                          $rows = $db->Row("SELECT class_id  FROM class WHERE class ='$class'");
                          $x['class_id'] = $rows['class_id'];
                          $x['entry_year'] = $row[7] ? $row[7] : date('Y');
                          $data[] = $x;

                          //print_r($data);
                         
                     }
                    
                     foreach($data as $row) {
                      $rows = $db->Row("SELECT MAX(app_id) AS app_id FROM applicant");
                      $app_id = $rows['app_id'] + 1;
                      $date = date('Y-m-d');

                      $othername = str_replace("'", "", $row['othername']);
                      $firstname = str_replace("'", "", $row['firstname']);
                      $gender = $row['gender'];
                      $guardian = str_replace("'", "", str_replace('.', '', $row['guardian']));
                      $phone = "0".$row['phone'];
                      $section = $row['section'];
                      $class = $row['class_id'] ? $row['class_id'] : 0;
                      $entry_year = $row['entry_year'];

                      $query = $db->query("SELECT * FROM applicant WHERE first_name = '$firstname' AND other_names ='$othername' AND gender ='$gender' AND guardian_full_name ='$guardian' AND section_id ='$section'");


                      if (mysqli_num_rows($query) >= 1) {
                      
                      }else{
                        $rows = $db->NumRows("SELECT * FROM student");
                        $admNo = substr($entry_year, 2)."/".sprintf('%03s',$rows +1);
                      $db->Insert('applicant',
                            array('app_id', 'first_name', 'other_names', 'gender', 'guardian_full_name', 'phone_number', 'section_id', 'status'),
                            array($app_id, $firstname, $othername, $gender, $guardian, $phone, $section, '1')
                        );
                      $db->Insert('student',
                            array('app_id','admission_number','class_id','cur_class_id','entry_year','approval_date'),
                            array($app_id, $admNo, $class, $class, $entry_year, $date)
                        );


                      }

                       
                     }
                  success('Imported');
              
              }
                   ?>
             <form action="" method="POST" enctype="Multipart/form-data">
               <div class="col-md-8">
                 CSV File:
                 <input type="file" name="file" class="form-control">
               </div>
               <div class="col-md-6">
                 <br>
                 <button type="submit" name="upload" class="btn btn-success">Upload</button>
               </div>
             </form>
             <br>
             <br>
          </div>
        
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
