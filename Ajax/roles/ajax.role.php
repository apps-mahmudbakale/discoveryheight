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
    $permissions = array();

    foreach ($_POST['permission'] as $perm) 
    {
      array_push($permissions, $perm);
    }
    $role->role = $_POST['role'];
    $role->perm_id = $permissions;
      if ($role->MakeRole()) {
        echo success('Role Created Sucessfully');
        ?>
        <script>
                  setTimeout(function(){
                    window.location='roles.php';
                  }, 2000)
                </script>
      <?php }else{
        echo error('Role Not Created');
      }
    }else{
    errorArray($Validation->errors);
}
 ?>
