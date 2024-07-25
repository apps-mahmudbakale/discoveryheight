<?php 
include "../../classes/Init.php";
//Instantiate User Object
$class = new Classes();

$class->class_price_id = $_POST['class_price_id'];


    $class->DeleteClassFees();
    echo success('Class Fees Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='classFees.php';
              }, 2000)
            </script>