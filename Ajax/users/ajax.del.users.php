<?php 
include "../../classes/Init.php";
$user = new User();

//Get Posted Data
$user->user_id = $_POST['user_id'];


    $user->DeleteUser();
    echo success('User Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='users.php';
              }, 2000)
            </script>