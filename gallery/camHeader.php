<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="header">
    <h1 class="title_c">Camagru</h1>
    <?php if (isset($_SESSION['id'])) { ?>
        <div class="topnav">
            <a href="../logout.php">Logout</a>
            <a href="gallery.php">Gallery</a>
            <a href="../index.php">Camera</a>
        </div>
    <?php } else { ?>
        <div onclick="location.href='index.php'">
            <div class="topnav">
                <a href="index.php">Login</a>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>