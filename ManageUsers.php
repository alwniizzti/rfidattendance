<?php
require 'connectDB.php';
if (!isset($_SESSION['Admin-name'])) {
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Manage Users</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/manageusers.css">

	<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
	</script>
	<script type="text/javascript" src="js/bootbox.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/manage_users.js"></script>
	<script>
		$(window).on("load resize ", function() {
			var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
			$('.tbl-header').css({
				'padding-right': scrollWidth
			});
		}).resize();
	</script>
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
</head>

<body>
	<?php include 'header.php'; ?>
	<main>
		<h1 class="slideInDown animated">Add a new User/update information <br> /delete </h1>
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-style-5 slideInDown animated">
						<form enctype="multipart/form-data">
							<div class="alert_user"></div>
							<fieldset>
								<legend><span class="number">1</span> User Info</legend>
								<input type="hidden" name="user_id" id="user_id">
								<input type="text" name="name" id="name" placeholder="Name...">
								<input type="text" name="number" id="number" placeholder="Matric Number...">
								<input type="email" name="email" id="email" placeholder="Email...">
							</fieldset>
							<fieldset>
								<legend><span class="number">2</span> Additional Info</legend>
								<label>
									<label for="Device"><b>User Block:</b></label>
									<select class="dev_sel" name="dev_sel" id="dev_sel" style="color: #000;">
										<?php
										$sql = "SELECT * FROM devices ORDER BY device_name ASC";
										$result = mysqli_stmt_init($conn);
										if (!mysqli_stmt_prepare($result, $sql)) {
											echo '<p class="error">SQL Error</p>';
										} else {
											mysqli_stmt_execute($result);
											$resultl = mysqli_stmt_get_result($result);
											while ($row = mysqli_fetch_assoc($resultl)) {
										?>
												<option value="<?php echo $row['device_uid']; ?>"><?php echo $row['device_dep']; ?></option>
										<?php
											}
										}
										?>
									</select>
									<input type="radio" name="gender" class="gender" value="Female">Female
									<input type="radio" name="gender" class="gender" value="Male" checked="checked">Male
								</label>
							</fieldset>
							<button type="button" name="user_add" class="user_add">Add User</button>
							<button type="button" name="user_upd" class="user_upd">Update User</button>
							<button type="button" name="user_rmo" class="user_rmo">Remove User</button>
						</form>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="slideInRight animated">
						<div class="mt-5 pt-3" id="manage_users"></div>
					</div>
				</div>
			</div>

		</div>



	</main>
</body>

</html>