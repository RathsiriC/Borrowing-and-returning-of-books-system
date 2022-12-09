<?php 

$book_id = $_POST['book_id'];
$reader_id = $_POST['reader_id'];
$staff_id = $_POST['staff_id'];
$borrow_date = $_POST['borrow_date'];
$due_date = $_POST['due_date'];



require_once('connect.php');

$book_check = "SELECT * FROM book WHERE book_id ='$book_id'";
$search_book = $mysqli -> query($book_check);
$count_book = $search_book -> num_rows;

$reader_check = "SELECT * FROM reader WHERE reader_id='$reader_id'";
$search_reader = $mysqli -> query($reader_check);
$count_reader = $search_reader -> num_rows;


if(($count_book >= 1) AND ($count_reader >= 1)){
    $copies_update = $search_book -> fetch_array();
    $copies = $copies_update['Copies'];
    $copies = strval(intval($copies) - 1);
    $update_copies = "UPDATE book SET Copies =  $copies WHERE book_id = $book_id";
    $update = $mysqli -> query($update_copies);

    $q = "INSERT INTO `borrow` (`borrow_id`, `borrow_date`, `due_date`, `return_date`, `book_id`, `staff_id`, `reader_id`) VALUES (NULL, '$borrow_date', '$due_date', NULL, '$book_id', '$staff_id', '$reader_id');";
    $result = $mysqli -> query($q);
    header("Location: staff_dashboard.php?Complete");

}
else{
    header("Location: borrowbook.php?error");
}



?>