<?php
function sign_up($email, $username, $password, $host)
{
    include_once '../config/database.php';
    include_once '../emails/email.php';

    $email = strtolower($email);

    try {
        $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = $db->prepare("SELECT id FROM users WHERE username=:username OR email=:email");
        $query->execute(array(':username' => $username, ':email' => $email));

        if ($val = $query->fetch())
        {
            $_SESSION['error'] = "User already exist";
            $query->closeCursor();
            return (-1);
        }
        
        $query->closeCursor();

        $password = hash("whirlpool", $password);

        $query = $db->prepare("INSERT INTO users (username, email, password, token) VALUES (:username, :email, :password, :token)");

        $token = uniqid(rand(), true);
        $query->execute(array(':username' => $username, ':email' => $email, ':password' => $password, ':token' => $token));
        verify_email($email, $username, $token, $host);
        $_SESSION['signup_success'] = true;
        return (0);
    }
    
    catch (PDOException $e) {
        $_SESSION['error'] = "ERROR: ".$e->getMessage();
    }
}
?>