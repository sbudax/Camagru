<?php
session_start();
include_once 'verifying.php';
?>
<!DOCTYPE html>
<html>
    <header>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta charset="UTF-8">
        <title>VERIFY</title>
    </header>
    <body>
        <div class="login">
            <?php if (verify($_GET["token"]) == 0) { ?>
            <strong>
                <h1 style="color: #00cc00; font-weight: bold;" style="text-align: center;">Your account has been succefully verified</h1>
                </br>
                <a href="../index.php" style="text-align: center; font-weight: bold">Login</a>
            </strong>
            <?php } else { ?>
            <strong>
                <p style="color: red">Account not found</p>
            </strong>
            <?php } ?>
        </div>
    </body>
</html>
