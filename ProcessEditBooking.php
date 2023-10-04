<?php
    require('DBHelper.php');
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
        $roomName = isset($_POST['room-name']) ? $_POST['room-name'] : '';
        $roomType = isset($_POST['room-type']) ? $_POST['room-type'] : '';
        $checkIn = isset($_POST['check-in']) ? $_POST['check-in'] : '';
        $checkOut = isset($_POST['check-out']) ? $_POST['check-out'] : '';
        $guests = isset($_POST['guests']) ? $_POST['guests'] : '';
        $specialRequests = isset($_POST['special-requests']) ? $_POST['special-requests'] : '';
        $pricePerNight = isset($_POST['price-per-night']) ? $_POST['price-per-night'] : '';
        $totalPrice = isset($_POST['total-price']) ? $_POST['total-price'] : '';

        $totalPrice = str_replace(",", "", $totalPrice);
        $totalPrice = str_replace(".", "", $totalPrice);

        $totalPrice = (int)(substr($totalPrice, 0, strlen($totalPrice) - 1));

        $query = "update booking set CheckInDate = '$checkIn', CheckOutDate = '$checkOut', NumberOfPeople = $guests, RequiredSpecial = '$specialRequests',
            TotalAmount= $totalPrice where CustomerId = {$_SESSION['customerId']} and RoomId = {$_GET['id']}";
        
        $result = DBHelper::execute($query);
        if($result) {
            header('location: EditBookingNotice.php');
        }
    }
?>