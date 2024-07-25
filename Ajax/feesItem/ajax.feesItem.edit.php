<?php 
include "../../classes/Init.php";
//Instantiate User Object
$fees = new Fees();

//Get Posted Data

$fees->fees_name = $_POST['fees_name'];
$fees->fees_id = $_POST['fees_id'];


//Validation Kicks In

 $fields = array(
                array('name'=>'fees_name',
                      'app_name' => 'Fees Item',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($fees->UpdateFeesItem()) {
        echo success('Fees Item Updated Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='feesItem.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Fees Item Not Updated');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
