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
            <h1 class="m-0 text-dark">Current Session</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        	<!-- New User form elements -->
        	<div class="card">
        	  <div class="card-header">
                <h1>Current Session</h1>
        	  </div>
        	  <!-- /.card-header -->
        	  <!-- form start -->
        	    <div class="card-body">
                <?php 
                  if (isset($_POST['search'])) {
                      $begin = $_POST['from'];
                      $end = $_POST['to'];

                      $term = $_POST['term'];
                      $session = $_POST['session'];

                      $numRows = $db->NumRows("SELECT * FROM current_session WHERE term ='$term' AND session ='$term' AND begin_date ='$begin' AND end_date ='$end'");

                      if ($numRows >= 1) {
                          $db->query("UPDATE current_session SET session='$session', term='$term', begin_date='$begin', end_date='$end'");
                          $rows = $db->Rows("SELECT * FROM student");

                          foreach ($rows as $row) {
                            $adm = $row['admission_number'];
                            $db->Insert('student_payment',
                              array('admission_number', 'term', 'session'),
                              array($adm,$term,$session)
                            );
                          }
                        success('Session Altered Successfully');
                      }else{
                        $db->Insert('current_session',
                          array('session', 'term', 'begin_date', 'end_date'),
                          array($session,$term,$begin,$end)
                        );

                        $rows = $db->Rows("SELECT * FROM student");

                        foreach ($rows as $row) {
                          $adm = $row['admission_number'];
                          $db->Insert('student_payment',
                            array('admission_number', 'term', 'session'),
                            array($adm,$term,$session)
                          );
                        }
                        success('Session Altered Successfully');
                      }
                      ?>
                      <script>
                                setTimeout(function(){
                                  window.location='dashboard.php';
                                }, 2000)
                              </script>

               <?php   }
                 ?>

                <form action="" method="POST" class="row">
                <div class="col-lg-3">
                  Begin Date
                  <input type="date" name="from" class="form-control">
                </div>
                <div class="col-lg-3">
                  End Date
                  <input type="date" name="to" class="form-control">
                </div>
                <div class="col-lg-3">
                  Term
                  <select name="term" id="term" class="form-control">
                    <?php
                      for($x=1; $x<=3; $x++) {
                        
                        echo "<option>".$x."</option>";
                      }
                     ?>
                  </select>
                </div>
                <div class="col-lg-3">
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
                <div class="col-lg-3">
                  <br>
                  <button type="submit" name="search" class="btn btn-success"><i class="fa fa-sign-in-alt"></i> Submit</button>
                </div>
              </form>
        	    </div>
        	    <!-- /.card-body -->
        	</div>
        	<!-- /.card -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>
 

 <script>
  $(function () {
    $("#fullpayment").DataTable({
      "ordering": false
    });
  });
</script>
