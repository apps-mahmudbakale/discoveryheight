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
          <h2 style="text-transform: uppercase; margin-left: 23px;">Add Student Data</h2>
          <hr>
          <div class="col-md-12">
            <?php
              if (isset($_POST['upload'])) {

                    $othername = str_replace("'", "", $_POST['othernames']);
                    $firstname = str_replace("'", "", $_POST['firstname']);
                    $gender = $_POST['gender'];
                    $guardian = str_replace("'", "", str_replace('.', '', $_POST['guardian']));
                    $phone = $_POST['phone'];
                    $section = $_POST['section'];
                    $class = $_POST['class'];
                    $entry_year = $_POST['year'];

                    $rows = $db->Row("SELECT MAX(app_id) AS app_id FROM applicant");
                    $app_id = $rows['app_id'] + 1;
                    $date = date('Y-m-d');

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
                  success('Imported');
              
              }
                   ?>
             <form action="" method="POST" class="row">
               <div class="col-md-6">
                 First Name
                 <input type="text" name="firstname" class="form-control">
               </div>
                 <div class="col-md-6">
                 Other Names
                 <input type="text" name="othernames" class="form-control">
               </div>
               <div class="col-lg-6">
                 Gender:
                 <select name="gender" id="gender" class="form-control">
                    <option>Male</option>
                    <option>Female</option>
                 </select>
               </div>
               <div class="col-md-6">
                 Guardian Fullname
                 <input type="text" name="guardian" class="form-control">
               </div>
               <div class="col-md-6">
                 Phone
                 <input type="text" name="phone" class="form-control">
               </div>
               <div class="col-lg-6">
               Section:
               <select name="section" id="section" class="form-control">
                 <?php 
                   $section = new Section();
                   $sections = $section->getSections();

                   foreach($sections as $row){
                       echo "<option value='{$row['section_id']}'>{$row['section']}</option>";
                   }
                  ?>
               </select>
                </div>
                  <div class="col-lg-6">
                  Class:
                  <select name="class" id="class" class="form-control">
                  </select>
                </div>
                <?php $years = range(2010, strftime("%Y", time())); ?>
                <div class="col-md-6">
                  Year of Entry
                  <select name="year" id="year" class="form-control">
                    <?php foreach($years as $year) : ?>
                       <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                     <?php endforeach; ?>
                  </select>
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
  $(document).ready(()=>{
      $('#section').change(()=>{
       var section = $('#section').val();
        // alert(section);
        $.ajax({
            type: 'GET',
            url: 'getClass.php',
            data:{section_id:section},
            cahche: false,
            success: ((data)=>{
              $('#class').html(data);
            })
        })
      })
  });
 </script>
</body>
</html>
