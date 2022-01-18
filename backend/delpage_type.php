<?php

 require('../dbconnect.php');

$id= $_GET['id'];

$sql = "DELETE FROM user_role_type WHERE id = $id";

$result = mysqli_query($con,$sql) or die(mysqli_error($con));

header("Location:../page/page_type.php");
    

?>