<?php 
include "../../classes/Init.php";
//Instantiate User Object
$pin = new Pin();

//Get Posted Data

$no = $_POST['pin'];


//Validation Kicks In

 $fields = array(
                array('name'=>'pin',
                      'app_name' => 'No of Pin',
                      'isRequired' => true,
                      'dig-only' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

        for ($i=1; $i <=$no ; $i++) { 
          $pin->card_number = randChar();

          $pin->MakePin();
        }
        echo success('Pins Generated Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='pins.php';
              }, 2000)
            </script>
   <?php

}else{
    errorArray($Validation->errors);
}
 ?>
