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
            <h1 class="m-0 text-dark">Generate Pin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="pins.php">Manage Pins</a></li>
              <li class="breadcrumb-item active">Generate Pin</li>
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
        	    <h3 class="card-title">Generate Pin</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <?php 
                    $forms = new Form();
        	        $forms->Input(array('label' =>'No of Pins to Generate', 'name' =>'pin', 'type'=>'text', 'id' => 'pin', 'class' => 'form-control', 'holder' =>'No of Pins to Generate', 'isDisabled' =>false, 'value' => '')); ?>
        	      </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="addPin" class="btn btn-primary">Submit</button>
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
 

