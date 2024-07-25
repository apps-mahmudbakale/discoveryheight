<?php 
session_start();
include_once 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$user_id = $_SESSION['user_id'];
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
               <div id="status"><br></div>
            <!-- form start -->
              <div class="card-body">
                  <div class="form-group">
                  <?php 
                   Form::Input(array('type'=>'hidden', 'id' => 'user_id','value' =>$user_id));
                  Form::Input(array('label' =>'Old Password', 'name' =>'password', 'type'=>'password', 'id' => 'opassword', 'class' => 'form-control', 'holder' =>'Password')); ?>
                </div>
                  <div class="form-group">
                    <?php 
                    Form::Input(array('label' =>'New Password', 'name' =>'password', 'type'=>'password', 'id' => 'npassword', 'class' => 'form-control', 'holder' =>'Password')); ?>
                  </div>
                  <div class="form-group">
                    <?php 
                    Form::Input(array('label' =>'Confirm New Password', 'name' =>'password', 'type'=>'password', 'id' => 'cpassword', 'class' => 'form-control', 'holder' =>'Password')); ?>
                  </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" id="changepass" class="btn btn-primary">Submit</button>
              </div>
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
    $('#changepass').click(()=>{
      var opassword = $('#opassword').val();
      var npassword = $('#npassword').val();
      var cpassword = $('#cpassword').val();
      var user_id = $('#user_id').val();
      $.ajax({
               url: 'Ajax/ajax.changepass.php',
               type: 'POST',
               data: {opassword:opassword,npassword:npassword,cpassword:cpassword,user_id:user_id},
               cache: false,
               success: ((html)=>{
                 if (html != '') {
                   $('#status').html(html);
                   //console.log(html);
                 }
                   
               })
             });
    })
  </script>