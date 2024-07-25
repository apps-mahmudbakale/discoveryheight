<?php 
include "../../classes/Init.php";
//Instantiate User Object
$section = new Section();

//Get Posted Data
$section->section_id = $_POST['section_id'];

    $section->DeleteSection();
    echo success('Section Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='sections.php';
              }, 2000)
            </script>