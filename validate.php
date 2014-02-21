<?php

include 'init.php';

if(isset($_POST['code'])) {
	$code = $_POST['code'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Abiosgaming.com </title>
</head>
<body>

	<form action='' method='POST'>
		Confirmation code:<input type='text' name='code' size='16'><br><br>
		<br><br><input type='submit' value='Validate email'>
		<br><br>
	</form>


</body>
</html>
