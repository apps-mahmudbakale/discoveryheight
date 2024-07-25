<?php 
include "../../classes/Init.php";
//Instantiate User Object
$permission = new Permission();

//Get Posted Data

$permission->perm = $_POST['permission'];


//Validation Kicks In

 $fields = array(
                array('name'=>'permission',
                      'app_name' => 'Permission',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($permission->MakePermission()) {
        echo success('Permission Added Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='permissions.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Permission Not Created');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
