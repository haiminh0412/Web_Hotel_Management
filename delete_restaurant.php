<?php 
session_start();
$username_booking = $_SESSION['username']; 
require_once('DBHelper.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$delete = "DELETE FROM `information_restaurant` WHERE STT = '$id'";
$res = DBHelper::execute($delete);
if ($res) {
    echo "<script>alert('Hủy Dịch Vụ Thành Công')</script>";
    header("location: info_restaurant.php?username=$username_booking");
    exit(); 
} else {
    echo "Lỗi: " . $conn->error;
}
?>
