<?php

if (isset($_POST["login"])) {
    require "connectDB.php";

    $Usermail = $_POST["email"];
    $Userpass = $_POST["pwd"];

    if (empty($Usermail) || empty($Userpass)) {
        header("location: login.php?error=emptyfields");
        exit();
    } elseif (!filter_var($Usermail, FILTER_VALIDATE_EMAIL)) {
        header("location: login.php?error=invalidEmail");
        exit();
    } else {
        $sql_admin = "SELECT * FROM admin WHERE admin_email=?";
        $sql_guard = "SELECT * FROM guard WHERE guard_email=?";
        $result_admin = mysqli_stmt_init($conn);
        $result_guard = mysqli_stmt_init($conn);

        // Check if either SQL statement fails
        if (
            !mysqli_stmt_prepare($result_admin, $sql_admin) ||
            !mysqli_stmt_prepare($result_guard, $sql_guard)
        ) {
            header("location: login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($result_admin, "s", $Usermail);
            mysqli_stmt_execute($result_admin);
            $result_admin = mysqli_stmt_get_result($result_admin);

            mysqli_stmt_bind_param($result_guard, "s", $Usermail);
            mysqli_stmt_execute($result_guard);
            $result_guard = mysqli_stmt_get_result($result_guard);

            // Check if the user exists in the admin table
            if ($row_admin = mysqli_fetch_assoc($result_admin)) {

                $pwdCheck_admin = password_verify(
                    $Userpass,
                    $row_admin["admin_pwd"]
                );
                if ($pwdCheck_admin == true) {
                    session_start();
                    $_SESSION["Admin-name"] = $row_admin["admin_name"];
                    $_SESSION["Admin-email"] = $row_admin["admin_email"];
                    header("location: index.php?login=success");
                    exit();
                }

            }

            // Check if the user exists in the guard table
            elseif ($row_guard = mysqli_fetch_assoc($result_guard)) {
            	
                $pwdCheck_guard = password_verify(
                    $Userpass,
                    $row_guard["guard_pwd"]
                );
                if ($pwdCheck_guard == true) {
                
                    session_start();
                    $_SESSION["Guard-name"] = $row_guard["guard_name"];
                    $_SESSION["Guard-email"] = $row_guard["guard_email"];
                    header("location: index.php?login=success");
                    exit();
                }
            } else {
                header("location: login.php?error=nouser");
                exit();
            }
        }
    }
    mysqli_stmt_close($result);
    mysqli_close($conn);
} else {
    header("location: login.php");
    exit();
}
?>
