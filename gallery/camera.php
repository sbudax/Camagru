<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="upload.css">
    <meta charset="UTF-8">
    <title>UPLOAD</title>
</header>
<body>
<div id="header">
    <?php include('camHeader.php') ?>
    <p class="user"><?php print_r(htmlspecialchars($_SESSION['username'])) ?></p>
</div>
<?php if(isset($_SESSION['id'])) { ?>
    <div class="cam">
        <div class="row">
            <div class="column">
                <form>
                    <label>
                        <img class="thumbnail" src="../images/beachball.png" onclick="addSup(this)"></img>
                    </label>
                    <label>
                        <img class="thumbnail" src="../images/cat.png" onclick="addSup(this)"></img>
                    </label>
                    <label>
                        <img class="thumbnail" src="../images/feelings.png" onclick="addSup(this)"></img>
                    </label>
                    <label>
                        <img class="thumbnail" src="../images/fire.png" onclick="addSup(this)"/>
                    </label>
                    <label>
                        <img class="thumbnail" src="../images/moustache.png" onclick="addSup(this)"></img>
                    </label>
                    <label>
                        <img class="thumbnail" src="../images/trollface.png" onclick="addSup(this)"></img>
                    </label>
                </form>
                <div>
                    <img src="" id="supImage" width="640px" height="480px" />
                    <video autoplay="true" id="video"  style="border: 2px solid #0099ff; background: grey" width="640" height="480"></video>
                </div>
                <input type="button" id ="capture" class="booth-capture-button" value = "Take photo" disabled>
                <div style="align-content: center">
                    <input type="submit" style="display: none"><a href="upload.php">Upload</a>
                </div>
                <canvas style="display: none;" id="canvas" width="640" height="480"></canvas>
            </div>
            <div class="column">
                <h1 style="color: #0099FF"><strong>Preview</strong></h1>
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
                <form id="capture-form" name="capture-form" method="post" action="camSave.php">
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
    <script type="text/javascript" src="camera.js"></script>
    <script type="text/javascript">
        function removeImage(obj) {
            window.location.href = "CamPrevDel.php?action=del&id=" + obj.value;
        }
    </script>
<?php } ?>
</HTML>
