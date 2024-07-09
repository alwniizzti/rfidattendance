<?php
// Connect to the database
require 'connectDB.php';
date_default_timezone_set('Asia/Kuala_Lumpur');

// Get the current date and time
$d = date("Y-m-d");
$t = date("H:i:s");

// Check if required parameters are set
if (isset($_GET['card_uid']) && isset($_GET['device_token'])) {
    $card_uid = $_GET['card_uid'];
    $device_uid = $_GET['device_token'];

    // Function to execute a prepared statement and return the result
    function executePreparedStmt($conn, $sql, $params, $types)
    {
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL_Error";
            exit();
        }
        mysqli_stmt_bind_param($stmt, $types, ...$params);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    // Get device details
    $sql = "SELECT * FROM devices WHERE device_uid=?";
    $result = executePreparedStmt($conn, $sql, [$device_uid], "s");

    if ($row = mysqli_fetch_assoc($result)) {
        $device_mode = $row['device_mode'];
        $device_dep = $row['device_dep'];

        if ($device_mode == 1) {
            // Check if the card is registered for login/logout
            $sql = "SELECT * FROM users WHERE card_uid=?";
            $result = executePreparedStmt($conn, $sql, [$card_uid], "s");

            if ($row = mysqli_fetch_assoc($result)) {
                if ($row['add_card'] == 1) {
                    if ($row['device_uid'] == $device_uid || $row['device_uid'] == 0) {
                        $Uname = $row['username'];
                        $Number = $row['serialnumber'];

                        // Check user logs for login/logout status
                        $sql = "SELECT * FROM users_logs WHERE card_uid=? AND checkindate=? AND card_out=0";
                        $result = executePreparedStmt($conn, $sql, [$card_uid, $d], "ss");

                        if (!$log_row = mysqli_fetch_assoc($result)) {
                            // Login
                            $sql = "INSERT INTO users_logs (username, serialnumber, card_uid, device_uid, device_dep, checkindate, timein, timeout) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                            $timeout = "00:00:00";
                            executePreparedStmt($conn, $sql, [$Uname, $Number, $card_uid, $device_uid, $device_dep, $d, $t, $timeout], "sdssssss");

                            echo "login" . $Uname;
                            exit();
                        } else {
                            // Logout
                            $sql = "UPDATE users_logs SET timeout=?, card_out=1 WHERE card_uid=? AND checkindate=? AND card_out=0";
                            executePreparedStmt($conn, $sql, [$t, $card_uid, $d], "sss");

                            echo "logout" . $Uname;
                            exit();
                        }
                    } else {
                        echo "Not Allowed!";
                        exit();
                    }
                } else {
                    echo "Not registered!";
                    exit();
                }
            } else {
                echo "Not found!";
                exit();
            }
        } else if ($device_mode == 0) {
            // New card addition mode
            $sql = "SELECT * FROM users WHERE card_uid=?";
            $result = executePreparedStmt($conn, $sql, [$card_uid], "s");

            if ($row = mysqli_fetch_assoc($result)) {
                $sql = "SELECT card_select FROM users WHERE card_select=1";
                $result = executePreparedStmt($conn, $sql, [], "");

                if ($selected_row = mysqli_fetch_assoc($result)) {
                    $sql = "UPDATE users SET card_select=0";
                    executePreparedStmt($conn, $sql, [], "");

                    $sql = "UPDATE users SET card_select=1 WHERE card_uid=?";
                    executePreparedStmt($conn, $sql, [$card_uid], "s");

                    echo "available";
                    exit();
                } else {
                    $sql = "UPDATE users SET card_select=1 WHERE card_uid=?";
                    executePreparedStmt($conn, $sql, [$card_uid], "s");

                    echo "available";
                    exit();
                }
            } else {
                $sql = "UPDATE users SET card_select=0";
                executePreparedStmt($conn, $sql, [], "");

                $sql = "INSERT INTO users (card_uid, card_select, device_uid, device_dep, user_date) VALUES (?, 1, ?, ?, CURDATE())";
                executePreparedStmt($conn, $sql, [$card_uid, $device_uid, $device_dep], "sss");

                echo "successful";
                exit();
            }
        }
    } else {
        echo "Invalid Device!";
        exit();
    }
}

// Log all POST and GET data
$p = $_POST;
$g = $_GET;
$log = "POST: " . json_encode($p) . " - GET: " . json_encode($g) . "\n";
file_put_contents('log.txt', $log, FILE_APPEND);
