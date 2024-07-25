<?php 
include "../classes/Init.php";

$config = array('host' => 'localhost', 'user' => 'mahmudbakale', 'pass' => 'root', 'db' => 'skul');
$db = new Sqli($config);
//Get Posted Data

$opassword = $_POST['opassword'];
$npassword = $_POST['npassword'];
$cpassword = $_POST['cpassword'];
$user_id = $_POST['user_id'];
//Validation Kicks In

 $fields = array(
                array('name'=>'opassword',
                      'app_name' => 'Old Password',
                      'isRequired' => true
                     ),
                 array('name'=>'npassword',
                      'app_name' => 'New Password',
                      'isRequired' => true
                     ),
                 array('name'=>'cpassword',
                      'app_name' => 'Confirm Password',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

  if ($npassword == $cpassword) {
      $row = $db->Row("SELECT password FROM users WHERE user_id ='$user_id'");
      if (password_verify($opassword, $row['password'])) {
          $newpassword = PasswordHash($npassword);
          $db->query("UPDATE users SET password='$newpassword' WHERE user_id='$user_id'");

          success('Password Changed Successfully');
      }else{
        error('Wrong Old Password');
      }
  }else{
    echo error('Password Mismatch');
  }

}else{
	errorArray($Validation->errors);
}
 ?>
