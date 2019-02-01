<?php
session_start();

if (!$_SESSION['id'])
    header("Location: ../index.php");
?>
<!DOCTYPE html>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="upload.css">
    <link rel="stylesheet" type="text/css" href="gallery.css">
    <link rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPLOAD</title>
</header>
<body background="../images/beautiful.jpg">
<div id="header">
    <?php include('header.php') ?>
    <p class="user"><?php print_r(htmlspecialchars($_SESSION['username'])) ?></p>
</div>
<?php if(isset($_SESSION['id'])) { ?>
    <div class="cam">
        <div class="container">
            <hr>
            <div class="text">Image Gallery</div>
            <hr>
            <?php
            include_once '../config/database.php';
            include_once('../config/query.php');
            try {
                $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->query("SELECT COUNT(*) FROM gallery")->fetch()[0];
                $images = query_db("SELECT * FROM gallery ORDER BY date_created DESC", $db);
                if (empty($images)) {
                    ?> <div class="noImg"> <?php
                        echo "no images to display";
                        ?> </div> <?php
                }
                ?>
                <?php foreach($images as $row) { ?>
                    <div>
                        <button class="closebnt" onclick="removeImage(this);" value="<?php echo $row['id']; ?>"><img class='close' src='../images/delete.png' alt='delete' /></button>
                        <div class='pic' id='frm'>
                            <img class="one" src="images/<?php echo $row['img']; ?>" />
                        </div>
                        <div class="txt">
                            <button class="lykbtn" onclick="likeImage(this);" value="<?php echo $row['id']; ?>"><img class="lyk" src="../images/like.png"/></button>
                            <?php
                            $nb_likes = query_db("SELECT COUNT(*) FROM likes WHERE galleryid='{$row['id']}'", $db);
                            echo $nb_likes[0][0];
                            ?>
                             </div>
                        <textarea class="combox" maxlength="500" name="<?php echo $row['id']; ?>" placeholder="Comment..."></textarea><br />
                        <button class="combtn" onclick="commentImage(this);" value="<?php echo $row['id']; ?>">Comment</button>
                        <h4>Comments</h4>
                        <?php
                        $query = "SELECT users.username AS log_in_user, comment.comment AS comment, DATE_FORMAT(comment.date_and_time, '%b %e %Y, %H:%i') AS date_message FROM comment INNER JOIN users ON comment.userid = users.id WHERE comment.galleryid ='{$row['id']}' ORDER BY comment.date_and_time DESC";
                        $comments = query_db($query, $db);
                        if (!empty($comments)) {
                            foreach ($comments as $comment) {
                                echo "<div class='com'>";
                                echo "<p>";
                                echo "[{$comment['date_message']}]"."</br>";
                                echo "{$comment['log_in_user']}: ";
                                echo $comment['comment'];
                                echo "</p>";
                                echo "</div>";
                            }
                        } ?>
                    </div> <?php
                    ?> <hr> <?php
                }
            } catch (PDOException $e) {
                return ($e->getMessage());
            } ?>
        </div>
    </div>
<?php } else { ?>
    Please Log In!
<?php } ?>
<div id="footer">
    <?php include('footer.php') ?>
</div>
</body>
<script type="text/javascript">
    function likeImage(obj) {
        window.location.href = "comment.php?action=like&id=" + obj.value;
    }
    function removeImage(obj) {
        window.location.href = "comment.php?action=del&id=" + obj.value;
    }
    function commentImage(obj) {
        var comment = document.querySelector("textarea[name='"+ obj.value +"']");
        window.location.href = "comment.php?action=comment&id=" + obj.value + "&message=" + comment.value;
    }
</script>
</HTML>
