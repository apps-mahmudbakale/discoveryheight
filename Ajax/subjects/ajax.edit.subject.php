<?php 
include "../../classes/Init.php";
//Instantiate User Object
$subject = new Subject();

//Get Posted Data

$subject->subject_name = $_POST['subject_name'];
$subject->section_id = $_POST['section_id'];
$subject->subject_id = $_POST['subject_id'];


//Validation Kicks In

 $fields = array(
                array('name'=>'subject_name',
                      'app_name' => 'Subject Name',
                      'isRequired' => true
                     )
            );
$Validation = new Validation($fields,'POST');

if($Validation->out == 1) {

    if ($subject->UpdateSubject()) {
        echo success('Subject Updated Sucessfully');
        ?>
        <script>
              setTimeout(function(){
                window.location='subjects.php';
              }, 2000)
            </script>
    <?php }else{
        echo error('Subject Not Updated');
    }

}else{
    errorArray($Validation->errors);
}
 ?>
