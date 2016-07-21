<?php 
	include("header.php");
	include 'functions.php';
	include 'info.php';

	if(isset($_SESSION['id']) == ''){

		header('location:login.php');
	}
?>

	<p>
		<a href="udash.php">User Dashboard</a>
	</p>
	<p>
		<a href="sales.php">Sales</a>
		<a href="marketing.php">Marketing</a>
		<a href="services.php">Services</a>
	</p>

		

	

<?php 
	include("footer.php");
?>