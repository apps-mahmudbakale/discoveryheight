<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$pin = new Pin();
$pins = $pin->getPins();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pins</li>
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
                <h3 class="card-title">Pins</h3>
                <a href="/pin/generate" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i></a>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <table id="permissions" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Card Number</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $sn = 0;
                      foreach ($pins as $row) {
                        $sn++;
                        echo "<tr>
                                <td>{$sn}</td>
                                <td>".MaskString($row['card_number'])."</td>
                                <td>
                                <div class='btn-group'>
                                <a href='issuePin.php?id=".base64_encode($row['pin_id'])."' class='btn btn-info btn-sm'>
                                <i class='fa fa-sign-in-alt'></i></a>";
                                if ($perm->hasPerm('pin_delete',$perms)) {
                                  echo "<button id='delete_{$row['pin_id']}' class='btn btn-danger btn-sm delete'>
                                <i class='fa fa-trash'></i></button>";
                                }
                                ?>
                                <script>
                                  $(document).ready(()=>{
                                  $('#delete_<?php echo $row['pin_id'] ?>').click(()=>{
                                      var pin_id = <?php echo $row['pin_id'] ?>;

                                      $.confirm({
                                          title: 'Confirm!',
                                          content: 'Are You Sure to  Delete This Pin!',
                                          buttons: {
                                              confirm: function () {
                                                  $.ajax({
                                                    type: 'POST',
                                                     url: '../Ajax/pin/ajax.del.pin.php',
                                                     data:{pin_id:pin_id},
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
    $("#permissions").DataTable({
      "ordering": false
    });
  });
</script>

