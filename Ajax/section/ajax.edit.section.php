<?php 
include "../../classes/Init.php";
//Instantiate User Object
$section = new Section();

//Get Posted Data

$section->section = $_POST['section'];
$section->section_id = $_POST['section_id'];


//Validation Kicks In

 $fields = array(
                array('name'=>'section',
                      'app_name' => 'Section',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($section->UpdateSection()) {
        echo success('Section Updated Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='sections.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Section Not Updated');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
