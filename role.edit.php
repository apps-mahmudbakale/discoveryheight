<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 

$role_id = base64_decode($_GET['id']);
$role = new Role();
$roles = $role->conn->Row("SELECT * FROM roles WHERE role_id ='$role_id'");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="roles.php">Roles</a></li>
              <li class="breadcrumb-item active">Edit Role</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        	<!-- New User form elements -->
        	<div class="card">
        	  <div class="card-header">
        	    <h3 class="card-title">Edit Role</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <?php 
                    $forms = new Form();
                    $forms->Input(array('label' =>'', 'name' =>'role_id', 'type'=>'hidden', 'id' => 'role_id', 'class' => 'form-control', 'holder' =>'Role', 'isDisabled' =>false, 'value' => $roles['role_id']));
        	           $forms->Input(array('label' =>'Role', 'name' =>'role', 'type'=>'text', 'id' => 'role', 'class' => 'form-control', 'holder' =>'Role', 'isDisabled' =>false, 'value' => $roles['role'])); ?>
        	      </div>
                <div class="form-group">
                  <label>Permissions</label>
                  <select multiple name="permission[]" id="permission" class="custom-select">
                    <?php 
                    $permission = new Permission();
                    $permissions = $permission->ReadPermissions();
                     $rolePermissions = $permission->conn->Rows("SELECT * FROM `role_perm` rp INNER JOIN roles r ON rp.role_id = r.role_id INNER JOIN permissions p ON rp.perm_id = p.perm_id WHERE rp.role_id ='$role_id'");
                    $permissionsArray = array();

                    foreach ($rolePermissions as $perm) { array_push($permissionsArray, $perm['perm_id']);}

                    foreach ($permissions as $row) 
                    {
                      if (in_array($row['perm_id'], $permissionsArray)) {
                           echo "<option value={$row['perm_id']} selected>{$row['perm']}</option>";
                      }else{
                        echo "<option value={$row['perm_id']}>{$row['perm']}</option>";
                      }
                    }
                     ?>
                  </select>
                </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="editRole" class="btn btn-primary">Submit</button>
        	    </div>
        	</div>
        	<!-- /.card -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php 
 include 'templates/template_footer.php';
  ?>
 

