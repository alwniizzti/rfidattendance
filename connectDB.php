<?php
/* Database connection settings */
$servername = "localhost";
$username = "root";        //put your phpmyadmin username.(default is "root")
$password = "";            //if your phpmyadmin has a password put it here.(default is "root")
$dbname = "rfidattendance";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}

$sql_alter = "ALTER TABLE `users_logs` ADD COLUMN `status` INT(1) NOT NULL DEFAULT '0'";
$conn->query($sql_alter);
