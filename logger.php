<?php
include("db.php");

function logAction($user_id, $action) {
    global $conn;
    $sql = "INSERT INTO logs (user_id, action) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $action);
    $stmt->execute();
}
?>
