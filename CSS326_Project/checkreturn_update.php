<?php 
if(($_POST['search_input']) != NULL){
    $search_input = $_POST['search_input'];
    require_once('connect.php');
    $id_check = "SELECT * FROM `reader` WHERE reader_id = $search_input;";
    $result = $mysqli -> query($id_check);
    $count_reader = $result -> num_rows;
    if($count_reader >= 1 ){
        $q = "SELECT * FROM `borrow` WHERE reader_id = $search_input ORDER BY return_date ASC;";
        header("Location: checkreturn.php?q=".$q);
    }
    else{
        header("Location: checkreturn.php?readernotfound");
    }
}
else{
    header("Location: checkreturn.php");
}

?>


