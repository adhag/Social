<?php

/*
database.php är en fil för utveckling som skriver ut alla användare i databasen.
*/

include 'init.php';

$query = "SELECT * FROM users";
$db_query = $db->query($query);

if($db_query === false) {
	trigger_error('Wrong SQL: Error: ' . $db->error, E_USER_ERROR);
} else {
	while($info = $db_query->fetch_array()) {
		echo "User ID: " . $info['user_id'] . "<br />" .
		"Username: " . $info['username'] . "<br />" .
		"Email: " . $info['email'] . "<br />" .
		"Privilege: " . $info['privilege'] . "<br />" .
		"Password: " . $info['password'] . "<br />" .
		"----------------------<br />";
	}
}

?>

<style type="text/css">
</style>

<!DOCTYPE html>
<html>
<head>
	<title> Database </title>
</head>
<body>

	<?php
	include 'menu.html';
	?>
	
</body>
</html>
