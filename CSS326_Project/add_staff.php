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
    <title>Add Staff</title>
</head>
<body class="addstaffbody">
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
    <div class="staff-form-card">
        <h1>Fill Staff Infomation</h1>
        <div class="staff-form-container">
            <form action="add-staff-update.php" class="registform" method = "post">
                <div class="staff-form-item-name">
                    <span class="material-symbols-rounded">person</span>
                    <input type="text" placeholder="First Name" id="name" name = "Fname">
                    <span class="material-symbols-rounded">group</span>
                    <input type="text" placeholder="Last Name" id="name" name = "Lname">
                </div>
                <div class="staff-form-item-other">
                    <div class = "item-other-element">
                        <span class="material-symbols-rounded">lock</span>
                        <input type="password" placeholder="Password."name = "Password">
                    </div>
                    <div class = "item-other-element">
                        <span class="material-symbols-rounded">checklist</span>
                            <select name = "permission" require>
                                <option value="" hidden disabled selected>Permission</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                    </div>
                </div>
                <button>Submit</button>
            </form>
        </div>
    </div>
    
</body>
</html>