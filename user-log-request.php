<?php

require 'connectDB.php';
header('Content-Type: application/json');
$sql_user_log = "SELECT * FROM `users_logs` WHERE `status`= '0'";
$result = $conn->query($sql_user_log);
$sql_user_log_rejected = "SELECT * FROM `users_logs_reject` WHERE `status`= '0'";
$result_rejected = $conn->query($sql_user_log_rejected);

$sql_card_reject = "SELECT * FROM `card_reject` WHERE `card_status`='0'";
$result_card_rejected = $conn->query($sql_card_reject);

$data = array(
    'total' => $result->num_rows,
    'total_rejected' => $result_rejected->num_rows,
    'total_card_rejected' => $result_card_rejected->num_rows
);
echo json_encode($data);

// update status to 1
$sql_update = "UPDATE `users_logs` SET `status` = '1' WHERE `status` = '0'";
$conn->query($sql_update);

$sql_update_rejected = "UPDATE `users_logs_reject` SET `status` = '1' WHERE `status` = '0'";
$conn->query($sql_update_rejected);

$sql_update_card_rejected = "UPDATE `card_reject` SET `card_status` ='1' WHERE `card_status`='0'";
$conn->query($sql_update_card_rejected);
