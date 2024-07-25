<?php
error_reporting(1);
//include_once "connection.php";
function error($message) {
   echo "<div class='col-lg-12 alert alert-danger' style='padding:10px'><i class='fa fa-warning'></i> $message
    <span class='close' data-dismiss='alert'>x</span></div>";
}

function getPage() {
  $page = preg_replace("/^\/[a-zA-Z.]+\//","",$_SERVER['PHP_SELF']);
  return $page;
}

 function success($message) {
   echo "<div class='col-lg-12 alert alert-success' style='padding:10px'><i class='fa fa-information'></i> $message
       <span class='close'>x</span></div>";
 }
 
 function errorArray($message) {
   echo "<div class='col-lg-12 alert alert-danger' style='padding:10px'><i class='fa fa-warning'></i>";
   echo "<b> The following error(s) occured.</b><ol>";
   foreach($message as $m)
     echo "- ".$m."<br/>";
   echo "</ol>";
   echo "</div>";

 }

 function passwordHash($password){
  $hash = password_hash($password, PASSWORD_BCRYPT);
  return $hash;
 } 

function randChar() {
  $string = "";
  $chars = "ABCDEF123456789ZRSTUV";
  for($i=0;$i<=11;$i++) {
       $string .= $chars[mt_rand(0,strlen($chars)-1)];
  }
  return $string;
 }
 
function createRandomPassword() {
    $chars = "003232303232023232023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {

        $num = rand() % 33; 

        $tmp = substr($chars, $num, 1);

        $pass = $pass . $tmp;

        $i++;

    }
    return $pass;
}
function MaskString($string)
{
  $mask = str_repeat("*", strlen($string)-4).substr($string, -4);

  return $mask;
}
function csvDecode($filename) {
   $keys = NULL;
   $data = array();
   if($handle = fopen($filename, "r")) {
     while($row = fgetcsv($handle, 100000, ',')) {
       if(!$keys) {
         $keys = $row;
       } else {
         $data[] = array_combine($keys, $row);
       }
     }
   }
   return $data;
 }
 function get_percentage($total, $number)
 {
   if ( $total > 0 ) {
    return round($number / ($total / 100),2);
   } else {
     return 0;
   }
 }
?>