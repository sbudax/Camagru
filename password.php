<?php
session_start();

include_once 'config/database.php';

$_SESSION['error'] = null;

if (isset($_POST['submit'])) {
    $newpass = hash("whirlpool", $_POST['password']);
    $repeatP = hash("whirlpool", $_POST['confirm']);
    $id = $_SESSION['respass'];
    if (strcmp($newpass, $repeatP) == 0) {
        if (strlen($newpass) > 5) {
            try {
                $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query= $db->prepare("UPDATE users SET password=:pass WHERE id=:id");
                $query->execute(array(':pass' => $newpass, ':id' => $id ));
                $_SESSION['reset'] = true;
                $query->closeCursor();
            } catch (PDOException $e) {
                return ($e->getMessage());
            }
        }
        else
            $_SESSION['error'] = "Password must have atleast 5 characters";
    }
    else
        $_SESSION['error'] = "Passwords do not match!";
}
?>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
</header>
<body>
<?php include('header.php') ?>
<?php include('footer.php') ?>
<div class="head">Reset Password</div>
<div>
    <form method="post" style="position: relative;" action="password.php" class="fom">
        <div class="input-group">
            <label>New Password</label>
            <input type="password" name="password" placeholder="New password">
        </div>
        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm" placeholder="Repeat password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="submit">Reset</button>
        </div>
        <span>
            <?php
            echo $_SESSION['error'];
            $_SESSION['error'] = null;
            if (isset($_SESSION['reset'])) {
                echo "Password changed successfully.";
                $_SESSION['reset'] = null;
            }
            ?>
        </span>
    </form>
</div>
</body>
</HTML>
