<?php
   session_start();
   $username_booking = $_SESSION['username']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .nav-item {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #f4f4f4;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); /* Add shadow to the background */
        }

        .nav-item:after {
            content: "";
            display: table;
            clear: both;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            padding: 16px;
            text-decoration: none;
            color: #333;
        }

        li a:hover {
            background-color: #ddd;
        }

        .h-font {
            font-family: 'Merienda', cursive;
        }

        /* CSS for user information */
        .user-info {
            float: right;
            text-align: center;
            display: flex;
            align-items: center;
        }

        /* Style for user information text */
        .user-info a {
            margin-right: 10px;
            text-decoration: none;
            color: #333;
        }

        /* Hide the sub-menu initially */
        .user-info ul {
            display: none;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }

        /* Style for sub-menu items */
        .user-info ul li {
            display: inline;
            
        }

        /* Show sub-menu when hovering over .user-info */
        .user-info:hover ul {
            display: block;
        }
    </style>
</head>
<body>
    <div class="navigation">
        <ul class="nav-item">
            <li><a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index_after.php">HOTEL</a></li>
            <li><a href="booking_service.php">Hội Họp Sự Kiện</a></li>
            <li><a href="booking_bars.php">Club & Bars</a></li>
            <li><a href="Resturant.php">Nhà Hàng </a></li>
            <li class="user-info">
                <a>Xem Thông Tin Đặt Dịch Vụ Tài Khoản:  <?php echo $username_booking; ?></a>
                <ul>
                    <li><a href="user_booking_service.php?username=<?php echo $username_booking?>">Tổ Chức Sự Kiện</a></li>
                    <li><a href="info_bars.php?username=<?php echo $username_booking?>">Club & Bars</a></li>
                    <li><a href="info_restaurant.php?username=<?php echo $username_booking?>">Nhà Hàng</a></li>
                </ul>
            </li>
        </ul>
    </div>
</body>
</html>


