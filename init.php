<?php
session_start();

$db = new mysqli("localhost", "root", "");
if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
}
$db->select_db("abios");

include 'user.func.php';

header('Content-Type: text/html; charset=utf-8');

