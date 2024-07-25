<?php 
include '../../classes/Init.php';
$app = new Application();
$app->class_id = $_POST['class_id'];
$app->app_id = $_POST['app_id'];
$app->term = $_POST['term'];
$y = date('y').'/';

if($app->approveApplication()){
	success('Applicant Admitted Successfully');
?>
  <script>
            setTimeout(function(){
              window.location='AdmissionConfirmation.php?id=<?php echo base64_encode($_POST['app_id']); ?>';
            }, 2000)
          </script>
<?php } else{
  echo error('Applicant Not Admitted');

}
?>