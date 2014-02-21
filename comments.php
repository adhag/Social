<?php

include 'init.php';

if(isset($_POST['submitcomment'])) {
	// User clicked "Submit comment" button.
	if(isset($_SESSION['user_id'])) {
		// User is logged in.
		if(isset($_POST['comment'])) {
			$comment = $_POST['comment'];
		} else {
			echo "Please enter a comment.<br />";
		}
		makeComment($db, $_SESSION['user_id'], $_POST['comment']);
	} else {
		echo "You are not logged in.<br />";
	}
}
if(isset($_POST['viewcomments'])) {
	$query = "SELECT * FROM comments";
	$view_query = $db->query($query);
	if($view_query === false) {
		trigger_error('Wrong SQL: Error: ' . $db->error, E_USER_ERROR);
	} else {
		while($info = $view_query->fetch_array()) {
			echo "Comment ID: " . $info['comment_id'] . "<br />" . 
			"User ID: " . $info['user_id'] . "<br />" .
			"Comment: " . $info['comment'] . "<br />" .
			"----------------------<br />";
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
	<form action='' method='POST'>
		<textarea rows="10" name="comment" cols="30">Enter your comment here.</textarea>
		<br>
		<input type='submit' name='submitcomment' value='Submit comment'><br><br>
		<input type='submit' name='viewcomments' value='View all comments'><br>
	</form>


	<?php
	include 'menu.html';
	?>



</body>
</html>
