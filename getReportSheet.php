<?php
include 'classes/Init.php';
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$data = base64_decode($_GET['data']);

$values = explode('|', $data);

//print_r($values);
$session = $values[0];
$term = $values[1];
$class_id = $values[2];
$student = $values[3];
   $query ="SELECT * FROM applicant INNER JOIN student USING(app_id) INNER JOIN student_score USING(student_id) INNER JOIN class ON class.class_id = student_score.class_id  WHERE student_score.class_id='$class_id' AND admission_number='$student' GROUP BY student_id ORDER BY student.student_id";
   $row = $db->Row($query);
$Result = new Result($row['student_id'],$class_id,$session,$term); 

?>
<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Maryam Quran Schools, Gusau</title>
 <link rel="stylesheet" href="dist/bootstrap.min.css"> 
</head>
<body>
  <div class="container-fluid">
    <h2 align="center"><img src="dist/img/logo.png" width="100" height="100"></h2>
      <h2 align="center"> MARYAM QURAN SCHOOLS, GUSAU, ZAMFARA STATE</h2>
      
        <h4 align='center'>Motto:Islam is Light.</h4>
        <h4 align='center'>Address: No. 1 GRA Sokoto Road Gusau, Zamfara State.</h4>
        <h4 align='center'>P.O.BOX 236, GUSAU, Zamfara State.</h4>
        <h4 align='center'>TEL: 080987654321</h4>
        <p>&nbsp;</p>
        <h4 align='center'>END OF TERM REPORT SHEET</h4>
        <table class="table table-striped">
          <tr>
            <td class="success"> NAME:</td>
            <td><?php echo $row['first_name']." ".$row['other_names'] ?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="success">SEX</td>
            <td><?php  echo $row['gender'] ?></td>
          </tr>
          <tr>
            <td class="warning">ADM NO.</td>
            <td><?php echo $row['admission_number'] ?></td>
            <td class="warning">CLASS</td>
            <td><?php echo strtoupper($row['class']) ?></td>
            <td class="info">TERM</td>
            <td><?php echo $term ?></td>
            <td class="info">SESSION</td>
            <td><?php echo $session ?></td>
          </tr>
          <tr>
            <td class="success">DATE</td>
            <td><?php echo date('d-m-Y'); ?></td>
            <td></td>
            <td class="warning">NO IN CLASS</td>
            <td><?php echo $Result->students; ?></td>
            <td></td>
            <td class="info">POSITION</td>
            <td><?php echo $Result->position ?></td>
          </tr>
        </table>
        <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">GRADES OBTAINED</p>
        <p></p> 
          <table width='100%' class="table table-striped table-responsive" class='col-lg-12 col-md-12 col-sm-12' style='border-collapse:collapse' border='1'>
                <thead>
                  <tr>
                    <th class='rotate'  rowspan="2"><div><span>SUBJECTS</span></div></th>
                    <th colspan="2">C.A 40 MARKS</th>
                    <th colspan="2">EXAMS 60 MARKS</t>
                    <th colspan="2">TOTAL 100 MARKS</th>
                    <th colspan="2">CLASS MARKS</th>
                    <th rowspan="2">GRADE</th>
                    <th class="rotate" rowspan="2"><div><span>REMARKS</span></div></th>
                  </tr>
                  <tr>
                    <th class="rotate"><div><span>MAX MARKS</span></div></th>
                    <th class="rotate"><div><span>MAX OBTAINED</span></div></th>
                    <th class="rotate"><div><span>MAX MARKS</span></div></th>
                    <th class="rotate"><div><span>MAX OBTAINED</span></div></th>
                    <th class="rotate"><div><span>MAX MARKS</span></div></th>
                    <th class="rotate"><div><span>MAX OBTAINED</span></div></th>
                    <th class="rotate"><div><span>MAX MARKS</span></div></th>
                    <th class="rotate"><div><span>MIN MARKS</span></div></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $TotalMaxCa =0;
                  $TotalObtainedCa =0;
                  $TotalMaxExam =0;
                  $TotalObtainedExam =0;
                  $TotalMax =0;
                  $TotalObtained =0;
                  $TotalMaxClass =0;
                  $TotalMinClass =0;

                  $subjects = is_array($Result->subjects) ? $Result->subjects : array();
                  // var_dump($subjects);
                  foreach($subjects as $s) {
                                $all = explode("?", $s);
                                $ca = $all[1] + $all[2];
                                $TotalMaxCa +=40;
                                $TotalObtainedCa +=$ca;
                                $TotalMaxExam +=60;
                                $TotalObtainedExam +=$all[3];
                                $TotalMax +=100;
                                $TotalObtained +=$all[4];
                                echo "<tr>";
                                echo '<td>'.$all[0].'</td>';
                                echo '<td align="center"  bgcolor="#FDFDFB" >40</td>';
                                echo '<td align="center" bgcolor="#FDFDFB">'.$ca.'</td>';
                                echo '<td align="center" bgcolor="#FDFDFB">60</td>';
                                echo '<td align="center" bgcolor="#FDFDFB">'.$all[3].'</td>';
                                echo '<td align="center" bgcolor="#FDFDFB">100</td>';
                                echo '<td align="center" bgcolor="#FDFDFB">'.$all[4].'</td>';
                                $xrow = $db->Row("SELECT MAX(total) as maxscore FROM (SELECT (first_ca+second_ca+exam) AS total FROM student_score
                                   WHERE subject_id='$all[5]' AND session='$session' AND class_id='$class_id' 
                                   AND term='$term') m ORDER BY total DESC");
                               $maxscore = $xrow['maxscore'];

                                $nrow = $db->Row("SELECT MIN(total) as minscore FROM (SELECT (first_ca+second_ca+exam) AS total FROM student_score
                                   WHERE subject_id='$all[5]' AND session='$session' AND class_id='$class_id' 
                                   AND term='$term') m ORDER BY total DESC");
                               $minscore = $nrow['minscore'];

                               $TotalMaxClass +=$maxscore;
                               $TotalMinClass +=$minscore;
                                echo '<td align="center" bgcolor="#FDFDFB">'.$maxscore.'</td>';
                                echo '<td align="center" bgcolor="#FDFDFB">'.$minscore.'</td>';

                                echo '<td align="center" bgcolor="#FDFDFB">'.$all[7].'</td>';
                                if ($all[7] == 'A')
                                      $remarks ="EXCELLENT";
                                elseif ($all[7] == 'B') 
                                      $remarks ="VERY GOOD";
                                elseif ($all[7] == 'C')
                                      $remarks ="GOOD";
                                elseif ($all[7] == 'D')
                                      $remarks ="PASS";
                                elseif ($all[7] == 'E')
                                      $remarks ="PASS";
                                elseif ($all[7] == 'F')
                                      $remarks ="FAIL";

                                echo '<td align="center" bgcolor="#FDFDFB">'.$remarks.'</td>';
                                echo '</tr>';
                   }

                   ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="success">Total:</th>
                    <th><?php echo $TotalMaxCa ?></th>
                    <th><?php echo $TotalObtainedCa ?></th>
                     <th><?php echo $TotalMaxExam ?></th>
                    <th><?php echo $TotalObtainedExam ?></th>
                     <th><?php echo $TotalMax ?></th>
                    <th><?php echo $TotalObtained ?></th>
                    <th><?php echo $TotalMaxClass ?></th>
                    <th><?php echo $TotalMinClass ?></th>
                    <th class="warning">AVG</th>
                    <th><?php echo $Result->average ?></th>
                  </tr>
                </tfoot>
          </table>
          <div class="row">
            <div class="col-lg-8">
              <div class="col-lg-12">
                <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">ATTENDANCE</p>
                <?php 
                $query = sprintf("SELECT present_value,late_value FROM student_attendance
                             WHERE session='%s' AND term=%d AND student_id=%d",
                             $session,$term,$row['student_id']);

                $row = $db->Row($query);

                 ?>
                <table class="table table-striped table-responsive table-bordered">
                  <thead>
                    <th>SCHOOL DAYS</th>
                    <th>DAYS PRESENT</th>
                    <th>DAYS ABSENT</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td><?php echo $row['present_value'] ?></td>
                      <td><?php echo $row['late_value'] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-12">
                <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">HEALTH INFORMATION</p>
                <table class="table table-striped table-responsive table-bordered">
                  <thead>
                    <th>ILLNESS</th>
                    <th>WEIGHT</th>
                    <th>HEIGHT</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>NIL</td>
                      <td>NIL</td>
                      <td>NIL</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-lg-12">
                <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">SCHOOL FEES INFORMATION</p>
                <table class="table table-striped table-responsive table-bordered">
                  <thead>
                    <th>TERM FEES</th>
                    <th>PAID FEES</th>
                    <th>OUTSTANDING</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="col-lg-12">
                <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">CONDUCT</p>
                  <textarea readonly cols="5" rows="5" class="form-control"></textarea>
              </div>
              <div class="col-lg-12">
                <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">CLASS TEACHER'S COMMENT</p>
                  <textarea readonly cols="5" rows="5" class="form-control"></textarea>
              </div>
              <div class="col-lg-12">
                <p class="text-center" style="background: lime; font-size: larger; font-weight: bolder;">NEXT TERM INFORMATION</p>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                      <th>TERM BEGINS</th>
                      <th>TERM FEES</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
          <p>PRINCIPAL/HEADMASTER REMARKS</p>
          <br>
          <hr style="border-color: black;">
  </div>

  <p style="text-align:center"><button onclick="window.print();window.close();">Print</button></p>
</body>
</html>
