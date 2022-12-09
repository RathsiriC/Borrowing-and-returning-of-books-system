<?php session_start()   
?>

<?php if(isset($_SESSION['staff_id'])){
    $loginbutt = "Log in as ".$_SESSION['role'];
}
else{
    $loginbutt = "LOGIN";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylesheet.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
    <title>ReaderSearch</title>
</head>

<body class="Readerpagebody">
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
            <li class = "active"style="float:right"><a href="logout.php"><?php echo $loginbutt; ?></a></li>
          </ul>
    </div>
    <div class="container-reader">
        <h1>Enter your Reader ID to See Return Date</h1>
        <?php if(isset($_GET['readernotfound'])){
                    #show meassage if permission error
                   echo '<div class = "error">
                    <p>Incorrect Reader ID</p>
                </div>';
                } ?>
        <form class="reader-search" action = 'checkreturn_update.php' method = 'post'>
            <div class="search-bar-button">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                    <g>
                        <path
                            d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                        </path>
                    </g>
                </svg>
                <input class="input" name = 'search_input' placeholder="Enter your Reader ID" type="search" require>
                <button type="submit">Search</button>
            </div>
        </form>
        <div class="reserve-table">
            <table>
                <tr>
                    <th id="rev-id">Borrow ID</th>
                    <th>Book Name</th>
                    <th id="rev-date">Borrow date</th>
                    <th id="rev-date">Due date</th>
                    <th id="rev-date">Return Status</th>
                </tr>
                <tr>
                <?php
                    require_once('connect.php');
                    if(isset($_GET['q'])){
                        $q = $_GET['q'];
                        $result=$mysqli -> query($q); 
                        while($row=$result->fetch_array()){
                            $book_id = $row['book_id'];
                            $q2 = "SELECT * FROM `book` WHERE book_id = $book_id;";
                            
                            $result2 = $mysqli -> query($q2);
                            $row2 = $result2 -> fetch_array();
                            if($row['return_date'] == NULL){
                                $status = 'NOT RETURN';
                            }
                            else{
                                $status = 'RETRUNED';
                            }
                        ?>
                        <tr>
                            <td><?=$row['borrow_id']?></td>
                            <td><?=$row2['title']?></td>
                            <td><?=$row['borrow_date']?></td> 
                            <td><?=$row['due_date']?></td>
                            <td><?php echo ''.$status;  ?></td>
                        </tr>                               
                    <?php } 
                    }
                ?>
                </tr>
            </table>
        </div>
    </div>


</body>
</html>