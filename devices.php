<?php $title = 'Devices'; ?>
<?php include_once 'layout/header.php'; ?>
<main>
	<h1 class="slideInDown animated">Add a new Device/update/remove/Enable/Disable</h1>

	<section class="container py-lg-5">
		<div class="alert_dev"></div>
		<!-- devices -->
		<div class="row">
			<div class="col-lg-12 mt-4">
				<div class="panel">
					<div class="panel-heading" style="font-size: 19px;">Your Devices:
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#new-device" style="font-size: 18px; float: right; margin-top: -6px;">New Device</button>
					</div>
					<div class="panel-body">
						<div id="devices"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- \\devices -->
		<!-- New Devices -->
		<div class="modal fade" id="new-device" tabindex="-1" role="dialog" aria-labelledby="New Device" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="exampleModalLongTitle">Add new device:</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<label for="User-mail"><b>Device Name:</b></label>
							<input type="text" name="dev_name" id="dev_name" placeholder="Device Name..." required /><br>
							<label for="User-mail"><b>Device Department:</b></label>
							<input type="text" name="dev_dep" id="dev_dep" placeholder="Device Department..." required /><br>
						</div>
						<div class="modal-footer">
							<button type="button" name="dev_add" id="dev_add" class="btn btn-success">Create new Device</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- //New Devices -->
	</section>
</main>
<?php include_once 'layout/footer.php'; ?>