<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <header>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FORGOT</title>
    </header>
    <body>
        <?php include('header.php') ?>
        <?php include('footer.php') ?>
        <div class="head">RESET PASSWORD</div>
        <div>
        <form method="post" action="reset.php" class="fom">
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="Email" >
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="submit">Reset</button>
            </div>
        </form>
            <?php
            echo $_SESSION['error'];
            $_SESSION['error'] = null;
            if (isset($_SESSION['forgot_success'])) {
                echo "An email has been sent, please check your email";
                $_SESSION['forgot_success'] = null;
            }
            ?>
        </div>
    </body>
</html>
