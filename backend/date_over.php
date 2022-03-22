<?php

require('../dbconnect.php');

$sqlpa = "SELECT * FROM (pay_status 
LEFT JOIN package_type ON pay_status.pack_name = package_type.pack_name)
WHERE void = '0' AND resultcode = '00' ORDER BY id DESC";
$resultp = mysqli_query($con, $sqlpa);

date_default_timezone_set('asia/bangkok');
$date = date('Y-m-d');
while ($rowp = mysqli_fetch_array($resultp)) {
  $id = $rowp['id'];
  $period = $rowp['period'];
  $time = strtotime($rowp['datetime_order']);
  $month = '+' . $period . 'day';

  echo $stop_date = date('Y-m-d', strtotime($month, $time));

  if ($date == $stop_date) {
    echo  $id;

    $sql = "UPDATE advertise
                SET ad_status = '4'
                 WHERE pack_id = '$id'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    $sql2 = "UPDATE pay_status
        SET pack_status = '0'
         WHERE id = '$id'";
    $result2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
  }
}
