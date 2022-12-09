<?php
$staff_id = $_POST['staff_id'];
$password = $_POST['password'];
$admin_status = $_POST['admin_check'];

require_once('connect.php');
#Check Permission checkbox
if (isset($admin_status)){
    $role_status = "Admin";
}
else{
    $role_status = "Staff";
}

#Check is staff ID exit and password is corrected 
$q = "SELECT * FROM staff WHERE Staff_ID ='$staff_id' AND Password='$password'";
$result = $mysqli -> query($q);

$count = $result->num_rows;
$row = $result -> fetch_array();



if($staff_id==$row['Staff_ID'] and $password==$row['Password']){
    if($row['Permission'] == "Admin" and $role_status == $row['Permission']){
        session_start();
        $_SESSION["staff_id"] = $row["Staff_ID"];
        $_SESSION["role"] = $role_status;
        header("Location: manage_staff.php");
    }
    elseif($row['Permission'] == "Admin" and $role_status != $row['Permission']){
        session_start();
        $_SESSION["staff_id"] = $row["Staff_ID"];
        $_SESSION["role"] = $role_status;
        header("Location: staff_dashboard.php");
    }
    elseif($row['Permission'] == "Staff" and $role_status == $row['Permission']){
        session_start();
        $_SESSION["staff_id"] = $row["Staff_ID"];
        $_SESSION["role"] = $role_status;
        header("Location: staff_dashboard.php");
    }
    elseif($row['Permission'] == "Staff" and $role_status != $row['Permission']){
        header("Location: stafflogin.php?permissionerror");
        exit();
    }
}
else{
    header("Location: stafflogin.php?loginerror");
    exit();
}
$mysqli->close();

?>