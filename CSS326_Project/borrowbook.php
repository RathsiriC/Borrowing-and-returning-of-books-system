<?php
session_start();
if(!isset($_SESSION["staff_id"])){
    header("Location: stafflogin.php?accessdenied");
}
else{
    $loginbutt = $_SESSION["role"];
}

if (!isset($_GET['bookid'])){
    $book_id = NULL;
}
else{
    $book_id = $_GET['bookid'];
}
$borrow_date_ =  date('Y-m-d');
$borrow_date = strtotime($borrow_date_);
$due_date_ = strtotime('+7 days', $borrow_date);
$due_date =  date('Y-m-d', $due_date_);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
    <title>Borrow Book</title>
</head>
<body class ="borrow-book">
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
    <div class="borrow-book-form-card">
        <?php if(isset($_GET['error'])){
                    #show meassage if permission error
                   echo '<div class = "error">
                    <p>Reader ID NOT FOUND</p>
                </div>';
                } ?>
        <form class="borrow-book-form" action="borrowbook_update.php"  method = 'post'>
            <h4>Book ID</h4>
            <input type="text" placeholder="Book ID" name = 'book_id' value = <?php echo $book_id?>>
            <h4>Reader ID</h4>
            <input type="text" placeholder="Reader ID" name = 'reader_id'>
            <h4>Staff ID</h4>
            <input type="text" name = 'staff_id' value = "<?php echo $_SESSION['staff_id'] ?>">
            <h4>Borrow date ID</h4>
            <input type="date" name = 'borrow_date' value = "<?php echo $borrow_date_;?>"/>
            <h4 id = 'return_date_text'>Return due to</h4>
            <input type="date"  name = "due_date"  value="<?php echo $due_date; ?>" />
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>