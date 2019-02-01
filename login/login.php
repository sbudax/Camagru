<?php
session_start();

include 'signin.php';

$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['error'] = null;
if (($var = log_in_user($username, $password)) == -1)
{
	$_SESSION['error'] = "Invalid user info";
}
else if (isset($var['err']))
{
	$_SESSION['error'] = $var['err'];
}
else
{
	$_SESSION['id'] = $var['id'];
	$_SESSION['username'] = $var['username'];
}
header("Location: ../index.php")
?>