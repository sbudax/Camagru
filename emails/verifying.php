<?php
function verify($token)
{
    include '../config/database.php';

    try {
        $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $db->prepare("SELECT id FROM users WHERE token=:token");
        $query->execute(array(':token' => $token));

        $val = $query->fetch();
        if ($val == null) {
            return (-1);
        }
        $query->closeCursor();

        $query= $db->prepare("UPDATE users SET verified='Y' WHERE id=:id");
        $query->execute(array('id' => $val['id']));
        $query->closeCursor();
        return (0);
    }
    catch (PDOException $e) {
        return (-2);
    }
}
?>