<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$class = new Classes();
$classes = $class->getClasses();
$fee = new Fees();
$fees = $fee->getFeesItem();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">New Class Fees</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="classFees.php">Class Fees</a></li>
              <li class="breadcrumb-item active">New Class Fees</li>
            </ol>
          </div><!-- /.col-->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        	<div class="card">
              <div class="card-header">
                <h3 class="card-title">New Class Fees</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <div class="form-group">
                  <label>Class</label>
                  <select name="class_id" id="class_id" class="form-control">
                  <?php 
                    foreach ($classes as $class) {
                      echo "<option value='".$class['class_id']."'>".$class['class']."</option>";
                    }
                   ?>
                 </select>
                </div>
                <div class="form-group">
                  <label>Fees Name</label>
                  <select name="fees_id" id="fees_id" class="form-control">
                  <?php 
                    foreach ($fees as $fee) {
                      echo "<option value='".$fee['fees_id']."'>".$fee['fees_name']."</option>";
                    }
                   ?>
                 </select>
                </div>
                <div class="form-group">
                  <label>Term</label>
                  <select name="term" id="term" class="form-control">
                  <?php 
                    for ($i=1; $i <=3 ; $i++) { 
                      echo "<option>".$i."</option>";
                    }
                   ?>
                 </select>
                </div>
               <div class="form-group">
                  <?php 
                    $forms = new Form();
                  $forms->Input(array('label' =>'Price', 'name' =>'price', 'type'=>'text', 'id' => 'price', 'class' => 'form-control', 'holder' =>'Price', 'isDisabled' =>false, 'value' => ''));
                   ?>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" id="addClassFees" class="btn btn-primary">Submit</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
    $("#classes").DataTable({
      "ordering": false
    });
  });
</script>

