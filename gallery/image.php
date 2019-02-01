<?php
session_start();

include_once 'save.php';

$imageDir = "images/";

$img = explode(",", $_POST['img']);
$img = base64_decode($img[1]);
$id = $_SESSION['id'];

$iid = uniqid();

if (!file_exists($imageDir)) {
    mkdir($imageDir);
}

file_put_contents($imageDir . $iid . '.jpeg', $img);
add_image($id, $iid . '.jpeg');
header("Location: upload.php");
?>
