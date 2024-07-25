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
            <h1 class="m-0 text-dark">New Staff Evaluation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Staff Evaluation</li>
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
        	    <h3 class="card-title">Staff Evaluation</h3>
        	  </div>
            <form action="" method="POST">
        	  <!-- /.card-header -->
               <div id="status">
                <?php 
                  if (isset($_POST['submit'])) {
                    $user = $_POST['user_id'];
                    $month = $_POST['month'];
                    $year = $_POST['year'];
                    $lessonnote = $_POST['lessonnote'];
                    $lessonplan = $_POST['lessonplan'];
                    $duties = $_POST['duties'];
                    $extra = $_POST['extra'];
                    $assembly = $_POST['assembly'];

                    if ($db->NumRows("SELECT * FROM staff_evaluation WHERE staff_id ='$user' AND month ='$month' AND year ='$year'") >= 1) {
                       error('Record Exist Already');
                    }else{
                      $attend = $db->NumRows("SELECT * FROM `staff_attendance` INNER JOIN staff_data USING(staff_id) WHERE user_id ='$user'");
                       $db->Insert('staff_evaluation',
                          array('staff_id', 'attendance', 'lesson_note', 'lesson_plan', 'assign_duties', 'extra', 'assembly', 'month', 'year'),
                          array($user,$attend,$lessonnote,$lessonplan,$duties,$extra,$assembly,$month,$year)
                       );
                    }
                  }

                 ?>
                <br></div>
        	  <!-- form start -->
        	    <div class="card-body row">
        	      <div class="col-md-6">
                  <label for="">Staff</label>
        	         <select name="user_id" id="user_id" class="form-control">
                    <?php 
                      $section_id = $_SESSION['section'];
                      $user_id = $_SESSION['user_id'];
                      $row = $db->Rows("SELECT * FROM users WHERE section_id ='$section_id' AND user_id !='$user_id'");

                        foreach ($row as $user) {
                          echo "<option value='".$user['user_id']."'>".$user['firstname']." ".$user['lastname']."</option>";
                        }
                     ?> 
                   </select>
                 </div>
                 <div class="col-md-6">
                    <label for="">Month</label>
                   <select name="month" id="month" class="form-control">
                   <?php  for($i = 1; $i <= 12; $i++){  ?>

                   <option value="<?= $i ?>"><?= date('M', strtotime('2020-'.$i.'-01')) ?></option>

                   <?php }  ?>
                   </select>
                 </div>
                 <div class="col-md-6">
                    <label for="">Year</label>
                    <input type="text" name="year" id="year" class="form-control">
                 </div>
                 <div class="col-md-6">
                   <label for="">Lesson Note Point</label>
                   <input type="text" name="lessonnote" id="lessonnote" class="form-control">
                 </div>
                 <div class="col-md-6">
                    <label for="">Lesson Plan Point</label>
                   <input type="text" name="lessonplan" id="lessonplan" class="form-control">
                 </div>
                 <div class="col-md-6">
                    <label for="">Assign Duties</label>
                   <input type="text" name="duties" id="duties" class="form-control">
                 </div>
                 <div class="col-md-6">
                    <label for="">Extra Curricular Point</label>
                   <input type="text" name="extra" id="extra" class="form-control">
                 </div>
                 <div class="col-md-6">
                    <label for="">Morning Assembly</label>
                   <input type="text" name="assembly" id="assembly" class="form-control">
        	      </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        	    </div>
            </form>
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
 

