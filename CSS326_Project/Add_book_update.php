<?php 
$book_id = $_POST["book_id"];
$title = $_POST["title"];
$publisher_name = $_POST["publisher_name"];
$author = $_POST["author"];
$copies = $_POST["Copies"];



require_once("connect.php");

$book_id_check = "SELECT * FROM `book` WHERE book_id ='$book_id'";
$result = $mysqli -> query($book_id_check);
$book_count =  $result->num_rows;
if ($book_count >= 1){  #check book id is duplicated or not
    header("Location: Add_book.php?duplicatebook");
}
else{
    $publisher_name_check = "SELECT * FROM `publisher` WHERE publisher_name ='$publisher_name'";
    $publisher_result = $mysqli -> query($publisher_name_check);
    $publisher_count =  $publisher_result->num_rows;

    if($publisher_count >= 1){ # publisher already in databse -> check author next
        $author_check = "SELECT * FROM `author` WHERE author_name ='$author'";
        $author_result = $mysqli -> query($author_check);
        $author_count =  $author_result->num_rows;

        if($author_count >=1){ # author already in databse -> add new book
            $add_book = "INSERT INTO `book` (`book_id`, `title`, `publisher_name`, `author`, `Copies`) VALUES ('$book_id', '$title', '$publisher_name', '$author', '$copies');";
            $adding = $mysqli -> query($add_book);
            header("Location: Add_book.php?Complete");
        }
        else{ #incase that no author in database
            $publisher_result_arr = $publisher_result -> fetch_array();
            $publisher_id =$publisher_result_arr['publisher_id'];
            $add_author = "INSERT INTO `author` (`author_id`, `author_name`, `publisher_id`) VALUES (NULL, '$author', '$publisher_id');";
            $adding_author = $mysqli -> query($add_author); # add author first

            $add_book = "INSERT INTO `book` (`book_id`, `title`, `publisher_name`, `author`, `Copies`) VALUES ('$book_id', '$title', '$publisher_name', '$author', '$copies');";
            $adding = $mysqli -> query($add_book); #then add the book
            header("Location: Add_book.php?Complete");
        }

    }
    else{
        $add_publisher = "INSERT INTO `publisher` (`publisher_name`, `publisher_id`) VALUES ('$publisher_name', NULL);";
        $adding_publisher = $mysqli -> query($add_publisher);
        $publisher_id =  ($mysqli->insert_id);
        
        $add_author = "INSERT INTO `author` (`author_id`, `author_name`, `publisher_id`) VALUES (NULL, '$author', '$publisher_id');";
        $adding_author = $mysqli -> query($add_author); # add author first

        $add_book = "INSERT INTO `book` (`book_id`, `title`, `publisher_name`, `author`, `Copies`) VALUES ('$book_id', '$title', '$publisher_name', '$author', '$copies');";
        $adding = $mysqli -> query($add_book); #then add the book
        header("Location: Add_book.php?Complete");
        
    }
}



?>