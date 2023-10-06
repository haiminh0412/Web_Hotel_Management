
<?php 
require_once('DBHelper.php');
 include 'inc/navigation.php';
 $select = "Select * from Account as a join customer as c on a.CustomerId = c.CustomerId where a.username = '$username_booking' " ;
$result = DBHelper::executeResult($select);
$row = $result->fetch_assoc();
$name_infor = $row['Name'];
$email_infor = $row['Email'];
$phone_infor = $row['PhoneNumber'];
 if(isset($_GET['room_name'])){
     $name_room = $_GET['room_name'];
   }
 if(isset($_POST['name'])){
     $name_booking = $_POST['name'];
 }
 if(isset($_POST['phone'])){
     $phone = $_POST['phone'];
 }
 if(isset($_POST['booking_date-in'])){
     $date = $_POST['booking_date-in'];
 }
 if(isset($_POST['note'])){
     $note = $_POST['note'];
 }
 if(isset($_POST['email'])){
     $email = $_POST['email'];
 }
 if(isset($_POST['options_room'])){
    $options = $_POST['options_room'];
}

 if(isset($_POST['submit'])){
     $query =  "INSERT INTO `information_restaurant`(`name`, `phone`, `date_booking`, `table_restaurant`, `email`, `note`,`room_name`,`username`) VALUES ('$name_booking','$phone','$date','$options','$email','$note','$name_room','$username_booking')";
     $condition = "Select * from information_restaurant where ('$options','$date','$name_room')  IN  (select table_restaurant,date_booking,room_name from information_restaurant )";    
     $result = DBHelper::executeResult($condition);
      if($result->num_rows > 0){
         echo "<script> alert('Bàn Đã Được Đặt Vào Ngày Này Vui Lòng Đặt Bàn Khác') </script>";
      }
      else{
         $res = DBHelper::execute($query);
         if($res == true){
             echo "<script> alert('Đặt Bàn Thành Công') </script>";
         }
         else {
             echo "<script> alert('Đặt Bàn Thất Bại') </script>";
           }
     }
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/booking_bars_form.css">
    <title>Document</title>

</head>

<body>
    <div class="form-container">
        <form method="POST">
            <h4>Đăng Ký Thông Tin Phòng Bars & Club</h4>
            <label for="name_room">Tên Phòng:</label>
            <input type="text" id="name_room" name="name_room" value="<?php echo $name_room; ?>" readonly>
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" value="<?php echo $name_infor; ?>" required>
            <label for="phone">Số Điện Thoại:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone_infor; ?>" required>
            <label for="booking-date-in">Ngày Đặt Bàn:</label>
            <input type="date" id="booking-date-in" min="<?php echo date('Y-m-d'); ?>" name="booking_date-in" required>
            <label for="options_room">Chọn Bàn Đặt Trước</label>
            <select class="options_room" name="options_room">
            <option value="A101 - Bàn 2 Người">A101 - Bàn 2 Người</option>
            <option value="A102 - Bàn 2 Người">A102 - Bàn 2 Người</option>
            <option value="A103 - Bàn 8 Người">A103 - Bàn 8 Người</option>
            <option value="A104 - Bàn 6 Người">A104 - Bàn 6 Người</option>
            <option value="A105 - Bàn 4 Người">A105 - Bàn 4 Người</option>
            </select>
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" value="<?php echo $email_infor; ?>" required>
            <label for="note">Ghi Chú:</label>
            <textarea id="note" name="note" rows="4"></textarea>
            <input type="submit" name="submit" value="Đặt Phòng">
            <input type="button" name="btnback" value="Trở Lại" id="back-button" onclick="window.location.href='booking_bars.php'; return false;">
        </form>
    </div>
</body>

</html>
</body>

</html>