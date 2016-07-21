<?php
	include 'header.php';
	include 'functions.php';
?>

<?php
	if (isset($_POST['submit'])) {
		$name = mysqli_real_escape_string($con, strip_tags(trim($_POST['name'])));
		$surname = mysqli_real_escape_string($con, strip_tags(trim($_POST['surname'])));
		$number = mysqli_real_escape_string($con, strip_tags(trim($_POST['number'])));
		$email = mysqli_real_escape_string($con, strip_tags(trim($_POST['email'])));
		$username = mysqli_real_escape_string($con, strip_tags(trim($_POST['username'])));
		$password = mysqli_real_escape_string($con, strip_tags(trim($_POST['password'])));
		$retype_pw = mysqli_real_escape_string($con, strip_tags(trim($_POST['retype_pw'])));

		if ($name != '' || $surname != '' || $number != '' || $email != '' || $username != '' || $password != '' || $retype_pw != '') {

			$sql = "SELECT * FROM users WHERE cellNumber = '".$number."'"; 
			$res = mysqli_query($con, $sql);

			if (mysqli_num_rows($res) <= 0) {
			
				$sql = "SELECT * FROM users WHERE emailAddress = '".$email."'"; 
				$res = mysqli_query($con, $sql);

				if (mysqli_num_rows($res) <= 0) {

					$sql = "SELECT * FROM users WHERE username = '".$username."'"; 
					$res = mysqli_query($con, $sql);

					if (mysqli_num_rows($res) <= 0) {

						if ($password == $retype_pw) {

							$sql="INSERT INTO users(name,surname,cellNumber,emailAddress,username,password)VALUES('".$name."','".$surname."','".$number."','".$email."','".$username."','".$password."')";
							mysqli_query($con, $sql);
							header('location:login.php');
						} else {
						
							$_SESSION['reg_failure'] = '<p>The entered passwords do not match.</p>';
						}					

					}else {

						$_SESSION['reg_failure'] = '<p>The entered UserName already exists.</p>';
					}

				}else {

					$_SESSION['reg_failure'] = '<p>The entered email address already exists.</p>';
				}

			}else {

				$_SESSION['reg_failure'] = '<p>The entered phone number already exists.</p>';
			}
		} else {
			
			$_SESSION['reg_failure'] = '<p>Please make sure all information is filled in!</p>';
		}

	}
?>
	
	<p>User Registration</p>
	<?php
		if(isset($_SESSION['reg_failure']) && $_SESSION['reg_failure'] != ''){

			echo $_SESSION['reg_failure'];
			unset($_SESSION['reg_failure']);
		}
	?>

	<form method="post">
		<p>
			Name
			<input type="text" name="name">
		</p>
		<p>
			Surname
			<input type="text" name="surname">
		</p>
		<p>
			Phone Number
			<input type="text" name="number">
		</p>
		<p>
			Email Address
			<input type="email" name="email">
		</p>
		<p>
			UserName
			<input type="text" name="username">
		</p>
		<p>
			Password
			<input type="password" name="password">
		</p>
		<p>
			Retype Password
			<input type="password" name="retype_pw">
		</p>

		<button type="submit" name="submit">Register</button>
		<p>
			Already have an account?..<a href="login.php"> Log In</a>
		</p>
	</form>

<?php
	include 'footer.php';
?>