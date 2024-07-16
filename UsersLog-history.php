<?php
require 'connectDB.php';
if (!isset($_SESSION['Admin-name']) && !isset($_SESSION['Guard-name'])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Users Logs</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="icon" type="image/png" href="icon/ok_check.png"> -->
    <link rel="stylesheet" type="text/css" href="css/userslog.css">
    <script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/user_log.js"></script>
    <script>
        $(window).on("load resize ", function() {
            var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({
                'padding-right': scrollWidth
            });
        }).resize();
    </script>
    <script>
        var statusPlay = 0;
        $(document).ready(function() {
            $.ajax({
                url: "user_log_up.php",
                type: 'POST',
                data: {
                    'select_date': 1,
                }
            }).done(function(data) {
                $('#userslog').html(data);
            });

            setInterval(function() {
                $.ajax({
                    url: "user_log_up.php",
                    type: 'POST',
                    data: {
                        'select_date': 0,
                    }
                }).done(function(data) {
                    $('#userslog').html(data);
                });
                $.ajax({
                    url: "user-log-request.php",
                    type: 'POST',
                    datatype: 'json',
                    success: function(response) {
                        if (statusPlay == 1) {
                            // if (response.total > 0) {
                            //   var audio = new Audio('sound/accept.mp3');
                            //   audio.play();
                            // }
                            if (response.total_rejected > 0) {
                                var audio = new Audio('sound/reject.mp3');
                                audio.play();
                            }
                        } else {
                            statusPlay = 0;
                            document.getElementById("sound").innerHTML = "Play";
                        }
                    }
                });
            }, 5000);
        });

        function play() {
            if (statusPlay == 0) {
                statusPlay = 1;
                document.getElementById("sound").innerHTML = "Stop";
            } else {
                statusPlay = 0;
                document.getElementById("sound").innerHTML = "Play";
            }
        }
    </script>
</head>

<body>
    <?php include 'header.php'; ?>
    <section class="container py-lg-5">
        <!--User table-->
        <h1 class="slideInDown animated">Users logs history</h1>
        <div class="form-style-5">
            <form method="GET" action="">
                <input type="date" class="form-control" name="date" max="<?= date('Y-m-d') ?>" value="<?= $_GET['date'] ?? '' ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <!-- //Log filter -->
        <div class="slideInRight animated">
            <div class="table-responsive" style="max-height: 500px;">
                <table class="table">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Matric Number</th>
                            <th>Card UID</th>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                        </tr>
                    </thead>
                    <tbody class="table-secondary">
                        <?php
                        $sql = "SELECT * FROM `users_logs`";
                        if (isset($_GET['date'])) {
                            $date = $_GET['date'];
                            $sql .= " WHERE `checkindate` ='$date'";
                        }
                        $sql .= " ORDER BY id DESC";
                        $result = mysqli_stmt_init($conn);
                        ?>
                        <?php if (!mysqli_stmt_prepare($result, $sql)) : ?>
                            <p class="error">SQL Error</p>
                        <?php else : ?>
                            <?php
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            $i = 1;
                            ?>
                            <?php if (mysqli_num_rows($resultl) > 0) : ?>
                                <?php while ($row = mysqli_fetch_assoc($resultl)) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['serialnumber']; ?></td>
                                        <td><?= $row['card_uid']; ?></td>
                                        <td><?= $row['checkindate']; ?></td>
                                        <td><?= $row['timein']; ?></td>
                                        <td><?= $row['timeout']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8">No data found</td>
                                </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    </main>
</body>

</html>