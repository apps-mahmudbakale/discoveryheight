<?php 
include "../../classes/Init.php";
//Instantiate User Object
$class = new Classes();

$class->class_id = $_POST['class_id'];


    $class->DeleteClass();
    echo success('Class Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='class.php';
              }, 2000)
            </script>