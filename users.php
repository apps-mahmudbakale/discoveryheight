<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$user = new User();
$users = $user->ReadUsers();
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                <h3 class="card-title">Users</h3>
                <a href="user.create.php" class="btn btn-success float-right"><i class="fa fa-user-plus"></i></a>
              </div>
              <!-- /.card-header -->
              <div id="status"><br></div>
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Section</th>
                    <th>Role</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $sn = 0;
                      foreach ($users as $row) {
                        $sn++;
                        echo "<tr>
                                <td>{$sn}</td>
                                <td>{$row['firstname']} {$row['lastname']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['section']}</td>
                                <td>{$row['role']}</td>
                                <td>
                                <div class='btn-group'>
                                <a href='user.edit.php?id=".base64_encode($row['user_id'])."' class='btn btn-info btn-sm'>
                                <i class='fa fa-edit'></i></a>";
                                echo "<button id='delete_{$row['user_id']}' class='btn btn-danger btn-sm delete'>
                                <i class='fa fa-trash'></i></button>";?>
                                <script>
                                  $(document).ready(()=>{
                                  $('#delete_<?php echo $row['user_id'] ?>').click(()=>{
                                      var user_id = <?php echo $row['user_id'] ?>;

                                      $.confirm({
                                          title: 'Confirm!',
                                          content: 'Are You Sure to  Delete This User!',
                                          buttons: {
                                              confirm: function () {
                                                  $.ajax({
                                                    type: 'POST',
                                                     url: '../Ajax/users/ajax.del.users.php',
                                                     data:{user_id:user_id},
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
    $("#users").DataTable({
      "ordering": false
    });
  });
</script>

