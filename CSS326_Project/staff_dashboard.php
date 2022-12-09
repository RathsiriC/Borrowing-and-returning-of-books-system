<?php session_start();   

if(isset($_SESSION['staff_id'])){
    $loginbutt = $_SESSION['role'];
}
else{
    header("Location: stafflogin.php?accessdenied");
}

require_once('connect.php');
$staff_id =  $_SESSION['staff_id'];
$q = "SELECT * FROM borrow WHERE Staff_ID = $staff_id ORDER BY return_date ASC;";

$result = $mysqli -> query($q);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylesheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
    <title>Document</title>
</head>
<body>
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
    <div class="container">
        <div class="contentcard">
            <div class="content-header">
                <h2>Your responsive Borrow</h2>
                <h3>Your Staff ID IS <?php echo $staff_id ?></h3>
            </div>
            <div class="content-body">
                <table>
                    <tr>
                        <th>Borrow ID</th>
                        <th>Book name</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Reader ID</th>
                        <th>Return</th>
                    </tr>
                    <?php
                    while($row = $result->fetch_array()){
                        $book_id = $row['book_id'];
                        $q2 = "SELECT * FROM `book` WHERE book_id = $book_id;";
                        $result2 = $mysqli -> query($q2);
                        $row2 = $result2 -> fetch_array();
                        if($row['return_date'] == NULL){
                            $status = 'NOT RETURN';
                        }
                        else{
                            $status = NULL;
                        }
                        ?>
                        <tr>
                            <td><?=$row['borrow_id']?></td>
                            <td><?=$row2['title']?></td>
                            <td><?=$row['borrow_date']?></td> 
                            <td><?=$row['due_date']?></td>
                            <td><?=$row['reader_id']?></td>
                            <td><a href = "returnbook.php?borrow_id=<?=$row['borrow_id']?>"><button <?php if(!$status == 'NOT RETURN'){echo 'disabled';} ?> >Return</button><a></td>
                        </tr>                               
                    <?php } 
                    
                ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>