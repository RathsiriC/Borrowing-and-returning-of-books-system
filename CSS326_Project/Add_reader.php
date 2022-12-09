<?php
session_start();
if(!isset($_SESSION["staff_id"])){
    header("Location: stafflogin.php?accessdenied");
}
else{
    $loginbutt = $_SESSION["role"];
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
    <title>Add Reader</title>
</head>
<body class="addreaderbody">
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
    <div class="form-card">
        <h1>Fill the form to add New Reader</h1>
        <?php if(isset($_GET['dupli'])){
                    #show meassage if Reader already exit in database
                   echo '<div class = "error">
                    <p>This Reader Name Or Personal ID already regiseted</p>
                </div>';
                } ?>

        <?php if(isset($_GET['id'])){
                    $reader_id = $_GET['id'];
                   echo '<div class = "complete">
                    <p>Reader ID   '; echo $reader_id ; echo '   Created</p>
                </div>';
                } ?>
        <?php if(isset($_GET['notfill'])){

            #show meassage if form is NULL
            echo '<div class = "error">
                    <p>Please the form before submit</p>
                </div>';
            } ?>
        <div class="form-container"></div>
            <form action="add_reader_update.php" class="registform" method = 'post'>
                <div class="form-item-name">
                    <span class="material-symbols-rounded">person</span>
                    <input type="text" placeholder="First Name" id="name" name = "fname" require>
                    <span class="material-symbols-rounded">group</span>
                    <input type="text" placeholder="Last Name" id="name" name = 'lname' require>
                </div>
                <div class="form-item-other">
                    <span class="form-item-icon material-symbols-rounded">phone</span>
                    <input type="text" placeholder="Tel." name = 'tel' require>
                    <span class="material-symbols-rounded">badge</span>
                    <input type="text" placeholder="Persenal ID." name = 'pid' require>
                </div>
                <button>Submit</button>
            </form>
    </div>
</body>
</html>