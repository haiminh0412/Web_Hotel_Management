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