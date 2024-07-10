<?php
require_once 'config/db.php';
header('Content-Type: application/json');
$sql_user_log = "SELECT * FROM `users_logs` WHERE `status`= '0'";
$result = $conn->query($sql_user_log);
$data = array(
    'total' => $result->num_rows
);
echo json_encode($data);

// update status to 1
$sql_update = "UPDATE `users_logs` SET `status` = '1' WHERE `status` = '0'";
$conn->query($sql_update);
