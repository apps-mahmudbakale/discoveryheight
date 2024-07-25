<?php 
include '../classes/Init.php';
$teacher = new Teacher();
$teacher->class_id = $_POST['class_id'];
$teacher->user_id = $_POST['user_id'];

if($teacher->assignFormMaster()){
	success('Form Master Assigned Successfully');
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