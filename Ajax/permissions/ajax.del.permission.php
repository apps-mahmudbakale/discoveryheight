<?php 
include "../../classes/Init.php";
//Instantiate User Object
$permission = new Permission();

//Get Posted Data
$permission->perm_id = $_POST['perm_id'];

    $permission->DeletePermission();
    echo success('Permission Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='permissions.php';
              }, 2000)
            </script>