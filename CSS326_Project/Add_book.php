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
    <title>Add New book</title>
</head>
<body class = "add-new-book">
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
    <div class="add-book-form-card">
        <h2>Add new Book</h2>
        <?php if(isset($_GET['duplicatebook'])){
                    #show meassage if password or username not found in database
                   echo '<div class = "error">
                    <p>This book ID is alredy in database</p>
                </div>';
                } ?>
        <?php if(isset($_GET['Complete'])){
                    #show meassage if password or username not found in database
                   echo '<div class = "complete">
                    <p>Add new Book Complete!!!</p>
                </div>';
                } ?>
        <form  class = "add-new-book-form" action = "Add_book_update.php" method="post">
            <input type="text" name ="book_id" placeholder ="Book ID">
            <input type="text" name ="title" placeholder ="Title">
            <input type="text" name ="publisher_name" placeholder ="Publisher">
            <input type="text" name ="author" placeholder ="Author">
            <input type="text" name = "Copies" placeholder ="Copies">
            <button>Submit</button>
        </form>
    </div>
</body>
</html>