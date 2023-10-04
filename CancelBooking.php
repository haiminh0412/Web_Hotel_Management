<?php
    require('DBHelper.php');
    session_start();

    $roomId = isset($_GET['id']) ? $_GET['id'] : false;
    $customerId = isset($_SESSION['customerId']) ? $_SESSION['customerId'] : false;

    if($roomId && $customerId) {
        $query = "delete from booking where RoomId = $roomId and CustomerId = $customerId and CheckInDate >= DATE(NOW())";
        $result = DBHelper::execute($query);
        header('location: Interace_Room.php');
    }
    else {
        echo 'Loi huy dat phong';
    }
?>