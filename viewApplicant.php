<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$app = new Application();
$app_id = base64_decode($_GET['id']);
$row = $app->conn->Row("SELECT * FROM `applicant` a LEFT JOIN state s ON a.state_id = s.state_id WHERE a.app_id ='$app_id'");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Applicantion Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="Applicants.php">Applicants</a></li>
              <li class="breadcrumb-item active">Applicantion Details</li>
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
                <h3 class="card-title">Applicantion Details</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                    <table class="table table-responsive">
                    
                    <tbody>
                      <tr>
                      <td colspan="3" align="center">
                        <div class="form_label">STUDENT APPLICATION DETAILS 
                  </div>
                  </td>
                    </tr>
                    <tr>
                      <td width="20%">&nbsp;</td>
                      <td width="25%">&nbsp;</td>
                      <td width="22%" rowspan="7" align="center">
                        <?php if (!empty($row['image'])): ?>
                          <img id="preview" src="passport/<?php echo $row['image']; ?>" class="img img-thumbnail" style="margin-left: 3%;" width="250px" height="220px"/><br/>
                        <?php else: ?>
                          <img id="preview" src="no_photo.png" width="250px" style="margin-left: 90%;" height="220px"/><br/>
                        <?php endif ?>
                      </td>
                    </tr>
                    <tr>
                      <td><div class="labelxx">Full Name</div></td>
                      <td><div class="labelx"><span style="font-family:Verdana, Arial, Helvetica, sans-serif;"><?php echo strtoupper($row['other_names'])." ".$row['first_name']; ?></span></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Gender</div></td>
                      <td><div class="labelx"><?php echo $row['gender'];?></div></td>
                    </tr>
                   <tr>
                      <td><div class="labelxx">Date of Birth</div></td>
                      <td><div class="labelx"><?php echo $row['date_of_birth'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">State of Origin</div></td>
                      <td><div class="labelx"><?php echo $row['state_name'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Last School Attended</div></td>
                      <td><div class="labelx"><?php echo $row['lastschool'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Last Class Attended</div></td>
                      <td><div class="labelx"><?php echo $row['lastclass'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Guardian Full Name</div></td>
                      <td><div class="labelx"><?php echo $row['guardian_full_name'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Occupation</div></td>
                      <td><div class="labelx"><?php echo $row['occupation'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Relationship With Applicant</div></td>
                      <td><div class="labelx"><?php echo $row['relationship'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Home Address</div></td>
                      <td><div class="labelx"><?php echo $row['home'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Office Address</div></td>
                      <td><div class="labelx"><?php echo $row['office'];?></div></td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Phone Number</div></td>
                      <td><div class="labelx"><?php echo $row['phone_number'];?></div></td>
                    </tr>
                    <tr>
                      <td><div class="labelxx">Email Address</div></td>
                      <td><div class="labelx"> <?php echo $row['email']; ?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><div class="labelxx">Does Applicant use Glasses</div></td>
                      <td><div class="labelx"><?php echo $row['glasses'] ?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                     <tr>
                      <td><div class="labelxx">Applicant Health Complaint</div></td>
                      <td><div class="labelx"><?php echo $row['health'] ?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                       <tr>
                      <td><div class="labelxx">Last Immunization</div></td>
                      <td><div class="labelx"><?php echo $row['immune'] ?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                       <tr>
                      <td><div class="labelxx">Applicant Genotype</div></td>
                      <td><div class="labelx"><?php echo $row['genotype'] ?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                       <tr>
                      <td><div class="labelxx">Applicant Blood Group</div></td>
                      <td><div class="labelx"><?php echo $row['blood'] ?></div></td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>

  <script>
    $('#approve').click(()=>{
      var class_id = $('#class').val();
      var term = $('#term').val();
      var app_id = $('#app_id').val();

      $.ajax({
        type: 'POST',
        url: 'Ajax/application/approve.php',
        data:{class_id:class_id,term:term,app_id:app_id},
        cache: false,
        success: ((html)=>{
           $('#status').html(html);
        })
      })
    }) 
  </script>

