<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
$id = base64_decode($_GET['id']);
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
                <h3 class="card-title">Staff Evaluation for <?php $row = $db->Row("SELECT * FROM users WHERE user_id ='$id'"); echo strtoupper($row['firstname']." ".$row['lastname']); ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                    <table class="table table-striped" id="staffs">
                      <thead>
                        <th>S/N</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Attendance</th>
                        <th>Lesson Note</th>
                        <th>Lesson Plan</th>
                        <th>Assign Duties</th>
                        <th>Extra Curricular</th>
                        <th>Morning Assembly</th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php 
                        $data = $db->Rows("SELECT * FROM `staff_evaluation` INNER JOIN users ON staff_evaluation.staff_id = users.user_id INNER JOIN section USING(section_id) WHERE staff_id ='$id' ORDER BY month AND year");
                          $sn=0;
                        foreach ($data as $row) {
                          $sn++;
                          echo "<tr>
                              <td>".$sn."</td>
                              <td>".date('M', strtotime('2020-'.$row['month'].'-01'))."</td>
                              <td>".$row['year']."</td>
                              <td>".$row['attendance']."</td>
                              <td>".$row['lesson_note']."</td>
                              <td>".$row['lesson_plan']."</td>
                              <td>".$row['assign_duties']."</td>
                              <td>".$row['extra']."</td>
                              <td>".$row['assembly']."</td>
                              <td class='btn-group'>
                                <a href='evaluation.form.php?id=".base64_encode($row['eva_id'])."' target='blank' class='btn btn-primary btn-sm text-light'><i class='fa fa-eye'></i></a>
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