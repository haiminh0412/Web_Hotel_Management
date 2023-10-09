<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/form_service.css">
    <title>Document</title>
</head>
<body>
<?php 
   require_once('DBHelper.php');
    include 'inc/navigation.php';
    $select = "Select * from Account as a join customer as c on a.CustomerId = c.CustomerId where a.username = '$username_booking' " ;
$result = DBHelper::executeResult($select);
$row = $result->fetch_assoc();
$name_infor = $row['Name'];
$email_infor = $row['Email'];
$phone_infor = $row['phoneNumber'];
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
    if(isset($_POST['booking_date-out'])){
       
        $date_out = $_POST['booking_date-out'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    $query = "Select * from service_event_room where room_name = '$name_room'";
    $res = DBHelper::executeResult($query);
    $get_row = $res->fetch_assoc();
    $price = $get_row['price'];

    if(isset($_POST['submit'])){
        $query =  "INSERT INTO `information_booking`(`name`, `number_phone`, `date_booking`, `note`, `email`, `date_checkout`, `user_booking`, `room_name`) VALUES ('$name_booking','$phone','$date','$note','$email','$date_out','$username_booking','$name_room')";
        $timestamp_in = strtotime($date);
        $timestamp_out = strtotime($date_out);
        $date = date("Y-m-d", strtotime($date));
        $condition = "SELECT * FROM information_booking
        WHERE '$date' BETWEEN date_booking AND date_checkout
        AND room_name = '$name_room'";
        
        $result = DBHelper::executeResult($condition);
        if($timestamp_in - $timestamp_out > 0 ){
            echo "<script> alert('Vui Lòng Chọn Ngày CheckIn < CheckOut') </script>";
        }
        else if($result->num_rows > 0){
            echo "<script> alert('Dịch Vụ Này Đã Được Đặt Vào Ngày Này Vui Lòng Chọn Ngày Khác') </script>";
        }
        else{
            $res = DBHelper::execute($query);
            if($res == true){
                echo "<script> alert('Đặt Phòng Thành Công') </script>";
            }
            else {
                echo "<script> alert('Đặt Phòng Thất Bại') </script>";
              }
        }
    }


  ?>
    
   
    <div class="form-container">
        <form method="POST">
            <h4>Đăng Ký Thông Tin Phòng Tổ Chức Sự Kiện</h4>
            <label for="name_room">Tên Phòng:</label>
            <input type="text" id="name_room" name="name_room" value="<?php echo $name_room; ?>" readonly>
            <label for="name">Họ và Tên:</label>
            <input type="text" id="name" name="name" value="<?php echo $name_infor; ?>" required>
            <label for="phone">Số Điện Thoại:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone_infor; ?>" required>
            <label for="booking-date-in">Ngày Đặt Phòng:</label>
            <input type="date" id="booking-date-in" min="<?php echo date('Y-m-d'); ?>" name="booking_date-in" required>
            <label for="booking-date-out">Ngày Trả Phòng:</label>
            <input type="date" id="booking-date-out" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" name="booking_date-out" required>
            <label for = "price">Giá Tiền Một Ngày Thuê</label>
            <input type = "text" id = "price" name = "price" min = "0" value="<?php echo $price; ?>"  readonly > 
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email_infor; ?>" required>
            <label for="note">Ghi Chú:</label>
            <textarea id="note" name="note" rows="4"></textarea>
            <input type="submit" name="submit" value="Đặt Phòng">
            <input type="button" name="btnback" value="Trở Lại" id="back-button" onclick="window.location.href='booking_service.php'; return false;">
        </form>
    </div>

</body>
</html>