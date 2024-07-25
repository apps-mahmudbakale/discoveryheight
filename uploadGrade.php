<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Upload Grades</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Upload Grades</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        	<div class="card">
              <div class="card-header">
                <h3 class="card-title">Upload Grades</h3>
              </div>
              <!-- /.card-header -->
              <div id="status">
              <?php 
                      if (isset($_POST['upload'])) {
                          $term = !empty($_POST['term']) ? $_POST['term'] : 0;
                          $class_id = !empty($_POST['class_id']) ? $_POST['class_id'] : 0;
                          $session = !empty($_POST['session']) ? $_POST['session'] : 0;
                          $subject_id = $rowsub['subject_id'];

                               $data = array();
                                move_uploaded_file($_FILES['csv']['tmp_name'], 'file.csv');
                                $file = fopen("file.csv", "r");
                                //$cid = $row['cid'];

                                while($row = fgetcsv($file,100000,',')) {
                                    if(!@$keys) {
                                        $keys = $row;
                                    } else {
                                        $data[] = array_combine($keys,$row);
                                    }
                                    
                                }

                                foreach($data as $row) {
                                    $adm = $row['adm_no'];

                                      $rows = $db->Row("SELECT student_id FROM student WHERE admission_number ='$adm'");

                                      if(!empty($student_id = $rows['student_id'])){

                                      $first_ca = !empty($row['first_ca']) ? $row['first_ca'] : 0;
                                      $second_ca = !empty($row['second_ca']) ? $row['second_ca'] : 0;
                                      $exam = !empty($row['exam']) ? $row['exam'] : 0;

                                      if ($db->NumRows("SELECT * FROM student_score WHERE student_id = '$student_id' AND subject_id ='$subject_id' AND class_id ='$class_id' AND term ='$term' AND session ='$session'") == 1) {
                                        //echo $second_ca;
                                          $db->query("UPDATE `student_score` SET `subject_id`='$subject_id',`class_id`='$class_id',`session`='$session',`term`='$term',`first_ca`='$first_ca',`second_ca`='$second_ca',`exam`='$exam' WHERE student_id ='$student_id'");
                                      }else{

                                        $db->query("INSERT INTO `student_score`(`student_score_id`, `student_id`, `subject_id`, `class_id`, `session`, `term`, `first_ca`, `second_ca`, `exam`) VALUES (NULL,'$student_id','$subject_id','$class_id','$session','$term','$first_ca','$second_ca','$exam')");
                                      }
                                    }
                                    
                                }

                                success('Grades Uploaded Successfully');?>
                                
                                <script>
                                          setTimeout(function(){
                                            window.location='uploadGrade.php';
                                          }, 2000)
                                        </script>

                         <?php  }


                     ?>

                <br>
              </div>
              <form action="" method="POST" enctype="Multipart/form-data">

              <div class="card-body">
                <div class="form-group row">
                  <div class="col-lg-6">
                    Term
                    <select name="term" id="term" class="form-control">
                      <?php
                        for($x=1; $x<=3; $x++) {
                          
                          echo "<option>".$x."</option>";
                        }
                       ?>
                    </select>
                  </div>
                  <div class="col-lg-6">
                  Class:
                  <select name="class_id" id="class_id" class="form-control">
                    <?php 
                      $class = new Classes();
                      $class->section_id = $_SESSION['section'];
                      $classes = $class->getClasses();

                      foreach ($classes as $class) {
                          echo "<option value='{$class['class_id']}'>{$class['class']}</option>";
                      }

                     ?>
                  </select>
                </div>
                 <div class="col-lg-6">
                  Session
                  <select name="session" id="session" class="form-control">
                    <?php
                      for($x=2011; $x<=date('Y'); $x++) {
                        echo "<option ";
                        echo ($x == date('Y')) ? " selected " : " ";
                        echo ">". ($x)."/".($x+1)."</option>";
                      }
                    ?>
                  </select>
                </div>
                        <div class="col-lg-6">
                          Upload Csv
                          <input type="file" name="csv" class="form-control">
                        </div>
                      </div>
                    
              </div>
              <div class="card-footer">
                <button type="submit" name="upload" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
              </div>
              <!-- /.card-body -->
            </form>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>


