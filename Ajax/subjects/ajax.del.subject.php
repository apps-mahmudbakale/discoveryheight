<?php 
include "../../classes/Init.php";
//Instantiate User Object
$subject = new Subject();

//Get Posted Data
$subject->subject_id = $_POST['subject_id'];

    $subject->DeleteSubject();
    echo success('Subject Deleted Sucessfully');
    ?>
    <script>
              setTimeout(function(){
                window.location='subjects.php';
              }, 2000)
            </script>