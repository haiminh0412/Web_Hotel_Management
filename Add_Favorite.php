<?php 
require('DBHelper.php');
session_start();
$roomId = $_GET['id'];

$query = "insert into wishlist(RoomId, CustomerId) values ($roomId, {$_SESSION['customerId']})";
$result = DBHelper::execute($query);

if($result) {
  header('location: Interace_Room.php');
}
else {
    echo 'Đã xảy ra lỗi';
}


// if(isset($_GET['id'])){
//     $room_name = $_GET['id'];
// }
// $select = "SELECT * FROM room WHERE Roomname = ?";
// $stmt = $con->prepare($select);
// $stmt->bind_param("s", $room_name);
// $stmt->execute();
// $result = $stmt->get_result();
// if($result->num_rows > 0){
//     while ($row = $result->fetch_assoc()) {
//         $room = new Room();
        
//         // Kiểm tra xem các khóa trong mảng $row đã tồn tại trước khi sử dụng
//         if(isset($row['Roomtypeid'])){
//             $roomType = $room->getTypeRoom($room_name);
//         }

//         if(isset($row['PricePerNight'])){
//             $price_first = $row['PricePerNight'];
//             $price = number_format($price_first, 0, '.', ',') . 'đ';
//         }

//         if(isset($row['Image'])){
//             $image = base64_encode($row['Image']);
//         }

//         if(isset($row['Area'])){
//             $area = $row['Area'];
//         }

//         if(isset($row['Quantity'])){
//             $quantity = $row['Quantity'];
//         }

//         if(isset($row['Description'])){
//             $des = $row['Description'];
//         }
//     }
// }
//     if(isset($username)){
//         $query_insert = "INSERT INTO `wishlist`(`RoomName`, `RoomTypeId`, `Image`, `PricePerNight`, `Area`, `Quantity`, `Description`, `Users`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
//         $stmt = $con->prepare($query_insert);
//         $stmt->bind_param("ssssssss", $room_name, $roomType, $image, $price_first, $area, $quantity, $des, $username);
//         if($stmt->execute()){
//             echo "<script> alert('Add Thanh Cong') </script>";
//         } else {
//             echo "<script> alert('Add That Bai') </script>";
//         }
//     } else {
//         echo "<script> alert('Username không được định nghĩa') </script>";
//     }
?>
