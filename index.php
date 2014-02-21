<?php

include 'init.php';
if(!isset($_SESSION['user_id'])){
	if(isset($_POST['username'], $_POST['password'])) {

		$errors = array();

		if(empty($_POST['username'])) {
			$errors[] = 'No username entered.';
		} else {
			$loginUsername = $_POST['username'];
		}

		if(empty($_POST['password'])) {
			$errors[] = 'No password entered.';
		} else {
			$loginPassword = $_POST['password'];
		}

		if(empty($errors)) {
			$logIn = logIn($db, $loginUsername, $loginPassword);
		}
	}
} else {
	if(isset($_POST['logout']))
		logOut();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Abiosgaming.com </title>
</head>
<body>

	<?php
	if(!isset($_SESSION['user_id'])){
		?>
		<form action='' method='POST'>
			Username:<input type='text' name='username' size='16'><br><br>
			Password:<input type='password' name='password' size='16'> <br><br>
			<input type='submit' value='Log in'><br><br>
		</form>
		<?php
		if (isset($errors)) {
			echo 'Error(s): ', '<br />';
			foreach ($errors as $error) {
				echo $error, '<br />';
			}
		}

	} else {
		echo "Logged in as user: " . $_SESSION['user_id'] . '<br />';
		?>
		<form action='' method='POST'>
			<input type='submit' name='logout' value='Log out'><br><br>
		</form>
		<?php
	}

	include 'menu.html';
	?>


</body>
</html>
