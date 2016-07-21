<?php
	session_start();
	session_destroy();
	session_start();
	$_SESSION['logout_success'] = '<p>You have successfully logged out..</p>';
	header('location:login.php')
?>