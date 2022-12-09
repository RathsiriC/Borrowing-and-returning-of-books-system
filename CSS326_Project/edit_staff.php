<?php
    if(isset($_GET['staff_id'])){
        $staff_id = $_GET['staff_id'];

        require_once('connect.php');
        $q="SELECT * FROM staff where Staff_ID=$staff_id";
        $result = $mysqli -> query($q);
        $staff_info = $result->fetch_array();

        $staff_id = $staff_info["Staff_ID"];
        $staff_name = $staff_info["Staff_Name"];
        $staff_status = $staff_info["Staff_Status"];
        $staff_permission = $staff_info["Permission"];

        if($staff_status == "Active"){
            $status_defult_value = "Active";
            $status_select_value = "Disable";
        }else{
            $status_defult_value = "Disable";
            $status_select_value = "Active";
        }

        if($staff_permission == "Admin"){
            $per_defult_value = "Admin";
            $per_select_value = "Staff";
        }else{
            $per_defult_value = "Staff";
            $per_select_value = "Admin";
        }

    }
?>

<?php 
session_start();   

if(isset($_SESSION['staff_id'])){
    $loginbutt = $_SESSION['role'];
    if($_SESSION['role'] == "Staff"){
        header("Location: Manage_staff.php?accessdenied");
    }
}
else{
    header("Location: stafflogin.php?notlogin");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
    <title>Edit Staff</title>
</head>
<body class = "edit-staff-body">
<div class="body-header">
        <ul class = "nav-bar">
            <li id = "logo"><img src="logo.svg" alt="logo" width="50" height="50"></li>
            <li><a href="booksearch.php">Book Search</a></li>
            <li><a href="checkreturn.php">Check Return Date</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Staff Menu</a>
                <div class="dropdown-content">
                    <a href="staff_dashboard.php">Manage Borrow</a>
                    <a href="borrowbook.php">Submit Borrow</a>
                    <a href="Add_book.php">New Book</a>
                    <a href="Add_reader.php">New Reader</a>
                    <a href="Manage_staff.php">Manage Staff</a>
                </div>
              </li>
            <li class = "active"style="float:right"><a href="logout.php"><?php echo 'Log-in as ' .$loginbutt; ?></a></li>
          </ul>
    </div>
    <div class = "edit-form-card">
        <h2>UPDATE STAFF INFOMATION</h2>
        <form class = "edit-form-container" action="edit_staff_update.php" method = "POST">
            <div class ="input-fill">
                <h3>Staff ID</h3>
                <input type="text" value = "<?php echo $staff_id; ?>" name = "Staff_ID" require>
                <h3>Staff Name</h3>
                <Input type = "text"  value = "<?php echo $staff_name; ?>" name = "Staff_name" require>
            </div>
            <div class = "input-select">
                <h3>Status</h3>
                <select name = "staff_status" require>
                    <option value="<?php echo $status_defult_value;?>" selected><?php echo $status_defult_value;?></option>
                    <option value="<?php echo $status_select_value;?>"><?php echo $status_select_value;?></option>
                </select>
                <h3>Role</h3>
                <select name = "permission" require>
                    <option value="<?php echo $per_defult_value;?>" selected><?php echo $per_defult_value;?></option>
                    <option value="<?php echo $per_select_value;?>"><?php echo $per_select_value;?></option>
                </select>
            </div>
            <button>Submit</button>
        </form>
    </div>
</body>
</html>