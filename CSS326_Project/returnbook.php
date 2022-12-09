<?php 

$borrow_id = $_GET['borrow_id'];

require_once('connect.php');


$return_date =  date('Y-m-d');



$search_id = "SELECT * FROM borrow WHERE borrow_id ='$borrow_id'";

$book_update = $mysqli -> query($search_id);
$book_id_result = $book_update -> fetch_array();

$book_id = $book_id_result['book_id'];

$search_book_id = "SELECT * FROM book WHERE book_id ='$book_id'";

$search_book = $mysqli -> query($search_book_id);
$copies_update = $search_book -> fetch_array();
$copies = $copies_update['Copies'];
$copies = strval(intval($copies) + 1);
$update_copies = "UPDATE book SET Copies =  $copies WHERE book_id = $book_id";
$update = $mysqli -> query($update_copies);

$q = "UPDATE borrow SET return_date = '$return_date' WHERE borrow_id =  $borrow_id;";

$result = $mysqli -> query($q);
header("Location: staff_dashboard.php?Complete");



?>

