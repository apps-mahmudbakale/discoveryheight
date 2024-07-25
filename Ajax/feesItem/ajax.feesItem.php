<?php 
include "../../classes/Init.php";
//Instantiate User Object
$fees = new Fees();

//Get Posted Data

$fees->fees_name = $_POST['fees_name'];


//Validation Kicks In

 $fields = array(
                array('name'=>'fees_name',
                      'app_name' => 'Fees Item',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($fees->MakeFeesItem()) {
        echo success('Fees Item Added Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='feesItem.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Fees Item Not Created');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
