<?php

include_once('database.php');

$db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);

function query_db($query, $db) {
    try {
        $res = $db->query($query);
        return $res->fetchAll();
    } catch(PDOException $e) {
        print("ERROR QUERY ! ". $e->getMessage() ."<br />");
        die();
    }
}
?>