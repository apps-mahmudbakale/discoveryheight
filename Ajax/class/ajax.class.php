<?php 
include "../../classes/Init.php";
//Instantiate User Object
$class = new Classes();

//Validation Kicks In

 $fields = array(
                array('name'=>'class',
                      'app_name' => 'Class',
                      'isRequired' => true
                     ),
                array('name'=>'average',
                      'app_name' => 'Average',
                      'isRequired' => true, 
                      'dig-only' => true
                     )

            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {
    $class->class = $_POST['class'];
    $class->average = $_POST['average'];
      if ($class->MakeClass()) {
        echo success('Class Created Sucessfully');
        ?>
        <script>
                  setTimeout(function(){
                    window.location='class.php';
                  }, 2000)
                </script>
      <?php }else{
        echo error('Class Not Created');
      }
    }else{
    errorArray($Validation->errors);
}
 ?>
