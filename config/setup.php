<?php
include 'database.php';

try {
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = sprintf("DROP DATABASE IF EXISTS %s; CREATE DATABASE %s", $DB_NAME, $DB_NAME);
    $db->exec($sql);
    echo "Database created successfully\n";
}

catch (PDOException $e) {
    echo "ERROR CREATING DB: \n".$e->getMessage()."\nAborting process\n";
    exit;
}

try {
    $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `users` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `username` VARCHAR(50) NOT NULL,
          `email` VARCHAR(100) NOT NULL,
          `password` VARCHAR(255) NOT NULL,
          `token` VARCHAR(50) NOT NULL,
          `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
    )";
    $db->exec($sql);
    echo "Users table created successfully\n";
}

catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

try {
    $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `gallery` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `img` VARCHAR(100) NOT NULL,
          `date_created` timestamp NOT NULL
    )";
    $db->exec($sql);
    echo "Gallery table created successfully\n";
}
catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

try {
    $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE `likes` (
          `id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          `date_and_time` datetime NOT NULL
    )";
    $db->exec($sql);
    echo "Like table created successfully\n";
}

catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}

try {
    $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DROP TABLE IF EXISTS `comment`";
    $sql = "CREATE TABLE `comment` (
          `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `userid` INT(11) NOT NULL,
          `galleryid` INT(11) NOT NULL,
          `comment` VARCHAR(255) NOT NULL,
          `date_and_time` timestamp NOT NULL
    )";
    $db->exec($sql);
    echo "Comment table created successfully\n";
}

catch (PDOException $e) {
    echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
}
?>