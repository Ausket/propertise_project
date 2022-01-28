<?php
require('../dbconnect.php');

   echo $del_id =  $_POST['f_id'];


    $sql = "DELETE FROM file WHERE f_id='$del_id'";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    


?>