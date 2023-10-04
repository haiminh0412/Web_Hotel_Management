<?php 
require('DBHelper.php');
session_start();
$roomId = $_GET['id'];

$query = "delete from wishlist where RoomId = $roomId and CustomerId = {$_SESSION['customerId']}";
$result = DBHelper::execute($query);

if($result) {
    header('location: Interace_Room.php');
}
else {
    echo 'Đã xảy ra lỗi';
}
?>