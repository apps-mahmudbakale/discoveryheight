<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$class = new Classes();
$classes = $class->getClasses();
$fee = new Fees();
$fees = $fee->getFeesItem();
$class_price_id = base64_decode($_GET['id']);
$data = $class->conn->Row("SELECT * FROM `class_price`cp INNER JOIN class c ON cp.class_id = c.class_id INNER JOIN fees_item f ON cp.fees_id = f.fees_id WHERE cp.class_price_id ='$class_price_id'");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Class Fees</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item"><a href="/classFees">Class Fees</a></li>
              <li class="breadcrumb-item active">Edit Class Fees</li>
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
                <h3 class="card-title">Edit Class Fees</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <div class="form-group">
                  <label>Class</label>
                  <select name="class_id" id="class_id" class="form-control">
                    <option value="<?php echo $data['class_id']; ?>" selected><?php echo $data['class']; ?></option>
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
                     <option value="<?php echo $data['fees_id']; ?>" selected><?php echo $data['fees_name']; ?></option>
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
                  <option value="<?php echo $data['term']; ?>" selected><?php echo $data['term']; ?></option>
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
                  $forms->Input(array('label' =>'Price', 'name' =>'price', 'type'=>'text', 'id' => 'price', 'class' => 'form-control', 'holder' =>'Price', 'isDisabled' =>false, 'value' => $data['price']));
                   $forms->Input(array('label' =>'', 'name' =>'class_price_id', 'type'=>'hidden', 'id' => 'class_price_id', 'class' => 'form-control', 'holder' =>'', 'isDisabled' =>false, 'value' => $data['class_price_id']));
                   ?>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" id="editClassFees" class="btn btn-primary">Submit</button>
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

