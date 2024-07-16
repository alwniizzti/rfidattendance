<?php
//Connect to database
require 'connectDB.php';
if (!isset($_SESSION['Admin-name'])) {
  header("location: login.php");
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO `guard` (guard_name, guard_email, guard_pwd) VALUES ('$name', '$email', '$password')";
  $result = $conn->query($sql);

  echo "<script>";
  echo "alert('Success Add Guard');";
  echo "</script>";
}

$sql_guard = "SELECT * FROM `guard`";
$result_guard = $conn->query($sql_guard);
$i = 1;
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
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="js/bootbox.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>
  <section class="container py-lg-5">
    <h1 class="slideInDown animated">List Security</h1>
    <div class="form-style-5">
      <button type="button" data-toggle="modal" data-target="#addGuardModal">Add Security</button>
    </div>
    <div class="slideInRight animated">
      <table class="table" style="color: black;">
        <thead class="table-primary">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
          </tr>
        </thead>
        <tbody class="table-secondary">
          <?php foreach ($result_guard as  $row) : ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $row['guard_name'] ?></td>
              <td><?= $row['guard_email'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
  <!-- Add Guard Modal -->
  <div class="modal fade" id="addGuardModal" tabindex="-1" role="dialog" aria-labelledby="addGuardModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addGuardModalLabel">Add Guard</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="guardName">Name</label>
              <input type="text" class="form-control" id="guardName" name="name" placeholder="Enter guard name">
            </div>
            <div class="form-group">
              <label for="guardEmail">Email</label>
              <input type="email" class="form-control" id="guardEmail" name="email" placeholder="Enter guard email">
            </div>
            <div class="form-group">
              <label for="guardPassword">Password</label>
              <input type="text" class="form-control" id="guardPassword" name="password" placeholder="Enter guard password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Guard</button>
          </div>
        </div>
      </form>

    </div>
  </div>
  </main>
</body>

</html>