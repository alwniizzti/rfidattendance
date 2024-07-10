<?php $title = 'Users'; ?>
<?php include_once 'layout/header.php'; ?>
<?php
$sql_users = "SELECT * FROM `users`";
$result_users = mysqli_query($conn, $sql_users);
?>

<main>
    <section>
        <h1 class="slideInDown animated">Here are all the Users</h1>
        <!--User table-->
        <div class="table-responsive slideInRight animated" style="max-height: 400px;">
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Matric Number</th>
                        <th>Gender</th>
                        <th>Card UID</th>
                        <th>Date</th>
                        <th>Device</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    <?php foreach ($result_users as $key => $user) : ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['serialnumber']; ?></td>
                            <td><?php echo $user['gender']; ?></td>
                            <td><?php echo $user['card_uid']; ?></td>
                            <td><?php echo $user['user_date']; ?></td>
                            <td><?php echo $user['device_dep']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<?php include_once 'layout/footer.php'; ?>