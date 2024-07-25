<?php  
session_start();
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$app = new Application();
$app->section = $_SESSION['section'];
$apps = $app->getApplicants();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Applicants</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Applicants</li>
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
                <h3 class="card-title">Applicants</h3>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <table id="applicants" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>State</th>
                    <th>Guardian</th>
                    <th>Address</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $sn = 0;
                      foreach ($apps as $row) {
                        $sn++;
                        echo "<tr>
                                <td>{$sn}</td>
                                <td>{$row['full_name']}</td>
                                <td>{$row['gender']}</td>
                                <td>{$row['state_name']}</td>
                                <td>{$row['guardian_full_name']}</td>
                                <td>{$row['address']}</td>
                                <td>
                                <div class='btn-group'>
                                <a href='viewApplicant.php?id=".base64_encode($row['app_id'])."' class='btn btn-info btn-sm'>
                                <i class='fa fa-eye'></i></a>
                                 <a href='approveApplication.php?id=".base64_encode($row['app_id'])."' class='btn btn-success btn-sm'>
                                <i class='fa fa-check-circle'></i></a>
                                <button id='delete_{$row['app_id']}' class='btn btn-danger btn-sm delete'>
                                <i class='fa fa-trash'></i></button>";?>
                                <script>
                                  $(document).ready(()=>{
                                  $('#delete_<?php echo $row['app_id'] ?>').click(()=>{
                                      var app_id = <?php echo $row['app_id'] ?>;

                                      $.confirm({
                                          title: 'Confirm!',
                                          content: 'Are You Sure to  Delete This Applicantion!',
                                          buttons: {
                                              confirm: function () {
                                                  $.ajax({
                                                    type: 'POST',
                                                     url: 'Ajax/application/ajax.del.application.php',
                                                     data:{app_id:app_id},
                                                     cache: false,
                                                     success: ((html)=>{
                                                       $('#status').html(html);
                                                     })
                                                  })
                                              },
                                              cancel: function () {
                                                  
                                              }
                                          }
                                      });
                                      
                                    });
                                });
                                </script>
                             <?php  echo "</div>
                                </td>
                             </tr>";
                      }

                   ?>
                  </tbody>
                </table>
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
    $("#applicants").DataTable({
      "ordering": false
    });
  });
</script>

