<?php 
include "../../classes/Init.php";
$user = new User();

//Get Posted Data

$user->username = $_POST['username'];
$user->password = passwordHash($_POST['password']);
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
                 array('name'=>'password',
                      'app_name' => 'Password',
                      'isRequired' => true
                     ),
                 array('name'=>'phone',
                      'app_name' => 'Phone',
                      'isRequired' => true,
                      'min-len' =>6, 
                      'dig-only' =>true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

	if ($user->MakeUser()) {
		echo success('User Created Sucessfully');
		?>
		<script>
              setTimeout(function(){
                window.location='users.php';
              }, 2000)
            </script>
	<?php }else{
		echo error('User Not Created');
	}

}else{
	errorArray($Validation->errors);
}
 ?>
