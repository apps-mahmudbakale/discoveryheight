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
            <h1 class="m-0 text-dark">New Staff Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Staff Data</li>
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
        	    <h3 class="card-title">Staff Data</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status">
                <?php 
                  if (isset($_POST['submit'])) {
                    $user = $_POST['user_id'];
                    $staff_id = date('Y').time();
                    $address = $_POST['address'];
                    $dest ='attendance/passport/';
                    $image = $staff_id.".jpg";

                      //var_dump($_FILES);
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $dest.$image)) {
                        if ($db->query("INSERT INTO `staff_data`(`data_id`, `user_id`, `staff_id`, `image`, `address`) VALUES (NULL,'$user','$staff_id','$image','$address')")) {
                            success('Staff Data Added SuccessFully');?>
                            <script>
                                      setTimeout(function(){
                                        window.location='staff.data.create.php';
                                      }, 2000)
                                    </script>
                        <?php }
                    }
                  }

                 ?>
                <br></div>
        	  <!-- form start -->
        	    <div class="card-body">
                <form action="" method="POST" enctype="Multipart/form-data" class="col-md-12 row">
        	      <div class="col-md-6">
                  <label for="">Staff</label>
        	         <select name="user_id" id="user_id" class="form-control">
                    <?php 
                      $user_id = $_SESSION['user_id'];
                      $row = $db->Rows("SELECT * FROM users WHERE  user_id !='$user_id'");

                        foreach ($row as $user) {
                          echo "<option value='".$user['user_id']."'>".$user['firstname']." ".$user['lastname']."</option>";
                        }
                     ?> 
                   </select>
                 </div>
                 <div class="col-md-6">
                    <label for="">Image</label>
                   <input type="file" name="image" id="image" class="form-control">
        	      </div>
                 <div class="col-md-6">
                    <label for="">Address</label>
                   <input type="text" name="address" id="image" class="form-control">
                </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        	    </div>
        	</div>
        	<!-- /.card -->
        </form>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>
 

