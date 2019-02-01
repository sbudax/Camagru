<?php
session_start();

if (!isset($_SESSION['id']))
{
    header("Location: ../index.php");
}

include_once('../config/query.php');

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] != "" && $_GET['id'] != "") {
    $imgId = $db->quote($_GET['id']);

    if ($_GET['action'] == 'like') {

        $res = query_db("SELECT * FROM likes WHERE userid = '{$_SESSION['id']}' AND galleryid = {$imgId}", $db);
        if (empty($res))
            $db->exec("INSERT INTO likes (userid, galleryid, date_and_time) VALUES('{$_SESSION['id']}', {$imgId}, NOW())");
        header("Location: gallery.php");
    }
    else if ($_GET['action'] == 'comment' && isset($_GET['message']) && $_GET['message'] != "") {

        $message = $db->quote($_GET['message']);
        $db->exec("INSERT INTO comment (userid, galleryid, comment, date_and_time) VALUES('{$_SESSION['id']}', {$imgId}, {$message}, NOW())");
        $userId = query_db("SELECT * FROM gallery WHERE id={$imgId}", $db);
        foreach ($userId as $row) {
            $user = $row['userid'];
            $email = query_db("SELECT * FROM users WHERE id={$user}", $db);
            foreach ($email as $mail) {
                $emyl = $mail['email'];
                $username = $mail['username'];
                $subject = "CAMAGRU Comment notification";

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
                    someone just commented on one of your photos, please login for more. </br>     
                </body>
                </html>
                ';
                mail($emyl, $subject, $message, $headers);
            }
        }
       header("Location: gallery.php");
    }
    else if ($_GET['action'] == 'del') {

        $res = query_db("SELECT userid FROM gallery WHERE id={$imgId}", $db);
        if (!empty($res) && $res[0]['userid'] == $_SESSION['id'])
        {
            $db->exec("DELETE FROM gallery WHERE id={$imgId}");
            $db->exec("DELETE FROM likes WHERE galleryid={$imgId}");
            $db->exec("DELETE FROM comment WHERE galleryid={$imgId}");
        }
        header("Location: gallery.php");
    }
    else
        header("Location: ../index.php");
}
else
    header("Location: ../index.php");
?>