<?php
session_start();

include_once 'config/database.php';

$email = $_POST['email'];
$email = strtolower($email);

if (isset($_POST['submit'])) {

    try {
        $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query= $db->prepare("SELECT * FROM users WHERE email=:email AND verified='Y'");
        $query->execute(array(':email' => $email));
        $all = $query->fetch();
        $mail = $all['email'];
        $username = $all['username'];
        $id = $all['id'];
        if (strcmp($email, $mail) == 0) {
            $subject = "CAMAGRU Password reset";

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From: <no_reply>' . "\r\n";

            $message = '
            <html>
            <head>
                <title>' . $subject . '</title>
            </head>
            <body>
                Hi ' . htmlspecialchars($username) . ' </br>
                To reset your password please click the link </br>
                <a href="http://localhost:8080/Camagru/password.php">Change password</a>      
            </body>
            </html>
            ';
            if(mail($mail, $subject, $message, $headers)) {
                echo "A password reset email has been sent to " . $mail . " \nPlease check your email.";
                $_SESSION['respass'] = $id;
            } else {
                echo "Error please try again!";
            }
        }
        else {
            echo "Please enter a valid email!!!\nOr sign up if you don't have an account.";
        }
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}
?>