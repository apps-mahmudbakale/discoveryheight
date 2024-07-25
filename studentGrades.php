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
            <h1 class="m-0 text-dark">Student Grades</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student Grades</li>
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
                <h3 class="card-title">Student Grades</h3>
              </div>
              <form action="" method="POST">
                <input type="hidden" name="class_id" value="<?php echo $formClass['class_id']; ?>">
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
                          Subject
                         <select name="subject_id" id="subject_id" class="form-control">
                           <?php 
                             $subject = new Subject();
                             $subject->section_id = $_SESSION['section'];
                             $subjects = $subject->getSubjects();

                             foreach ($subjects as $subject) {
                                 echo "<option value='{$subject['subject_id']}'>{$subject['subject_name']}</option>";
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
                $subject_id = $_POST['subject_id'];
                $term = $_POST['term'];
                $class_id = $_POST['class_id'];
                $session = $_POST['session'];
                
                $query = "SELECT * FROM applicant INNER JOIN student  USING(app_id) WHERE class_id='".$class_id."'";

                echo "<form method='post' action=''>
                <table width='100%' class='table' style='border-collapse:collapse;border:#ccc 3px solid'>";
                echo "<tr bgcolor='#C5D6E7'>";
                  echo "<td style='border-right:#bbb 1px solid' width='1%'><b>SN</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='5%'><b>ADM. NO</b></td>";
                  echo "<td style='border-right:#bbb 1px solid' width='20%'><b>FULL NAME</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>CA 1</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>CA 2</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>EXAM</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>TOTAL</b></td>";
                  echo "<td style='text-align:center;border-right:#bbb 1px solid' width='5%'><b>GRADE</b></td>";
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
                  echo "<td style='border:#bbb 1px solid;'>MQS/".$row['admission_number']."</td>";
                  echo "<td style='border:#bbb 1px solid;'>".$row['first_name'].' '.$row['other_names']."</td>";
                  echo "<td style='border:#bbb 1px solid;'>";
                  echo "<input onkeyup='sum($sn)' 
                        id='ca$sn' 
                        name='ca$row[student_id]' 
                        style='width:98%;border:none' 
                       value='";
                       echo (@$row2['first_ca'] == 0)? "'" : @$row2['first_ca']."'";
                        echo "type='text' class='form-control' readonly size='6'/>";
                echo " </td>";
                echo "<td style='border:#bbb 1px solid;'>";
                
                      echo "<input onkeypup='sum($sn)' 
                               id='ca2$sn' 
                               name='ca2$row[student_id]' 
                               value='";
                               echo (@$row2['second_ca'] == 0)? "'" : @$row2['second_ca']."'";
                                echo "style='border:none;width:98%' 
                               type='text' class='form-control' readonly size='6'/>";
                    
                   echo "</td>";
                                    $total = $row2['first_ca'] + $row2['second_ca'] + $row2['exam'];
                                    $total = ($total != 0) ? $total : '';
                                    if($total >= 70)
                                      $grade = 'A';
                                    elseif($total >= 60)
                                      $grade = 'B';
                                    elseif($total >= 50)
                                      $grade = 'C';
                                    elseif($total >=45)
                                      $grade = 'D';
                                    elseif($total >= 40)
                                      $grade = 'E';
                                    elseif($total > 0)
                                      $grade = 'F';

                  echo "<td align='center' style='border:#bbb 1px solid;'>";
                       
                        echo "<input onkeyup='sum($sn)' 
                                id='exam$sn' name='exam$row[student_id]' 
                                style='width:98%;border:none' 
                                value='";
                                echo ($row2['exam'] == 0)? "'" : $row2['exam']."'";
                                echo " type='text' class='form-control' readonly size='6'/>";
                        
                      echo "</td>";
                          echo "<td align='right' style='border:#bbb 1px solid;'>
                          <span id='total$sn'>$total</span></td>
                          <td align='right' style='border:#bbb 1px solid;'>
                          <span>$grade</span></td>";
                          echo "</tr>";
                }
                echo "</table><p></p>";
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

