<?php 
    require('DBHelper.php');
    session_start();
    if(isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        // cap nhap offiline
        $query = "update Account set status = 'offline' where accountid = '$id'";
        DBHelper::execute($query);
    }
    session_destroy();
    header("Location: index.php");
    exit();
?>