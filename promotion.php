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
            <h1 class="m-0 text-dark">Student Promotion</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student Promotion</li>
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
                <h3 class="card-title">Student Promotion</h3>
              </div>
              <form action="" method="POST">
              <div class="card-body">
                      <div class="form-group row">
                        <div class="col-lg-12">
                          Admission Number
                         <input type="text" name="admno" class="form-control">
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
                $admno = $_POST['admno'];
                $section = $_SESSION['section'];
                
                $query = "SELECT * FROM applicant INNER JOIN student  USING(app_id) WHERE section_id='$section' AND admission_number='$admno'";

                $row = $db->Row($query);?>

                <form action="" method="POST">
                  <div class="form-group row">
                    <div class="col-lg-6">
                      Student Name
                      <input type="text" name="name" value="<?php echo $row['first_name']." ".$row['other_names'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-lg-6">
                      Admission Number
                      <input type="text" name="admno" value="<?php echo $row['admission_number'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-lg-6">
                      Current Class
                      <?php 
                      $clas = $db->Row("SELECT * FROM class WHERE class_id='".$row['cur_class_id']."'");
                       ?>
                       <input type="text" name="cur_class" value="<?php echo $clas['class'] ?>" readonly class="form-control">
                    </div>
                    <div class="col-lg-6">
                      Promote to
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
                      <br>
                      <button type="submit" name="promote" class="btn btn-success"><i class="fa fa-check-square"></i> Promote</button>
                    </div>
                  </div>
                </form>
                
      <?php      }



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


