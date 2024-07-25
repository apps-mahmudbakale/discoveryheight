<?php  
include 'classes/Init.php';
include 'templates/template_header.php'; 
include 'templates/template_sidebar.php'; 
$user_id = base64_decode($_GET['id']);
$user = new User();
$users = $user->conn->Row("SELECT u.user_id, u.firstname, u.lastname, u.username, u.phone, r.role, r.role_id,s.section, u.section_id FROM users u LEFT JOIN user_role ur ON u.user_id = ur.user_id LEFT JOIN roles r ON ur.role_id = r.role_id LEFT JOIN section s ON s.section_id = u.section_id WHERE u.user_id ='$user_id'");
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="users.php">Users</a></li>
              <li class="breadcrumb-item active">Edit User</li>
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
        	    <h3 class="card-title">Edit User</h3>
        	  </div>
        	  <!-- /.card-header -->
               <div id="status"><br></div>
        	  <!-- form start -->
        	    <div class="card-body">
        	      <div class="form-group">
        	        <?php 
                    $forms = new Form();
                    $forms->Input(array('label' =>'', 'name' =>'user_id', 'type'=>'hidden', 'id' => 'user_id', 'class' => 'form-control', 'holder' =>'First Name', 'isDisabled' =>false, 'value' => $users['user_id']));
        	        $forms->Input(array('label' =>'First Name', 'name' =>'firstname', 'type'=>'text', 'id' => 'firstname', 'class' => 'form-control', 'holder' =>'First Name', 'isDisabled' =>false, 'value' => $users['firstname'])); ?>
        	      </div>
                  <div class="form-group">
                    <?php 
                    $forms->Input(array('label' =>'Last Name', 'name' =>'lastname', 'type'=>'text', 'id' => 'lastname', 'class' => 'form-control', 'holder' =>'Last Name', 'isDisabled' =>false, 'value' => $users['lastname'])); ?>
                  </div>
        	        <div class="form-group">
        	        <?php 
        	        $forms->Input(array('label' =>'Phone Number', 'name' =>'phone', 'type'=>'text', 'id' => 'phone', 'class' => 'form-control', 'holder' =>'Phone Number', 'isDisabled' =>false, 'value' => $users['phone'])); ?>
        	      </div>
        	        <div class="form-group">
        	        <?php 
        	        $forms->Input(array('label' =>'Username', 'name' =>'username', 'type'=>'text', 'id' => 'username', 'class' => 'form-control', 'holder' =>'Username', 'isDisabled' =>false, 'value' => $users['username'])); ?>
        	      </div>
                <div class="form-group">
                  <label>Section</label>
                    <select name="section" id="section" class="form-control">
                      <option value="<?php echo $users['section_id'] ?>" selected><?php echo $users['section'] ?></option>
                        <?php 
                        $section = new Section();
                        $sections = $section->getSections();

                        foreach($sections as $row){
                            echo "<option value='{$row['section_id']}'>{$row['section']}</option>";
                        }
                         ?>
                    </select>
                </div>
        	       <div class="form-group">
        	        <label>Roles</label>
                    <select name="role_id" id="role_id" class="form-control">
                      <option value="<?php echo $users['role_id'] ?>" selected><?php echo $users['role'] ?></option>
                        <?php 
                        $role = new Role();
                        $roles = $role->getRoles();
                        foreach($roles as $row){
                            echo "<option value='{$row['role_id']}'>{$row['role']}</option>";
                        }
                         ?>
                    </select>
        	      </div>
        	    </div>
        	    <!-- /.card-body -->

        	    <div class="card-footer">
        	      <button type="submit" id="editUser" class="btn btn-primary">Submit</button>
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
 

