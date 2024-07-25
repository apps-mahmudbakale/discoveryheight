<?php 
include "../../classes/Init.php";
$fees = new Fees();

//Get Posted Data
$fees->fees_id = $_POST['fees_id'];


    $fees->DeleteFeesItem();
    echo success('Fees Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='feesItem.php';
              }, 2000)
            </script>