<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Staff Evaluation</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Staff Evaluation</li>
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
                <h3 class="card-title">Staff Evaluation</h3>
              </div>
              <!-- /.card-header -->
              <div id="status">
                <?php 


                 ?>
                <br>
              </div>
              <div class="card-body">
                    <table class="table table-striped" id="staffs">
                      <thead>
                        <th>S/N</th>
                        <th>Staff Name</th>
                        <th>Section</th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php 
                        $data = $db->Rows("SELECT DISTINCT staff_id, firstname, lastname,section FROM `staff_evaluation` INNER JOIN users ON staff_evaluation.staff_id = users.user_id INNER JOIN section USING(section_id)");
                          $sn=0;
                        foreach ($data as $row) {
                          $sn++;
                          echo "<tr>
                              <td>".$sn."</td>
                              <td>".$row['firstname']." ".$row['lastname']."</td>
                              <td>".$row['section']."</td>
                              <td class='btn-group'>
                                <a href='staff.evaluation.list.php?id=".base64_encode($row['staff_id'])."' class='btn btn-primary btn-sm text-light'><i class='fa fa-eye'></i></a>
                                <a href='?id=".base64_encode($row['staff_id'])."' class='btn btn-danger btn-sm text-light'><i class='fa fa-trash'></i></a>
                              </td>
                              </tr>";
                        }
                         ?>
                      </tbody>
                    </table>
              </div>
              <div class="card-footer">
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
      $("#staffs").DataTable({
        "ordering": false
      });
    });
  </script>

 

