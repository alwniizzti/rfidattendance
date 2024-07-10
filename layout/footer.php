<!-- Account Update -->
<div class="modal fade" id="admin-account" tabindex="-1" role="dialog" aria-labelledby="Admin Update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Update Your Account Info:</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="ac_update.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <label for="User-mail"><b>Admin Name:</b></label>
                    <input type="text" name="up_name" placeholder="Enter your Name..." value="Admin" required /><br>
                    <label for="User-mail"><b>Admin E-mail:</b></label>
                    <input type="email" name="up_email" placeholder="Enter your E-mail..." value="admin@gmail.com" required /><br>
                    <label for="User-psw"><b>Password</b></label>
                    <input type="password" name="up_pwd" placeholder="Enter your Password..." required /><br>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" class="btn btn-success">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- //Account Update -->

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="assets/js/bootbox.min.js"></script>
<?php if ($title == 'Manage Users') : ?>
    <script src="assets/js/manage_users.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "manage_users_up.php"
            }).done(function(data) {
                $('#manage_users').html(data);
            });
            setInterval(function() {
                $.ajax({
                    url: "manage_users_up.php"
                }).done(function(data) {
                    $('#manage_users').html(data);
                });
            }, 5000);
        });
    </script>
<?php elseif ($title == 'Users Log') : ?>
    <script src="assets/js/user_log.js"></script>
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
                            if (response.total > 0) {
                                var audio = new Audio('assets/sound/accept.mp3');
                                audio.play();
                            }
                        } else {
                            statusPlay = 0;
                            document.getElementById("sound").innerHTML = "Play";
                        }
                    }
                });
            }, 1000);
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
<?php elseif ($title == 'Devices') : ?>
    <script src="assets/js/dev_config.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "dev_up.php",
                type: 'POST',
                data: {
                    'dev_up': 1,
                }
            }).done(function(data) {
                $('#devices').html(data);
            });
        });
    </script>
<?php endif; ?>
<script>
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({
            'padding-right': scrollWidth
        });
    }).resize();

    function navFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
</body>

</html>