<?php 
include "../../classes/Init.php";
//Instantiate User Object
$section = new Section();

//Get Posted Data

$section->section = $_POST['section'];


//Validation Kicks In

 $fields = array(
                array('name'=>'section',
                      'app_name' => 'Section',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($section->MakeSection()) {
        echo success('Section Added Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='sections.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Section Not Created');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
