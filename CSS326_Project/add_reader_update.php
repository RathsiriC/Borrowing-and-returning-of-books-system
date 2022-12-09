<?php
if((isset($_POST['fname'])) and (isset($_POST['lname'])) and (isset($_POST['tel'])) and (isset($_POST['pid']))){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $pid = $_POST['pid'];

    $fullname = $fname." ".$lname;

    require_once('connect.php');

    $dupli = "SELECT * FROM `reader` WHERE p_id ='$pid' or reader_name ='$fullname'";
    $search = $mysqli -> query($dupli);
    $count = $search -> num_rows;

    if ($count >= 1){
        header("Location: add_reader.php?dupli");
    }
    else{
        $q = "INSERT INTO `reader` (`reader_id`, `reader_name`, `tel`, `p_id`) VALUES (NULL, '$fullname', '$tel', '$pid');";
        $result = $mysqli -> query($q);
        $reader_id = $mysqli->insert_id;
        echo $reader_id;
        header("Location: Add_reader.php?id=".$reader_id);
    }
}
else{
    header("Location: add_reader.php?notfill");
}

?>