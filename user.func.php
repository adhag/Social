<?php

// Checks to see if $username exists in table 'users' in database $db.
function userExists($db, $username) {
	$username = $db->escape_string($username); // Escape string to prevent injection.
	$query = "SELECT username FROM users WHERE username = '$username'";
	$exists_result = $db->query($query); // Selects rows with the same username as $username.
	if($exists_result === false) {
		// The query failed (due to syntax errors).
		trigger_error('Wrong SQL: Error: ' . $db->error, E_USER_ERROR);
	} else {
		// The query suceeded.
		$rows = $exists_result->num_rows; // $rows is assigned to be the number of rows in the result of the query. 
		return ($rows >= 1); // Return TRUE if more than 0 rows, FALSE if not.
	}
}

// Adds new user to the database with credentials as parameters.

function registerUser($db, $username, $email, $password){
	$username = $db->real_escape_string($username);
	$email = $db->real_escape_string($email);
	$password = $db->real_escape_string($password);
	$privileges = 0; // Not validated.
	$query = "INSERT INTO users (username, email, privilege, password) VALUES ('$username', '$email', '$privileges', '".hash("sha256", $password)."')";
	$add_query = $db->query($query); // Inserts $username, $email, $password into 'users' table.
	if($add_query === false) {
		// The query failed (due to syntax errors).
		trigger_error('Wrong SQL: Error: ' . $db->error, E_USER_ERROR);
	}
	return $db->insert_id; // Returns the ID that was inserted (increments). 0 if it couldn't insert.
}

/* 
TODO: MAKE CASE SENSITIVE
*/
function logIn($db, $username, $password) {
	$username = $db->escape_string($username);
	$password = $db->escape_string($password);
	$query = "SELECT user_id, privilege FROM users WHERE username = '$username' AND password = '".hash("sha256", $password)."'";
	$logIn_query = $db->query($query);
	if($logIn_query === false) {
		trigger_error('Wrong SQL: Error: ' . $db->error, E_USER_ERROR);
	} else {
		if($logIn_query->num_rows == 1) {
			$row = $logIn_query->fetch_assoc();
			if($row['privilege'] > 0) {
				$_SESSION['user_id'] = $row['user_id'];
			} else {
				echo "You haven't validated your email! <br />";
			}
		} else {
			echo "Failed to login. Invalid username or password." . "<br />";
		}
	}
}

function logOut() {
	unset($_SESSION['user_id']);
}

function makeComment($db, $user_id, $comment) {
	$comment = $db->real_escape_string($comment);
	$query = "INSERT INTO comments (user_id, comment) VALUES ('$user_id', '$comment')";
	$comment_query = $db->query($query);
	if($comment_query === false) {
		trigger_error('Wrong SQL: Error: ' . $db->error, E_USER_ERROR);
	} else {
		echo "Congratulations! You made a comment.<br />";
	}
}

function validateEmail($db, $code) {
	$code = $db->real_escape_string($code);
}

















