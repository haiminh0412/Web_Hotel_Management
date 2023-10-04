<?php 
session_start();
$username_booking = $_SESSION['username'];
require_once('DBHelper.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$query = "Select * from information_booking where STT = '$id'";
$res = DBHelper::executeResult($query);
$row = $res->fetch_assoc();
$name = $row['name'];
$date_in = $row['date_booking'];
$date_out = $row['date_checkout'];
$email = $row['email'];
$phone = $row['number_phone'];
$note = $row['note'];

if(isset($_POST['name'])){
    $name_booking = $_POST['name'];
}
if(isset($_POST['phone'])){
    $phone = $_POST['phone'];
}
if(isset($_POST['note'])){
    $note_update = $_POST['note'];
}
if(isset($_POST['email'])){
    $email_update = $_POST['email'];
}
if(isset($_POST['submit'])){
    $update = "UPDATE `information_booking` SET `name`='$name_booking',`number_phone`='$phone',`note`='$note_update',`email`='$email_update' WHERE STT = '$id'";
    $result = DBHelper::execute($update);
    $timestamp_in = strtotime($date);
    $timestamp_out = strtotime($check_out);
    if($timestamp_in - $timestamp_out > 0 ){
        echo "<script> alert('Vui Lòng Chọn Ngày CheckIn < CheckOut') </script>";
    }
    else if($result){
        echo "<script> alert('Sửa Thông Tin Thành Công') </script>";
    } else {
        echo "<script> alert('Sửa Thông Tin Thất Bại') </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <title>Document</title>
    <link rel="stylesheet" href="form_service.css">
</head>
<body>
<div class="modal">
    <div class="modal-container">
        <form method="POST" class="form-container" >
            <h4>Sửa Thông Tin Phòng Đã Đăng Kí</h4>
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" value="<?php echo $name ?>" required>
            <label for="phone">Số Điện Thoại:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"  value="<?php echo $email ?>" required>
            <label for="note">Ghi Chú:</label>
            <textarea id="note" name="note" rows="4"><?php echo $note ?></textarea>
            <input type="submit" name="submit" value="Sửa Thông Tin">
            <input type="button" name="btnback" value="Trở Lại" id="back-button" onclick="window.location.href='user_booking_service.php?username=<?php echo $username_booking ?>'; return false;" >

        </form>
    </div>
</div>
</body>
</html>
