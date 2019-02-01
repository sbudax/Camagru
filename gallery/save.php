<?php

function add_image($userId, $imgPath) {
    include_once '../config/database.php';

    try {
        $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query= $db->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
        $query->execute(array(':userid' => $userId, ':img' => $imgPath));
        return (0);
    } catch (PDOException $e) {
        return ($e->getMessage());
    }
}