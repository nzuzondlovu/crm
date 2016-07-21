<?php 
	include("header.php");
	include 'functions.php';

	if(isset($_SESSION['id']) != ''){

		header('location:dashboard.php');
	}
?>

<?php
	if(isset($_POST['submit'])){
		$username = mysqli_real_escape_string($con, strip_tags(trim($_POST['username'])));
		$password = mysqli_real_escape_string($con, strip_tags(trim($_POST['password'])));

		if ($username != '' || $password != '') {
			
			$sql = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
			$res = mysqli_query($con, $sql);

			if(mysqli_num_rows($res) > 0){

				$user_info = mysqli_fetch_assoc($res);
				$_SESSION['id'] = $user_info['id'];
				$_SESSION['name'] = $user_info['name'];
				$_SESSION['login_success'] = "<p>Welcome to ADIT Solutions CRM</p>";
				header("location:dashboard.php");
			}else {

				session_destroy();
				$_SESSION['login_failure'] = "<p>Invalid login credentials, please try again..</p>";
			}
		} else {
			
			$_SESSION['login_failure'] = "<p>Please fill in all fields!</p>";
		}
		

	}
?>

	<p>User log in</p>
	<?php
		if(isset($_SESSION['login_failure']) && $_SESSION['login_failure'] != ''){

			echo $_SESSION['login_failure'];
			unset($_SESSION['login_failure']);
		}
	?>

	<?php
		if(isset($_SESSION['logout_success']) && $_SESSION['logout_success'] != ''){

			echo $_SESSION['logout_success'];
			unset($_SESSION['logout_success']);
		}
	?>

	<form method="post">
		<p>
			Username
			<input type="text" name="username" placeholder="UserName..">
		</p>
		<p>
			Password
			<input type="password" name="password" placeholder="Password..">
		</p>
		<button type="submit" name="submit">Log In</button>
		<p>
			Don't have an account?..<a href="register.php"> Register</a>
		</p>
	</form>


<?php 
	include("footer.php");
?>