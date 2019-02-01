<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<title>CAMAGRU</title>
	</head>
    <body>
		<?php include('footer.php') ?>
        <?php if (isset($_SESSION['id'])) { ?>
        <img class="image" src="img/user.png" height="45px" width="45px" alt="user">
        <p class="user"><?php print_r(htmlspecialchars($_SESSION['username'])) ?></p>
            <?php header("Location: gallery/camera.php") ?>
        <?php } else { ?>
			<div class="head">LOGIN</div>
			<div>
				<form method="post" action="login/login.php" style="position: relative;" class="fom">
                <div class="input-group">
				<label>Username</label>
				<input type="text" name="username" placeholder="Username" >
				</div>
				<div class="input-group">
				<label>Password</label>
				<input type="password" name="password" placeholder="Password">
				</div>
                    <div class="input-group">
                        <button type="submit" class="btn" name="submit">Login</button>
                    </div>
                <p>
                    <a href="forgot.php">Forgot Password</a>
                </p>
				<p>
					Not yet a member? <a href="signup/signup.php">Sign up</a>
				</p>
          		<span>
            	<?php
				if ($_SESSION['error']) {
					echo $_SESSION['error'];
				}
              $_SESSION['error'] = null;
            ?>
          		</span>
          		</form>
          		<?php } ?>
			</div>
	</body>
</html>