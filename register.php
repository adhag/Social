<?php

include 'init.php';

// Checks to see that password is strong
function checkPassword($pwd, &$errors) {
	$errors_init = $errors;

	if (strlen($pwd) < 8) {
		$errors[] = "Password too short!";
	}

	if (!preg_match("#[0-9]+#", $pwd)) {
		$errors[] = "Password must include at least one number!";
	}

	if (!preg_match("#[a-zA-Z]+#", $pwd)) {
		$errors[] = "Password must include at least one letter!";
	}     

	return ($errors == $errors_init);
}

if (isset ($_POST['password'], $_POST['username'], $_POST['email'])){

	$errors = array (); // Array with errors

	// Check username
	if(empty($_POST['username'])) {
		// Username field is empty.
		$errors[] = 'No username entered.';
	} else {
		$registerUsername = $_POST['username'];
		if(userExists($db, $registerUsername)) {
			$errors[] = 'That username is taken.';
		}
	}

	// Check password
	if(empty($_POST['password'])) {
		// Password field is empty.
		$errors[] = 'No password entered.';
	} else {
		$registerPassword = $_POST['password'];
		checkPassword($registerPassword, $errors);
	}

	// Check email
	if(empty($_POST['email'])) {
		// Email field is empty.
		$errors[] = 'No email entered.';
	} else {
		// Email field is not empty.
		$registerEmail = $_POST['email'];
		$result = filter_var($registerEmail, FILTER_VALIDATE_EMAIL); // Filter email input to check if valid email address.
		if(!$result) {
			// Invalid email address.
			$errors[] = 'Invalid email address';
		}
	}

	// Check so that there have been no errors
	if(empty($errors)) {
		// Check so that the user doesn't already exist.
		if(!userExists($db, $registerUsername)) {
			// User doesn't exist.
			$registerUser = registerUser($db, $registerUsername, $registerEmail, $registerPassword); // Attempt to add user to table 'users'. Returns given user id (0 if adding failed).
			if($registerUser > 0) {
				// The registration succeeded.
				header('location:validate.php');
			} else {
				// The registration failed.
				$errors[] = "Registration failed.";
			}
		} else {
			// User exists.
			$errors[] = 'Username already exists';
		}
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Abiosgaming.com </title>
</head>
<body>
	<p>Register here.</p>
	<form action='' method='POST'>
		Username:<input type='text' name='username' size='16'><br><br>
		Password:<input type='password' name='password' size='16'><br><br>
		Email:<input type='text' name='email' size='16'>
		<br><br><input type='submit' value='Register'>
		<br><br>
	</form>
	<?php
	if (isset($errors)) {
		echo 'Error(s)', '<br />';
		foreach ($errors as $error) {
			echo $error, '<br />';
		}
	}
	include 'menu.html';
	?>

</body>
</html>
