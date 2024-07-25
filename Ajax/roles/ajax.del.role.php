<?php 
include "../../classes/Init.php";
//Instantiate User Object
$role = new Role();

$role->role_id = $_POST['role_id'];


    $role->DeleteRole();
    echo success('Role Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='roles.php';
              }, 2000)
            </script>