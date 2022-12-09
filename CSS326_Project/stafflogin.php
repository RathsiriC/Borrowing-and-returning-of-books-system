<?php
$diable_link = 'style="pointer-events: none;"';
?>

<!DOCTYPE html>
<html>
<head>
    <title> Staff login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylesheet.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
</head>
<body class="loginpagebody">
    <div class="body-header">
        <ul class = "nav-bar">
            <li id = "logo"><img src="logo.svg" alt="logo" width="50" height="50"></li>
            <li><a href="booksearch.php">Book Search</a></li>
            <li><a href="checkreturn.php">Check Return Date</a></li>
            <li class="dropdown" <?php echo $diable_link; ?>>
                <a href="javascript:void(0)" class="dropbtn" >Staff Menu</a>
                <div class="dropdown-content">
                    <a href="staff_dashboard.php">Manage Borrow</a>
                    <a href="borrowbook.php">Submit Borrow</a>
                    <a href="Add_book.php">New Book</a>
                    <a href="Add_reader.php">New Reader</a>
                    <a href="Manage_staff.php">Manage Staff</a>
                </div>
              </li>
            <li class = "active"style="float:right"><a href="stafflogin.php">Staff Login</a></li>
        </ul>
    </div>
    <div class="container-login">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="logo.svg" alt="logo">
            </div>
            <div class="login-card-header">
                <h1>Sign In</h1>
                <?php if(isset($_GET['loginerror'])){
                    #show meassage if password or username not found in database
                   echo '<div class = "error">
                    <p>Incorrect username or password</p>
                </div>';
                } ?>

                <?php if(isset($_GET['permissionerror'])){
                    #show meassage if permission error
                   echo '<div class = "error">
                    <p>You don\'t have permission to login as Admin</p>
                </div>';
                } ?>

                <?php if(isset($_GET['accessdenied'])){
                    #show meassage if permission error
                   echo '<div class = "error">
                    <p>You don\'t have permission to get in This page please login First</p>
                </div>';
                } ?>
            </div>
            <form class="login-card-form" action="stafflogin_update.php" method="post">
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">person</span>
                    <input type="text" name="staff_id" placeholder="Enter Staff ID" required>
                </div>
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">lock</span>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-item-other">
                    <div class="checkbox">
                        <input type="checkbox" name="admin_check" id="admincheckbox">
                        <label for="admincheckbox">Log in as admin</label>
                    </div>
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>