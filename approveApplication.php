<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$app = new Application();
$app_id = base64_decode($_GET['id']);
$row = $app->conn->Row("SELECT * FROM `applicant` a INNER JOIN state s ON a.state_id = s.state_id INNER JOIN section sc ON a.section_id = sc.section_id WHERE a.app_id ='$app_id' ");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Approve Applicantion</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="Applicants.php">Applicants</a></li>
              <li class="breadcrumb-item active">Approve Applicantion</li>
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
                <h3 class="card-title">Approve Applicantion</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                    <table class="table table-striped">
                      <tr>
                        <td><b>Full Name:</b></td>
                        <td><?php echo $row['first_name'].' '.$row['other_names']; ?></td>
                        <td><b>Gender:</b></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><b>Date of Birth:</b></td>
                        <td><?php echo $row['date_of_birth']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Address:</b></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><b>Nationality:</b></td>
                        <td><?php echo $row['nationality']; ?></td>
                        <td><b>State of Origin:</b></td>
                        <td><?php echo $row['state_name']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Guardian:</b></td>
                        <td><?php echo $row['guardian_full_name'] ?></td>
                        <td><b>Phone:</b></td>
                        <td><?php echo $row['phone_number']; ?></td>
                        <td><b>Email:</b></td>
                        <td><?php echo $row['email']; ?></td>
                      </tr>
                    </table>
                    <br><hr>
                      <div class="form-group row">
                        <input value="<?php echo $row['app_id'] ?>" id="app_id" type="hidden">
                        <div class="col-lg-6">
                        Class:
                        <select name="class" id="class" class="form-control">
                          <?php 
                            $class = new Classes();
                            $classes = $class->getClasses();

                            foreach ($classes as $class) {
                                echo "<option value='{$class['class_id']}'>{$class['class']}</option>";
                            }

                           ?>
                        </select>
                      </div>
                      <div class="col-lg-6">
                        Term:
                        <select name='term' id="term" class='form-control'>
                           <?php for($i=1;$i<=3;$i++) echo "<option>".$i."</option>";?>
                        </select>
                      </div>
                      </div>
                    
              </div>
              <div class="card-footer">
                <button type="submit" id="approve" class="btn btn-success">Approve</button>
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

