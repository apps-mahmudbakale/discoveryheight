<?php 
include "../../classes/Init.php";
//Instantiate User Object
$class = new Classes();

//Validation Kicks In

 $fields = array(
                array('name'=>'price',
                      'app_name' => 'Price',
                      'isRequired' => true, 
                      'dig-only' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {
    $class->class_price_id = $_POST['class_price_id'];
    $class->class_id = $_POST['class_id'];
    $class->fees_id = $_POST['fees_id'];
    $class->term = $_POST['term'];
    $class->price = $_POST['price'];
      if ($class->UpdateClassFees()) {
        echo success('Class Fees Updated Sucessfully');
        ?>
        <script>
                  setTimeout(function(){
                    window.location='classFees.php';
                  }, 2000)
                </script>
      <?php }else{
        echo error('Class Fees Not Updated');
      }
    }else{
    errorArray($Validation->errors);
}
 ?>
