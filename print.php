<?php
include 'classes/Init.php';

$app_id = $_GET['id'];
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);

$row = $db->Row("SELECT * FROM `applicant` a INNER JOIN state s ON a.state_id = s.state_id INNER JOIN section sc ON a.section_id = sc.section_id WHERE a.app_id ='$app_id' ");

$app = new Application();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>MARYAM QUR'AN SCHOOLS, GUSAU</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <h2 align="center"><img src="dist/img/logo.png" width="100" height="100"></h2>
    <h2 align="center"> MARYAM QUR'AN SCHOOLS, GUSAU</h2>
     <h3 align="center">Application Form</h3>
     <hr> 
    <!-- Main content -->
    <div class="content">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title m-0"><i class="fa fa-edit"></i> Application Summary</h5>
              </div>
              <div class="card-body">
                <fieldset>
                <legend><i class="fa fa-address-card"></i> Personal Information <hr></legend>
               <table border="1" style="border-collapse:collapse;border:#ccc 1px solid" width="100%" align="center">
                <tr>
                   <td bgcolor="#F4F4F4" width="30%">
                     Application ID:
                   </td>
                   <td>
                     <?php echo "MQSG/".date('y')."/".sprintf('%04s',$row['app_id']); ?>
                   </td>
                   <td width="5%" rowspan="11" valign="top">
                     <img src="passport/<?php echo $row['image']  ?>" class='img img-responsive img-rounded' width="100" height="100">
                   </td>
                 </tr>
                <tr>
                  <td bgcolor="#F4F4F4">
                    First Name:
                  </td>
                  <td>
                    <?php echo $row['first_name'] ?>
                  </td>
                </tr>
                 <tr>
                   <td bgcolor="#F4F4F4">
                     Other Names:
                   </td>
                   <td>
                     <?php echo $row['other_names'] ?>
                   </td>
                 </tr>
                 <tr>
                   <td bgcolor="#F4F4F4">
                     Gender:
                   </td>
                   <td>
                     <?php echo $row['gender'] ?>
                   </td>
                 </tr>
                 <tr>
                   <td bgcolor="#F4F4F4">
                     Date of Birth:
                   </td>
                   <td>
                     <?php echo $row['date_of_birth'] ?>
                   </td>
                 </tr>
                <tr>
                  <td bgcolor="#F4F4F4">
                    State of Origin:
                  </td>
                  <td>
                    <?php echo $row['state_name'] ?>
                  </td>
                </tr>
              </table>
              <legend><i class="fa fa-book"></i> Education Backgroud <hr></legend>
            <table border="1" style="border-collapse:collapse;border:#ccc 1px solid" width="100%" align="center">
                <tr>
                  <td bgcolor="#F4F4F4">
                    Section:
                  </td>
                  <td>
                    <?php echo $row['section'] ?>
                  </td>
                  <td bgcolor="#F4F4F4">
                    Last School Attended:
                  </td>
                  <td>
                    <?php echo $row['lastschool'] ?>
                  </td>
                  <td bgcolor="#F4F4F4">
                    Last Class Attended:
                  </td>
                  <td>
                    <?php echo $row['lastclass'] ?>
                  </td>
                </tr>
               </table>
               <legend><i class="fa fa-user-md"></i> Parent/Guardian Information <hr></legend>
               <table border="1" style="border-collapse:collapse;border:#ccc 1px solid" width="100%" align="center">
                   <tr>
                     <td bgcolor="#F4F4F4">
                       Guardian Full Name:
                     </td>
                     <td>
                       <?php echo $row['guardian_full_name'] ?>
                     </td>
                     <td bgcolor="#F4F4F4">
                       Occupation:
                     </td>
                     <td>
                       <?php echo $row['occupation'] ?>
                     </td>
                     <td bgcolor="#F4F4F4">
                       Relationship with Applicant:
                     </td>
                     <td>
                       <?php echo $row['relationship'] ?>
                     </td>
                   </tr>
                   <tr>
                     <td bgcolor="#F4F4F4">
                       Home Address:
                     </td>
                     <td>
                       <?php echo $row['home'] ?>
                     </td>
                     <td bgcolor="#F4F4F4">
                       Office Address:
                     </td>
                     <td>
                       <?php echo $row['office'] ?>
                     </td>
                     <td bgcolor="#F4F4F4">
                       Phone:
                     </td>
                     <td>
                       <?php echo $row['phone_number'] ?>
                     </td>
                   </tr>
                   <tr>
                     <td bgcolor="#F4F4F4">
                       Email:
                     </td>
                     <td>
                       <?php echo $row['email'] ?>
                     </td>
                   </tr>
                  </table>
                  <legend><i class="fa fa-hospital"></i> Health Status <hr></legend>
                  <table border="1" style="border-collapse:collapse;border:#ccc 1px solid" width="100%" align="center">
                      <tr>
                        <td bgcolor="#F4F4F4">
                          Does Applicant Use Glasses:
                        </td>
                        <td>
                          <?php echo $row['glasses'] ?>
                        </td>
                        <td bgcolor="#F4F4F4">
                          Applicant Health Complaint:
                        </td>
                        <td>
                          <?php echo $row['health'] ?>
                        </td>
                        <td bgcolor="#F4F4F4">
                          Last Immunization:
                        </td>
                        <td>
                          <?php echo $row['immune'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor="#F4F4F4">
                          Genotype:
                        </td>
                        <td>
                          <?php echo $row['genotype'] ?>
                        </td>
                        <td bgcolor="#F4F4F4">
                          Blood Group:
                        </td>
                        <td>
                          <?php echo $row['blood'] ?>
                        </td>
                      </tr>
                     </table>
               <p></p>
                <table style="border-collapse:collapse;border:#ccc 1px solid" width="100%" align="center">
                <tr>
                   <td  width="20%">
                     Screening Date:
                   </td>
                   <td>
                   <?php  $date = $app->getScreeningDate();
                      $dates = explode("-",$date);
                      //var_dump($dates);
                      $mktime = mktime(12,0,0,$dates[1],$dates[2],$dates[0]);
                      $date = getdate($mktime);
                      echo $date['weekday'].','.$date['month']. ' '.$date['mon'].','.$date['year'] .' 8:00am';
                    ?>
                   </td>
                </tr>
               </table>
               <p></p>
                <table style="border-collapse:collapse;border:#ccc 1px solid" width="100%" align="center">
                 <tr>
                   <td class="text-center">
                     <b>NOTE:</b><br/>
                     This is not an offer for admission.<br/>
                     Bring all necessary writing materials on your screening exam date.<br/>
                     Come along with this slip for reference purpose.<br/>
                     You should note come for examination before or after your exam date.<br/>
                     School authority may assign you to a class other than the applied one based on your performance.
                   </td>
                 </tr>
               </table>
               <p style="text-align:center"><br><button class="btn btn-primary" onclick="window.print();window.location='ApplicationForm.php'"><i class="fa fa-print"></i> Print</button></p>
             </fieldset>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
