<?php 
include "../../classes/Init.php";
//Instantiate User Object
$role = new Role();

//Validation Kicks In

 $fields = array(
                array('name'=>'role',
                      'app_name' => 'Role',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {
    $role->role_id =  $_POST['role_id'];
    $permissions = $_POST['permission'];
        $role->role = $_POST['role'];
        $role->perm_id = $permissions;
          if ($role->UpdateRole()) {
            echo success('Role Updated Sucessfully');
            ?>
            <script>
                      setTimeout(function(){
                        window.location='roles.php';
                      }, 2000)
                    </script>
          <?php }else{
            echo error('Role Not Updated');
          }
    }else{
    errorArray($Validation->errors);
}
 ?>
