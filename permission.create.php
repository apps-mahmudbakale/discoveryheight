<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php';
 
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Permission</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="permissions.php">Permissions</a></li>
              <li class="breadcrumb-item active">New Permission</li>
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
        	    <h3 class="card-title">Create New Permission</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <?php 
                    $forms = new Form();
        	        $forms->Input(array('label' =>'Permission', 'name' =>'permission', 'type'=>'text', 'id' => 'permission', 'class' => 'form-control', 'holder' =>'Permission', 'isDisabled' =>false, 'value' => '')); ?>
        	      </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="addPerm" class="btn btn-primary">Submit</button>
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
 

