<?php
function log_in_user($Username, $password)
{
	include_once '../config/database.php';

	try {
		$db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $db->prepare("SELECT id, username FROM users WHERE username=:username AND password=:password AND verified='Y'");
		$Username = strtolower($Username);
		$password = hash("whirlpool", $password);
		$query->execute(array(':username' => $Username, ':password' => $password));

		$var = $query->fetch();
		if ($var == null)
		{
			$query->closeCursor();
			return (-1);
		}
		$query->closeCursor();
		return($var);
	}
	catch (PDOException $e) {
		$v['err'] = $e->getMessage();
		return($v);
	}
}
?>