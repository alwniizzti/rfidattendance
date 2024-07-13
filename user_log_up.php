<?php
//Connect to database
require 'connectdB.php';
?>
<div class="table-responsive" style="max-height: 500px;">
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Serial Number</th>
        <th>Card UID</th>
        <th>Date</th>
        <th>Time In</th>
        <th>Time Out</th>
      </tr>
    </thead>
    <tbody class="table-secondary">
      <?php
      $searchQuery = " ";
      $Start_date = " ";
      $End_date = " ";
      $Start_time = " ";
      $End_time = " ";
      $Card_sel = " ";

      if (isset($_POST['log_date'])) {
        //Start date filter
        if ($_POST['date_sel_start'] != 0) {
          $Start_date = $_POST['date_sel_start'];
          $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
        } else {
          $Start_date = date("Y-m-d");
          $_SESSION['searchQuery'] = "checkindate='" . date("Y-m-d") . "'";
        }
        //End date filter
        if ($_POST['date_sel_end'] != 0) {
          $End_date = $_POST['date_sel_end'];
          $_SESSION['searchQuery'] = "checkindate BETWEEN '" . $Start_date . "' AND '" . $End_date . "'";
        }
        //Time-In filter
        if ($_POST['time_sel'] == "Time_in") {
          //Start time filter
          if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
            $Start_time = $_POST['time_sel_start'];
            $_SESSION['searchQuery'] .= " AND timein='" . $Start_time . "'";
          } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
            $Start_time = $_POST['time_sel_start'];
          }
          //End time filter
          if ($_POST['time_sel_end'] != 0) {
            $End_time = $_POST['time_sel_end'];
            $_SESSION['searchQuery'] .= " AND timein BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
          }
        }
        //Time-out filter
        if ($_POST['time_sel'] == "Time_out") {
          //Start time filter
          if ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] == 0) {
            $Start_time = $_POST['time_sel_start'];
            $_SESSION['searchQuery'] .= " AND timeout='" . $Start_time . "'";
          } elseif ($_POST['time_sel_start'] != 0 && $_POST['time_sel_end'] != 0) {
            $Start_time = $_POST['time_sel_start'];
          }
          //End time filter
          if ($_POST['time_sel_end'] != 0) {
            $End_time = $_POST['time_sel_end'];
            $_SESSION['searchQuery'] .= " AND timeout BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
          }
        }
        //Card filter
        if ($_POST['card_sel'] != 0) {
          $Card_sel = $_POST['card_sel'];
          $_SESSION['searchQuery'] .= " AND card_uid='" . $Card_sel . "'";
        }
        //Department filter
        if ($_POST['dev_uid'] != 0) {
          $dev_uid = $_POST['dev_uid'];
          $_SESSION['searchQuery'] .= " AND device_uid='" . $dev_uid . "'";
        }
      }

      if ($_POST['select_date'] == '1') {
        $Start_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
      }

      $sql = "SELECT * FROM `users_logs` WHERE " . $_SESSION['searchQuery'] . " ORDER BY id DESC";
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