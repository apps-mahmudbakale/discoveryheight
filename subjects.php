<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$subject= new Subject();
$subjects = $subject->getSubjects();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Subjects</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Subjects</li>
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
                <h3 class="card-title">Subjects</h3>
                <a href="subject.create.php" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <table id="subjects" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Subject</th>
                    <th>Section</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $sn = 0;
                      foreach ($subjects as $row) {
                        $sn++;
                        echo "<tr>
                                <td>{$sn}</td>
                                <td>{$row['subject_name']}</td>
                                <td>{$row['section']}</td>
                                <td>
                                <div class='btn-group'>
                                <a href='subject.edit.php?id=".base64_encode($row['subject_id'])."' class='btn btn-info btn-sm'>
                                <i class='fa fa-edit'></i></a>";
                                echo "<button id='delete_{$row['subject_id']}' class='btn btn-danger btn-sm delete'>
                                <i class='fa fa-trash'></i></button>";?>
                                <script>
                                  $(document).ready(()=>{
                                  $('#delete_<?php echo $row['subject_id'] ?>').click(()=>{
                                      var subject_id = <?php echo $row['subject_id'] ?>;

                                      $.confirm({
                                          title: 'Confirm!',
                                          content: 'Are You Sure to  Delete This Permission!',
                                          buttons: {
                                              confirm: function () {
                                                  $.ajax({
                                                    type: 'POST',
                                                     url: '../Ajax/subjects/ajax.del.subject.php',
                                                     data:{subject_id:subject_id},
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
    $("#subjects").DataTable({
      "ordering": false
    });
  });
</script>

