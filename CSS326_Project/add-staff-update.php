<?php
#$staff_id = $_POST['Staff-ID'];
$fname = $_POST['Fname'];
$lname = $_POST['Lname'];
$password = $_POST['Password'];
$permission = $_POST['permission'];

$fullname = $fname." ".$lname;

if(!isset($permission)){
    $permission = "Staff";
}

require_once('connect.php');


$dupli = "SELECT * FROM staff WHERE Staff_Name='$fullname'";
$search = $mysqli -> query($dupli);
$count = $search -> num_rows;

if ($count >= 1){
    header("Location: add_staff.php?dupli");
}
else{
    $q = "INSERT INTO `staff` (`Staff_ID`, `Staff_Name`, `Permission`, `Password`) VALUES (NULL, '$fullname', '$permission', '$password');";
    $result = $mysqli -> query($q);
    header("Location: manage_staff.php?newstaffsubmit");
}


    

?>