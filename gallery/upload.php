<?php
session_start();
include_once("save.php");

if (!$_SESSION['id'])
    header("Location: ../index.php");

$dir = "uploads/";
$file_name = $_FILES['uploaded_img']['name'];
$temp = $_FILES['uploaded_img']['tmp_name'];
$file_n = $dir . $file_name;
if (!file_exists($dir)) {
    mkdir($dir, 0755);
}
if (move_uploaded_file($temp, $file_n)) {
    echo "The file ". $_FILES["fileToUpload"]["name"] . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
}

?>
<!DOCTYPE html>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="upload.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPLOAD</title>
</header>
<body>
<div id="header">
    <?php include('header.php') ?>
    <p class="user"><?php print_r(htmlspecialchars($_SESSION['username'])) ?></p>
</div>
<?php if(isset($_SESSION['id'])) { ?>
    <div class="cam" style="overflow-y:scroll;">
        <div class="row">
            <div class="column">
                <div style="align-content: center">
                    <form>
                        <label>
                            <img class="thumbnail" src="../images/horns.png" onclick="addSup(this)"></img>
                        </label>
                        <label>
                            <img class="thumbnail" src="../images/dog.png" onclick="addSup(this)"></img>
                        </label>
                        <label>
                            <img class="thumbnail" src="../images/flowers.png" onclick="addSup(this)"></img>
                        </label>
                        <label>
                            <img class="thumbnail" src="../images/rainbow.png" onclick="addSup(this)"/>
                        </label>
                        <label>
                            <img class="thumbnail" src="../images/frame.png" onclick="addSup(this)"></img>
                        </label>
                        <label>
                            <img class="thumbnail" src="../images/kitty.png" onclick="addSup(this)"></img>
                        </label>
                    </form>
                    <div id="frme">
                        <img src="" id="superimg" alt="" width="640px" height="480px" />
                        <img src="<?php echo $file_n;?>" id="img_upload" alt="" width="640px" height="480px" />
                    </div>
                    <div style="margin-top: 4px">
                    <form method="post" enctype="multipart/form-data" class="img" action="upload.php")">
                    <div>
                        <input type="file" accept="image/*" name="uploaded_img">
                        <input type="submit" value="Upload"/>
                    </div>
                    </form>
                        <input type="button" id ="capture2" class="booth-capture-button" value = "Save photo" disabled>
                    <a href="camera.php">Camera</a>
                    </div>
                </div>
                <canvas id="canvas" height="480px" width="640px" style="display: none"></canvas>
            </div>
            <div class="column">
                <h1 style="color: #0099FF">Preview</h1>
                <?php
                include_once '../config/database.php';
                include_once('../config/query.php');
                try {
                    $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   
                    $db->query("SELECT COUNT(*) FROM gallery")->fetch()[0];
                    $images = query_db("SELECT * FROM gallery ORDER BY date_created DESC", $db); ?>
                    <?php foreach ($images as $row)  { ?>
                        <div id="img_div" class="pic" style="float: left">
                            <img class="one" src="images/<?php echo $row['img']; ?>" />
                            <button class="button" onclick="removeImage(this);" value="<?php echo $row['id']; ?>">Delete</button>
                        </div>
                    <?php  }
                }  catch(PDOException $e) {
                    return ($e->getMessage());
                } ?>
                <form id="capture-form" name="capture-form" method="post" action="image.php">
                    <input type="hidden" name="img" id="picture" value=""/>
                </form>
            </div>
        </div>
    </div>
<?php } else { ?>
    Please Log In!
<?php } ?>
<div id="footer">
    <?php include('footer.php') ?>
</div>
</body>
<?php if(isset($_SESSION['id'])) { ?>
    <script type="text/javascript" src="upload.js"></script>
    <script type="text/javascript">
        function removeImage(obj) {
            window.location.href = "prevdel.php?action=del&id=" + obj.value;
        }
    </script>
<?php } ?>
</HTML>
