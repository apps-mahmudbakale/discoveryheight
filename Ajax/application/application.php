<?php
include '../../classes/Init.php';
$app = new Application();

$app->fname = $_POST['fname'];
$app->lname = $_POST['lname'];
$app->mname = $_POST['mname'];
$app->gender = $_POST['gender'];
$app->dob = $_POST['dob'];
$app->nationality = $_POST['nationality'];
$app->state = $_POST['state'];
$app->class_id = $_POST['class_id'];
$app->category = $_POST['category'];
$app->place_birth = $_POST['place_of_birth'];
$app->admission_date = $_POST['admission_date'];
$app->address = $_POST['address'];
$app->phone = $_POST['phone'];
$app->home_phone = $_POST['home_phone'];
$app->postal_code = $_POST['postal_code'];
$app->religion = $_POST['religion'];
$app->blood_group = $_POST['blood_group'];
$app->genotype = $_POST['genotype'];

$row = $app->conn->Row("SELECT MAX(app_id) AS app_id FROM applicant");
$app_id = $row['app_id'] + 1;
$image = sprintf("%04d", $app_id) . ".jpg";
$app->image = $image;

//if (move_uploaded_file($_FILES['file']['tmp_name'], '../../passport/' . $image)) {
    echo $app_id;
    $app->MakeApplication();
//} else {
//    // Handle file upload error
//    echo "Error uploading file.";
//}
?>
