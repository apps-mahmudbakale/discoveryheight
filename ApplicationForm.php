<?php
include 'classes/Init.php';
include 'templates/template_header.php';
include 'templates/template_sidebar.php';
$app = new Application();
?>


<style>
  .preloader {
    align-items: center;
    background: rgb(206, 233, 234);
    display: none;
    height: 100vh;
    justify-content: center;
    left: 0;
    position: fixed;
    top: 0;
    transition: opacity 0.3s linear;
    width: 100%;
    z-index: 999;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="preloader"><img src="dist/img/30.gif" alt="loader"></div>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Application Form</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Application Form</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">New Student Application</h3>
        </div>
        <!-- /.card-header -->
        <div id="status"><br></div>
        <div class="card-body">
<form action="" method="POST" enctype="multipart/form-data" id="AppForm">
  <div class="col-md-12 border border-success border-0" id="Form">
    <fieldset>
      <div class="form-group row">
        <div class="col-lg-3">
          Admission No:
          <input type="text" name="admission_number" value="DH/<?php echo $app->getMaxid();?>" readonly required class="form-control" />
        </div>
        <div class="col-lg-3">
          First Name:
          <input type="text" name="fname" id="fname" pattern="[a-zA-Z]+" required class="form-control" />
        </div>
        <div class="col-lg-3">
          Last Name:
          <input type="text" name="lname" id="lname" pattern="[a-zA-Z]+" required class="form-control" />
        </div>
        <div class="col-lg-3">
          Middle Name:
          <input type="text" name="mname" id="mname" pattern="[a-zA-Z]+" required class="form-control" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3">
          Gender:
          <select name="gender" id="gender" class="form-control">
            <option>Male</option>
            <option>Female</option>
          </select>
        </div>
        <div class="col-lg-3">
          Date of Birth:
          <input type="date" name="dob" id="dob" required class="form-control" />
        </div>
        <div class="col-lg-3">
          Nationality:
          <input type="text" name="nationality" id="nationality" class="form-control">
        </div>
        <div class="col-lg-3">
          State of Origin:
          <select name="state" id="state" class="form-control">
            <?php
            $states = $app->getStates();
            foreach ($states as $state) {
              echo "<option value='{$state['state_id']}'>{$state['state_name']}</option>";
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-lg-3">
          Class:
          <select name="class_id" id="class_id" class="form-control">
              <?php
              $classes = $app->getClasses();
              foreach ($classes as $class) {
                  echo "<option value='{$class['class_id']}'>{$class['class']}</option>";
              }
              ?>
          </select>
        </div>
        <div class="col-lg-3">
          Category:
          <select name="category" id="category" class="form-control">
              <option value="Regular">Regular</option>
          </select>
        </div>
        <div class="col-lg-3">
          Place of Birth:
          <input type="text" name="place_of_birth" id="place_of_birth" class="form-control">
        </div>
        <div class="col-lg-3">
          Admission Date:
          <input type="date" name="admission_date" id="admission_date" class="form-control">
        </div>
        <div class="col-lg-12">
          Address:
          <input type="text" name="address" class="form-control">
        </div>
        <div class="col-lg-6">
          Mobile Phone:
          <input type="text" name="phone" id="phone" class="form-control">
        </div>
        <div class="col-lg-6">
          Home Phone:
          <input type="text" name="home_phone" id="home_phone" class="form-control">
        </div>
        <div class="col-lg-6">
          Postal Code:
          <input type="text" name="postal_code" id="postal_code" class="form-control">
        </div>
        <div class="col-lg-6">
          Religion:
          <input type="text" name="religion" id="religion" class="form-control">
        </div>
        <div class="col-lg-6">
          Blood Group:
          <input type="text" name="blood_group" id="blood_group" class="form-control">
        </div>
        <div class="col-lg-6">
          Genotype:
          <input type="text" name="genotype" id="genotype" class="form-control">
        </div>
      </div>
    </fieldset>
  </div>
  <div class="card-footer">
    <button type="submit" id="apply" class="btn btn-primary">Submit</button>
  </div>
</form>
<?php
include 'templates/template_footer.php';
?>
<script>
  $('#AppForm').on('submit', function(e) {
    e.preventDefault();
    // Display a loader or some feedback to the user
    // console.log('Submitting form...');
    $.ajax({
      url: 'Ajax/application/application.php',
      type: 'POST',
      data: new FormData(this),
      processData: false,
      contentType: false,
      success: function(response) {
        console.log(response);
        window.location = 'print.php?id=' + response;
      },
      error: function(xhr, status, error) {
        console.error('Submission failed:', status, error);
        // Optionally, display an error message to the user
      }
    });
  });
</script>
