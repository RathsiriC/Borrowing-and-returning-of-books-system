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
    <title>Manage Staff</title>
</head>
<body class="manage-staff">
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
    <div class="table-card">
        <div class="table-card-header">
            <H1>List of all Staff</H1>
            <?php if(isset($_GET['accessdenied'])){
                    #show meassage if permission error
                   echo '<div class = "error">
                    <p>You don\'t have permission to get in This page</p>
                </div>';
                } ?>
            <button onclick="window.location.href='add_staff.php'">Add Staff</button>
        </div>
        <div class="staff-list">
            <table>
                <tr>
                    <th id="staff-id">Staff ID</th>
                    <th>Staff Name</th>
                    <th id="staff-status">Status</th>
                    <th id ="staff-status">Permission</th>
                    <th id="edit-button">Edit</th>
                </tr>
                <?php
                    require_once('connect.php');
				 	$q="select * from staff";
					$result=$mysqli->query($q);
					if(!$result){
						echo "Select failed. Error: ".$mysqli->error ;
						return false;
					}
				 while($row=$result->fetch_array()){  ?>
                 <tr>
                    <td><?=$row['Staff_ID']?></td> 
                    <td><?=$row['Staff_Name']?></td>
                    <td id = "td-center"><?=$row['Staff_Status']?></td>
                    <td id = "td-center"><?=$row['Permission']?></td>
                    <td id = "td-center"><a href="edit_staff.php?staff_id=<?=$row['Staff_ID']?>" <span class="form-item-icon material-symbols-rounded">Edit</span></a></td>
                </tr>                               
				<?php } ?>
             
            </table>
        </div>
    </div>
</body>
</html>