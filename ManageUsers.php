<?php $title = 'Manage Users'; ?>
<?php include_once 'layout/header.php'; ?>
<main>
	<h1 class="slideInDown animated">Add a new User or update his information <br> or remove him</h1>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-style-5 slideInDown animated">
					<form enctype="multipart/form-data">
						<div class="alert_user"></div>
						<fieldset>
							<legend><span class="number">1</span> User Info</legend>
							<input type="hidden" name="user_id" id="user_id">
							<input type="text" name="name" id="name" placeholder="User Name...">
							<input type="text" name="number" id="number" placeholder="Serial Number...">
							<input type="email" name="email" id="email" placeholder="User Email...">
						</fieldset>
						<fieldset>
							<legend><span class="number">2</span> Additional Info</legend>
							<label>
								<label for="Device"><b>User Department:</b></label>
								<select class="dev_sel" name="dev_sel" id="dev_sel" style="color: #000;">
									<option value="0">Departments</option>
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
<?php include_once 'layout/footer.php'; ?>