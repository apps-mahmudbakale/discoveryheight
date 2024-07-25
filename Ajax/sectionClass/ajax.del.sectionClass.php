<?php 
include "../../classes/Init.php";
//Instantiate User Object
$section = new Section();

//Get Posted Data
$section->sec_class_id = $_POST['sec_class_id'];

    $section->DeleteSectionClass();
    echo success('Section Class Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='sectionClass.php';
              }, 2000)
            </script>