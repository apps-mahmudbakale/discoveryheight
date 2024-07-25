<?php 
include "../../classes/Init.php";
//Instantiate Database & Connect
$pin = new Pin();


$pin->pin_id = $_POST['pin_id'];


    $pin->DeletePin();
    echo success('Pin Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='pins.php';
              }, 2000)
            </script>