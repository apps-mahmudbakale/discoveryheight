<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$section = new Section();
$sections = $section->getSectionClass();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sections Class</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Section Class</li>
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
                <h3 class="card-title">Section Class</h3>
                <a href="sectionClass.create.php" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <table id="sections" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Section</th>
                    <th>Class</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $sn = 0;
                      foreach ($sections as $row) {
                        $sn++;
                        echo "<tr>
                                <td>{$sn}</td>
                                <td>{$row['section']}</td>
                                <td>{$row['class']}</td>
                                <td>
                                <div class='btn-group'>";
                                echo "<button id='delete_{$row['sec_class_id']}' class='btn btn-danger btn-sm delete'>
                                <i class='fa fa-trash'></i></button>";?>
                                <script>
                                  $(document).ready(()=>{
                                  $('#delete_<?php echo $row['sec_class_id'] ?>').click(()=>{
                                      var sec_class_id = <?php echo $row['sec_class_id'] ?>;

                                      $.confirm({
                                          title: 'Confirm!',
                                          content: 'Are You Sure to  Delete This Section!',
                                          buttons: {
                                              confirm: function () {
                                                  $.ajax({
                                                    type: 'POST',
                                                     url: '../Ajax/sectionClass/ajax.del.sectionClass.php',
                                                     data:{sec_class_id:sec_class_id},
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
    $("#sections").DataTable({
      "ordering": false
    });
  });
</script>

