<?php 
session_start();
include '../inc/connection.php';
include '../inc/function.php';



if (isset($_POST['company']) && !empty($_POST)) {
	
    $company = $_POST['company'];
    $code = $_POST['code'];
    $title = $_POST['title'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $site = $_POST['site'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $contact = $_POST['contact'];

    $query = mysqli_query($db,"INSERT INTO `vendors`(`vendor_id`, `vendor_company`, `vendor_code`, `title`, `firstname`, `lastname`, `email`, `vendor_site`, `street`, `city`, `state`, `zip`, `phone`, `alt_contact`) VALUES (NULL,'$company','$code','$title','$firstname','$lastname','$email','$site','$street','$city','$state','$zip','$phone','$contact')");

   if ($query) {
        success('Vendor Added Successfully');
      ?>
      <script>
              setTimeout(function(){
                window.location='dashboard.php';
              }, 2000)
            </script>

            <?php
        }
}


 ?>