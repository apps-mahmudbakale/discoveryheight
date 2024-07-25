<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$fees_id = base64_decode($_GET['id']);
$fee = new Fees();
$fees = $fee->conn->Row("SELECT * FROM fees_item WHERE fees_id ='$fees_id'");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Fees Item</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="feesItem.php">Fees Item</a></li>
              <li class="breadcrumb-item active">Edit Fees Item</li>
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
        	    <h3 class="card-title">Edit Fees Item</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <?php 
                    $forms = new Form();
                  $forms->Input(array('label' =>'', 'name' =>'fees_id', 'type'=>'hidden', 'id' => 'fees_id', 'class' => 'form-control', 'holder' =>'', 'isDisabled' =>false, 'value' => $fees['fees_id']));
        	        $forms->Input(array('label' =>'Fees Item', 'name' =>'fees_name', 'type'=>'text', 'id' => 'fees_name', 'class' => 'form-control', 'holder' =>'Fees Item', 'isDisabled' =>false, 'value' => $fees['fees_name'])); ?>
        	      </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="editFees" class="btn btn-primary">Submit</button>
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
 

