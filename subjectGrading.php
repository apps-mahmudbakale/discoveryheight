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
            <h1 class="m-0 text-dark">Grading By Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Grading By Subject</li>
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
                <h3 class="card-title">Grading By Subject</h3>
                <a href="uploadGrade.php" class="btn btn-success btn-sm float-right"><i class="fa fa-upload"></i> Upload Csv</a>
              </div>
              <!-- /.card-header -->
              <div id="status">
                <?php 
                  if (isset($_POST['save'])) {
                     $error = array();
                      foreach($_POST['student_id'] as $student_id) {
                       $ca = !empty($_POST["ca".$student_id]) ? $_POST["ca".$student_id] : 0 ;
                       $ca2 = !empty($_POST["ca2".$student_id]) ? $_POST["ca2".$student_id] : 0 ;
                       $exam = !empty($_POST["exam".$student_id]) ? $_POST["exam".$student_id] : 0 ;
                       $subject_id =  !empty($_POST['subject_id']) ? $_POST['subject_id'] : 0 ;
                       $class_id =  !empty($_POST['class_id']) ? $_POST['class_id'] : 0 ;
                       $session =  !empty($_POST['session']) ? $_POST['session'] : 0 ;
                       $term =  $_POST['term'];
                       //echo $terms;
                       $x = 0;

                       if (isset($_POST['student_id'])) {
                         $rows = $db->NumRows("SELECT * FROM student_score WHERE student_id ='$student_id' AND  subject_id ='$subject_id' AND session='$session' AND term='$term'");

                         if ($rows == 0) {
                           $db->Insert('student_score',
                              array('student_id','class_id','subject_id','session','term','first_ca','second_ca','exam'),
                              array($student_id, $class_id, $subject_id, $session, $term, $ca, $ca2, $exam)
                            );
                           success('Grades Added SuccessFully');
                         }else{
                          $x++;
                          $db->query("UPDATE student_score SET first_ca='$ca',second_ca='$ca2',exam='$exam',term='$term'
                                   WHERE student_id='$student_id' AND subject_id='$subject_id' AND class_id='$class_id'
                                   AND session='$session' AND term='$term'");
                          success('Grades Added and Updated SuccessFully');
                         }
                       }
                     }

                       //var_dump($_POST);
                  }


                 ?>
                <br>
              </div>
              <form action="" method="POST">
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
                $subject_id = $rowsub['subject_id'];
                $term = $_POST['term'];
                $class_id = $_POST['class_id'];
                $session = $_POST['session'];
                
                $query = "SELECT * FROM applicant INNER JOIN student  USING(app_id) WHERE class_id='".$class_id."'";

                echo "<form method='post' action=''>
                <table width='100%' class='table' style='border-collapse:collapse;border:#ccc 3px solid'>";
                echo "<tr bgcolor='#C5D6E7'>";
                  echo "<td style='border-right:#bbb 1px solid' width='1%'><b>SN</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='5%'><b>ADM. NO</b></td>";
                 echo "<td style='border-right:#bbb 1px solid' width='1%'></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='20%'><b>FULL NAME</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>CA 1</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>CA 2</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>EXAM</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>TOTAL</b></td>";
                echo "</tr>";

                $sn = 0;

                $rows = $db->Rows($query);


                foreach ($rows as $row) {
                  $sn++;
                   $query2 = sprintf("SELECT * FROM student_score
                          INNER JOIN student USING(student_id)  WHERE student.admission_number='%s'
                          AND subject_id=%d AND session='%s' AND term=%d
                          AND student_score.class_id=%d",$row['admission_number'],$subject_id,$session,$term,
                          $class_id);
                   $row2 = $db->Row($query2);
                  echo "<tr>";
                  echo "<td style='border:#bbb 1px solid;' bgcolor='#C5D6E7'>".$sn."</td>";
                  echo "<td style='border:#bbb 1px solid;'>".$row['admission_number']."</td>";
                  echo "<td><input type='checkbox' ";
                  echo " id='chk$sn' onclick='isOffered($sn)' name='$row[student_id]'/></td>";

                  echo "<td style='border:#bbb 1px solid;'>".$row['first_name'].' '.$row['other_names']."</td>";
                  echo "<td style='border:#bbb 1px solid;'>";
                  echo "<input onkeyup='sum($sn)' 
                        id='ca$sn' 
                        name='ca$row[student_id]' 
                        style='width:98%;border:none' 
                       value='";
                       echo (@$row2['first_ca'] == 0)? "'" : @$row2['first_ca']."'";
                        echo "type='text' class='form-control' size='6'/>";
                 echo "<input type='hidden'  name='cah$row[student_id]' value='$row2[first_ca]' />";
                 echo "<input type='hidden'  name='ca2h$row[student_id]' value='$row2[second_ca]' />";
                 echo "<input type='hidden'  name='examh$row[student_id]' value='$row2[exam]' />";
                echo " </td>";
                echo "<td style='border:#bbb 1px solid;'>";
                
                      echo "<input onkeypup='sum($sn)' 
                               id='ca2$sn' 
                               name='ca2$row[student_id]' 
                               value='";
                               echo (@$row2['second_ca'] == 0)? "'" : @$row2['second_ca']."'";
                                echo "style='border:none;width:98%' 
                               type='text' class='form-control' size='6'/>";
                    
                   echo "</td>";
                                    $total = $row2['first_ca'] + $row2['second_ca'] + $row2['exam'];
                                    $total = ($total != 0) ? $total : '';
                                    $at = round(($total + $row2['first_second_total'])/3,3);
                                    if($at >= 70)
                                      $grade = 'A';
                                    elseif($at >= 60)
                                      $grade = 'B';
                                    elseif($at >= 50)
                                      $grade = 'C';
                                    elseif($at >=45)
                                      $grade = 'D';
                                    elseif($at >= 40)
                                      $grade = 'E';
                                    elseif($at > 0)
                                      $grade = 'F';

                  echo "<td align='center' style='border:#bbb 1px solid;'>";
                       
                        echo "<input onkeyup='sum($sn)' 
                                id='exam$sn' name='exam$row[student_id]' 
                                style='width:98%;border:none' 
                                value='";
                                echo ($row2['exam'] == 0)? "'" : $row2['exam']."'";
                                echo " type='text' class='form-control' size='6'/>";
                        
                      echo "</td>";
                          echo "<td align='right' style='border:#bbb 1px solid;'>
                          <span id='total$sn'>$total</span></td>";
                         echo "<input type='hidden' name='subject_id' value='$subject_id'/>
                         <input type='hidden' name='class_id' value='$class_id'/>
                         <input type='hidden' name='session' value='$session'/>
                         <input type='hidden' name='term' value='$term'/>
                         <input type='hidden' name='student_id[]' value='$row[student_id]'/>";
                          echo "</tr>";
                }
                echo "</table><p></p>";
                echo "<button name='save' class='btn btn-success'>Save</button>";
                echo "</form><p></p>";
            }



             ?>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>

  <script type="text/javascript">
  function isOffered(x) {
      var checkbox = document.getElementById('chk'+x).checked;
      if(checkbox == true) {
         document.getElementById('ca'+x).value = 'N/A';
         document.getElementById('ca'+x).disabled = true;
         document.getElementById('ca2'+x).value = 'N/A';
         document.getElementById('ca2'+x).disabled = true;
         document.getElementById('exam'+x).value = 'N/A';
         document.getElementById('exam'+x).disabled = true;
         document.getElementById('grade'+x).value = '';
      } else {
          document.getElementById('ca'+x).value = '';
         document.getElementById('ca'+x).disabled = null;
         document.getElementById('ca2'+x).value = '';
         document.getElementById('ca2'+x).disabled = null;
         document.getElementById('exam'+x).value = '';
         document.getElementById('exam'+x).disabled = null;
      }
  }
  function sum(x) {
     document.getElementById('ca'+x).style.textAlign = 'right';
     document.getElementById('ca2'+x).style.textAlign = 'right';
     document.getElementById('exam'+x).style.textAlign = 'right';
     var ca = document.getElementById('ca'+x).value;
     var ca2 = document.getElementById('ca2'+x).value;
     var exam = document.getElementById('exam'+x).value;
     if(isNaN(ca) || ca == null) ca = 0;
     if(isNaN(ca2) || ca2 == null) ca2 = 0;
     if(isNaN(exam) || exam == null) exam = 0;
     
     if(!isNaN(ca) && !isNaN(ca2) && !isNaN(exam))
       total = parseInt(ca)+parseInt(ca2)+parseInt(exam);
     else
       total = '';

     if(total >= 70) grade = 'A'
     else if(total >=60) grade = 'B'
     else if(total >= 50) grade = 'C'
     else if(total >= 45) grade = 'D'
     else if(total >= 40) grade ='E'
     else grade = 'F'

     if(total > 100) 
       alert("Invalid total at row"+x);
     else {
       //if(!isNaN(total)) {
         document.getElementById('total'+x).innerText = total;
         document.getElementById('grade'+x).innerText = grade;
       //}
    }
  }
  </script>

  <script>
    $('#assign').click(()=>{
      var class_id = $('#class_id').val();
      var user_id = $('#user_id').val();

      $.ajax({
        type: 'POST',
        url: 'Ajax/ajax.assignFormMaster.php',
        data:{class_id:class_id,user_id:user_id},
        cache: false,
        success: ((html)=>{
           $('#status').html(html);
        })
      })
    }) 
  </script>

