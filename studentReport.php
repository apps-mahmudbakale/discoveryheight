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
            <h1 class="m-0 text-dark">Student Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student Report</li>
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
                 <h3 class="card-title">Student Report</h3>
               </div>
               <!-- /.card-header -->
               <form action="" method="POST">
               <div class="card-body">
                       <div class="form-group row">
                        <div class="col-lg-6">
                          Admission Number
                          <input type="text" name="adm_no" class="form-control">
                        </div>
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
                     
               </div>
               <div class="card-footer">
                 <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
               </div>
               <!-- /.card-body -->
             </form>
             </div>
            <!-- /.card -->

            <?php 
              if (isset($_POST['search'])) {
                  $session = $_POST['session'];
                  $term = $_POST['term'];
                  $class_id = $formClass['class_id'];
                  $student = $_POST['adm_no'];
                   $url = base64_encode($session."|".$term."|".$class_id."|".$student);

                   echo '<script>window.open("getReportSheet.php?data='.$url.'", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=600,height=400");</script>';

               
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


