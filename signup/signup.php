<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
    <header>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIGNUP</title>
    </header>
    <body>
    <?php include('../footer.php') ?>
        <div class="head">SIGN UP</div>
        <div>
            <form method="post" style="position: relative;" action="register.php" class="fom">
                <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email">
                </div>
                <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username">
                </div>
                <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password">
                </div>
                <div class="input-group">
                    <button type="submit" class="btn" name="submit">Sign Up</button>
                </div>
                <p>
                    Already a member? <a href="../index.php">Sign in</a>
                </p>
                <span>
                    <?php
                    echo $_SESSION['error'];
                    $_SESSION['error'] = null;
                    if (isset($_SESSION['signup_success'])) {
                        echo "Signup success please check your email";
                        $_SESSION['signup_success'] = null;
                    }
                    ?>
                </span>
            </form>
        </div>
    </body>
</HTML>
