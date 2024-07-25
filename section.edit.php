<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$section_id = base64_decode($_GET['id']);
$section = new Section();
$sections = $section->conn->Row("SELECT * FROM section WHERE section_id ='$section_id'");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Section</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="sections.php">Sections</a></li>
              <li class="breadcrumb-item active">Edit Section</li>
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
        	    <h3 class="card-title">Edit Section</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <?php 
                    $forms = new Form();
                  $forms->Input(array('label' =>'', 'name' =>'section_id', 'type'=>'hidden', 'id' => 'section_id', 'class' => 'form-control', 'holder' =>'', 'isDisabled' =>false, 'value' => $sections['section_id']));
        	        $forms->Input(array('label' =>'Section', 'name' =>'section', 'type'=>'text', 'id' => 'section', 'class' => 'form-control', 'holder' =>'Section', 'isDisabled' =>false, 'value' => $sections['section'])); ?>
        	      </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="editSection" class="btn btn-primary">Submit</button>
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
 

