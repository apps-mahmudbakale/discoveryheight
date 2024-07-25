<?php 
include "../../classes/Init.php";
$user = new User();

//Get Posted Data
$user->user_id = $_POST['user_id'];
$user->username = $_POST['username'];
$user->firstname = $_POST['firstname'];
$user->lastname = $_POST['lastname'];
$user->phone = $_POST['phone'];
$user->role_id = $_POST['role_id'];
$user->section = $_POST['section'];
//Validation Kicks In

 $fields = array(
                array('name'=>'firstname',
                      'app_name' => 'First Name',
                      'isRequired' => true
                     ),
                array('name'=>'lastname',
                      'app_name' => 'Last Name',
                      'isRequired' => true
                     ),
                 array('name'=>'username',
                      'app_name' => 'Username',
                      'isRequired' => true
                     ),
                 array('name'=>'phone',
                      'app_name' => 'Phone',
                      'isRequired' => true,
                      'min-len' =>11, 
                      'dig-only' =>true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

  if ($user->UpdateUser()) {
    echo success('User Updated Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='users.php';
              }, 2000)
            </script>
  <?php }else{
    echo error('User Not Updated');
  }

}else{
  errorArray($Validation->errors);
}
 ?>
