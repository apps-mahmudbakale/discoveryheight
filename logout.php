<?php 
session_start();

if (isset($_SESSION['username']) || isset($_SESSION['user_id']) || isset($_SESSION['section_id'])) {
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
	unset($_SESSION['section_id']);
 ?>
<script>window.location='index.php'</script>

<?php } ?>