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
            <h1 class="m-0 text-dark">Assign Form Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="teachers.php">Teachers</a></li>
              <li class="breadcrumb-item active">AssignForm Master</li>
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
                <h3 class="card-title">Assign Form Master</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                      <div class="form-group row">
                        <div class="col-lg-6">
                          Teacher
                          <select name="user_id" id="user_id" class="form-control">
                            <?php 
                              $teacher = new Teacher();
                              $teacher->section = $_SESSION['section'];
                              $teachers = $teacher->getTeachers();

                              foreach ($teachers as $teacher) {
                                  echo "<option value='{$teacher['user_id']}'>".$teacher['firstname']." ".$teacher['lastname']."</option>";
                              }

                             ?>
                          </select>
                        </div>
                        <div class="col-lg-6">
                        Class:
                        <select name="class_id" id="class_id" class="form-control">
                          <?php 
                            $class = new Classes();
                            $class->section_id = $_SESSION['section'];
                            $classes = $class->getClasses();

                            foreach ($classes as $class) {
                                echo "<option value='{$class['class_id']}'>{$class['class']}</option>";
                            }

                           ?>
                        </select>
                      </div>
                      </div>
                    
              </div>
              <div class="card-footer">
                <button type="submit" id="assign" class="btn btn-success">Assign</button>
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
    $('#assign').click(()=>{
      var class_id = $('#class_id').val();
      var user_id = $('#user_id').val();

      $.ajax({
        type: 'POST',
        url: 'Ajax/ajax.assignFormMaster.php',
        data:{class_id:class_id,user_id:user_id},
        cache: false,
        success: ((html)=>{
           $('#status').html(html);
        })
      })
    }) 
  </script>

