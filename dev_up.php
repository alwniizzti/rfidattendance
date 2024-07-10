<?php
require_once "config/db.php";

$sql = "SELECT * FROM `devices` ORDER BY id DESC";
$result = $conn->query($sql);
?>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>De.Name</th>
				<th>De.Department</th>
				<th>De.UID</th>
				<th>De.Date</th>
				<th>De.Mode</th>
				<th>De.Config</th>
			</tr>
		</thead>
		<tbody>
			<form action="" method="POST" enctype="multipart/form-data">
				<?php foreach ($result as $row) : ?>
					<?php
					$radio1 = ($row["device_mode"] == 0) ? "checked" : "";
					$radio2 = ($row["device_mode"] == 1) ? "checked" : "";

					$de_mode = '<div class="mode_select">
                                        <input type="radio" id="' . $row["id"] . '-one" name="' . $row["id"] . '" class="mode_sel" data-id="' . $row["id"] . '" value="0" ' . $radio1 . '/>
                                        <label for="' . $row["id"] . '-one">Enrollment</label>
                                        <input type="radio" id="' . $row["id"] . '-two" name="' . $row["id"] . '" class="mode_sel" data-id="' . $row["id"] . '" value="1" ' . $radio2 . '/>
                                        <label for="' . $row["id"] . '-two">Attendance</label>
                                    </div>';
					?>
					<tr>
						<td><?= $row["device_name"]; ?></td>
						<td><?= $row["device_dep"]; ?></td>
						<td>
							<button type="button" class="dev_uid_up btn btn-warning" id="uid_<?= $row["id"]; ?>" data-id="<?= $row["id"]; ?>" title="Update this device Token">
								<i class="fas fa-edit"></i>
							</button>
							<?= $row["device_uid"]; ?>
						</td>
						<td><?= $row["device_date"]; ?></td>
						<td><?= $de_mode; ?></td>
						<td>
							<button type="button" class="dev_del btn btn-danger" id="del_<?= $row["id"]; ?>" data-id="<?= $row["id"]; ?>" title="Delete this device">
								<i class="fas fa-trash-alt"></i>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</form>
		</tbody>
	</table>
</div>