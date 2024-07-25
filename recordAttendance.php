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
            <h1 class="m-0 text-dark">Record Student Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Record Attendance</li>
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
                <h3 class="card-title">Record Student Attendance</h3>
              </div>
              <!-- /.card-header -->
              <div id="status">
                  <?php
                   if(isset($_POST['save'])) {
                      $x = 0;
                      $y = 0;

                      foreach ($_POST as $key => $value) {
                          
                          $student_id = str_replace("p","",$key);
                          //echo $student_id;
                          if($student_id != 0) {
                             //echo 1;
                             $present = $_POST["p".$student_id];
                             $late = $_POST["l".$student_id];
                             $term = $_POST['term'];
                             $session = $_POST['session'];
                             $fields = array(
                                          array(
                                            'name'=> 'p'.$student_id,
                                            'app_name' => 'd',
                                            'isRequired' => true,
                                            'dig-only' => true
                                          ),
                                          array(
                                            'name'=> 'l'.$student_id,
                                            'app_name'=>'d',
                                            'isRequired' => true,
                                            'dig-only' => true
                                          ),
                                       );
                             $Validation = new Validation($fields,'POST');
                              if($Validation->out == 1) {

                                $query = "SELECT student_id FROM student_attendance WHERE student_id='$student_id' AND session='$session' AND term='$term'";

                                if($db->NumRows($query) == 0) {
                                    
                                   $query1 = $db->Insert('student_attendance',
                                              array('student_id','session','term','present_value','late_value'),
                                              array($student_id,$session,$term,$present,$late)
                                              );
                                   
                                    $y = 1;
                                } else {

                                $db->query("UPDATE student_attendance SET present_value='$present',late_value='$present' WHERE session='$session' AND term='$term' AND student_id='$student_id'");
                                    $y = 2;
                                }
                              } else {
                                $x++;
                              }
                          }
                      }
                      if($y == 1) 
                        success("Attendance record added");
                      elseif($y == 2)
                        success("Attendance record updated");
                      if($x > 0) 
                        error("All fields are required and must be of integer");
                  }
                  ?>
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
              </div>
              <div class="card-footer">
                <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
              </div>
              <!-- /.card-body -->
            </form>
            </div>
          <?php
            if (isset($_POST['search'])) {
              $class_id = $formClass['class_id'];
              $term = $_POST['term'];
              $session = $_POST['session'];
              $query = "SELECT * FROM student INNER JOIN applicant USING(app_id) WHERE class_id='$class_id'";
                echo "<div class='col-lg-12'><form method='post' action=''>
                <input type='hidden' name='term' value='".$term."'>
                <input type='hidden' name='session' value='".$session."'>
                <table width='100%' class='table' style='border-collapse:collapse;border:#ccc 3px solid'>";
                echo "<tr valign='bottom' height='160px' bgcolor='#C5D6E7'>";
                  echo "<td  style='border-right:#bbb 1px solid' width='1%'><b>SN</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='10%'><b>ADM. NO</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='60%'><b>FULL NAME</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='3%'><b>PRESENT</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='3%'><b>LATE</b></td>";
                echo "</tr>";
                $sn=0;
                foreach($db->Rows($query) as $row) {
                  $sn++;
                  echo "<tr>";
                   echo "<td style='border:#bbb 1px solid;' bgcolor='#C5D6E7'>".$sn."</td>";
                   echo "<td style='border:#bbb 1px solid;'>".$row['admission_number']."</td>";
                   echo "<td style='border:#bbb 1px solid;'>".$row['first_name'].' '.$row['other_names']."</td>";
                   echo "<td style='border:#bbb 1px solid;'>";
                   $query = "SELECT present_value,late_value  FROM student_attendance INNER JOIN student USING(student_id) WHERE admission_number='$row[admission_number]' AND session='$session' AND term=$term";
                   $rx = $db->Row($query);
                     echo "<input type='text' name='p$row[student_id]' size='3' value='$rx[present_value]'/>";
                   echo"</td>";
                   echo "<td style='border:#bbb 1px solid;'>";

                     echo "<input type='text' name='l$row[student_id]'  size='3' value='$rx[late_value]'/>";
                   echo"</td>";
                  echo "</tr>";
                }
                echo "</table><p></p>";
                echo "<button name='save' class='btn btn-success'> Save</button>";
                echo "</form>";
              }
                ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>





