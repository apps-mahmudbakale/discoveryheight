<?php 
include "../../classes/Init.php";
//Instantiate User Object
$section = new Section();

//Get Posted Data
$sectionclass = array();

foreach ($_POST['sectionclass'] as $class) 
{
  array_push($sectionclass, $class);
}

$section->section_id = $_POST['section'];
$section->sectionclass = $sectionclass;


//Validation Kicks In

 $fields = array(
                array('name'=>'section',
                      'app_name' => 'Section',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($section->MakeSectionClass()) {
        echo success('Section Class Added Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='sectionClass.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Section Class Not Created');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
