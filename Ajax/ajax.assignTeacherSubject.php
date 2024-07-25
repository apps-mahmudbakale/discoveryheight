<?php 
include '../classes/Init.php';
$teacher = new Teacher();
$teacher->class_id = $_POST['class_id'];
$teacher->user_id = $_POST['user_id'];
$teacher->subject_id = $_POST['subject_id'];

if($teacher->assignSubject()){
	success('Subject Assigned Successfully');
?>
  <script>
            setTimeout(function(){
              window.location='teachers.php';
            }, 2000)
          </script>
<?php } else{
  echo error('Subject Not Assigned');

}
?>