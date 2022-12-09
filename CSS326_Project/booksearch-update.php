<?php 
$search_type = $_POST['search_type'];
$search_input = $_POST['search_input'];

require_once('connect.php');
#echo $search_input;

if(isset($search_type)){
    if($search_type == 'book_id'){
        $q = "SELECT * FROM `book` WHERE `book_id` LIKE '%$search_input%';";
    }
    if($search_type == 'title'){
        $q = "SELECT * FROM `book` WHERE `title` LIKE '%$search_input%';";
    }
    if($search_type == 'author'){
        $q = "SELECT * FROM `book` WHERE `author` LIKE '%$search_input%';";
    }
    if($search_type == 'publisher'){
        $q = "SELECT * FROM `book` WHERE `publisher` LIKE '%$search_input%';";
    }

}
else{
    $q = "SELECT * FROM `book`";
}

header("Location: booksearch.php?q=".$q);

?>