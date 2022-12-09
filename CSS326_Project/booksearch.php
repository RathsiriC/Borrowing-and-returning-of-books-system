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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="Stylesheet.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,300,0,0" />
    <title>Book Search</title>
    
</head>
<body class="book-search-page">
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
    <div class="book-search-container">
        <div class = "search-header">
            <h1>Search</h1>
        </div>
        <div class="search-content">
            <form class="search-form" action="booksearch-update.php" method="post">
                <select name = "search_type">
                    <option value="" hidden disabled selected>Select your option</option>
                    <option value="book_id">Book ID</option>
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="publisher">Publisher</option>
                </select>
                <div class="search-bar-button">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="input" name = "search_input">
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="search-result-table">
        <table>
            <tr>
                <th id="book-id">Book ID</th>
                <th id ="title">Book Name</th>
                <th id="publisher">publisher</th>
                <th id="Writer">Author</th>
                <th id="status">status</th>
                <th>Borrow</th>
            </tr>
            <tr> <!-- show output here-->
            <?php
                require_once('connect.php');
                if(isset($_GET['q'])){
                    $q = $_GET['q'];
                    $result=$mysqli->query($q); 
                    while($row=$result->fetch_array()){
                        if($row['Copies'] >= 1){
                            $status = 'Avliable';
                        }
                        else{
                            $status = 'Unavaliable';
                        }
                        $book_id = $row['book_id'];
                        ?>
                        <tr>
                            <td><?=$row['book_id']?></td>
                            <td><?=$row['title']?></td>
                            <td><?=$row['publisher_name']?></td> 
                            <td><?=$row['author']?></td>
                            <td><?php echo ''.$status;  ?></td>
                            <td><a href = "borrowbook.php?bookid=<?=$row['book_id']?>"><button <?php if($status == 'Unavaliable'){echo 'disabled';} ?> >Borrow</button><a></td>
                        </tr>                               
                    <?php } 
                    }
                ?>
            </tr>
            
        </table>
    </div>
</body>
</html>