<?php
// START SESSION
session_start();

// Malaysia Timezone
date_default_timezone_set('Asia/Kuala_Lumpur');

// DATABASE CREDINTIALS
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'rfidattendance');

// SITE URL
define('SITE_URL', 'http://localhost:8080/');

// SITE NAME
define('SITE_NAME', 'UNISEL RFID ATTENDANCE');

// CONNECT TO DATABASE
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// CHECK CONNECTION
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

include_once 'functions.php';
