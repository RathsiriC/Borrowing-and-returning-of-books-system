<?php
$staff_id = $_POST['Staff_ID'];
$staff_name = $_POST['Staff_name'];
$staff_status = $_POST['staff_status'];
$staff_permiss = $_POST['permission'];

require_once('connect.php');


$q = "UPDATE staff SET Staff_Name = '$staff_name', Staff_Status = '$staff_status' ,Permission = '$staff_permiss' WHERE Staff_ID = $staff_id";

$mysqli -> query($q);

header("Location:Manage_staff.php");
?>