<?php
session_start();

if (!isset($_SESSION['id']))
{
    header("Location: ../index.php");
}

include_once('../config/query.php');

if (isset($_GET['action']) && isset($_GET['id']) && $_GET['action'] != "" && $_GET['id'] != "") {
    $imgId = $db->quote($_GET['id']);

    if ($_GET['action'] == 'del') {
        $res = query_db("SELECT userid FROM gallery WHERE id={$imgId}", $db);
        if (!empty($res) && $res[0]['userid'] == $_SESSION['id'])
        {
            $db->exec("DELETE FROM gallery WHERE id={$imgId}");
            $db->exec("DELETE FROM likes WHERE galleryid={$imgId}");
            $db->exec("DELETE FROM comment WHERE galleryid={$imgId}");
        }
        header("Location: camera.php");
    }
    else
        header("Location: ../index.php");
}
else
    header("Location: ../index.php");
?>