<?php require_once "config/db.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Users</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' type='text/css' href="assets/css/bootstrap.css" />
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/header.css" />
    <?php if ($title == "Users") : ?>
        <link rel="stylesheet" type="text/css" href="assets/css/Users.css">
    <?php elseif ($title == "Manage Users") : ?>
        <link rel="stylesheet" type="text/css" href="assets/css/ManageUsers.css">
    <?php elseif ($title == "Users Log") : ?>
        <link rel="stylesheet" type="text/css" href="assets/css/userslog.css">
    <?php elseif ($title == "Devices") : ?>
        <link rel="stylesheet" type="text/css" href="assets/css/devices.css">
    <?php elseif ($title == "login") : ?>
        <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <?php endif; ?>
</head>

<body>
    <header>
        <div class="text-center">
            <img src="assets/img/logo/logo unisel.png" alt="" width="300" height="150">
        </div>
        <div class="header">
            <div class="logo">
                <a href="index.php">Hostel Management</a>
            </div>
        </div>
        <div class="topnav" id="myTopnav">
            <a href="index.php">Users</a>
            <a href="ManageUsers.php">Manage Users</a>
            <a href="UsersLog.php">Users Log</a>
            <a href="devices.php">Devices</a>
            <a href="guard.php">Security</a>
            <a href="#" data-toggle="modal" data-target="#admin-account">Admin</a>
            <a href="logout.php">Log Out</a>

            <a href="javascript:void(0);" class="icon" onclick="navFunction()">
                <i class="fa fa-bars"></i></a>
        </div>
        <div class="up_info1 alert-danger"></div>
        <div class="up_info2 alert-success"></div>
    </header>