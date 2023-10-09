<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_booking_bars.css">
    <title>Document</title>
    <style>
        .container {
            text-align: center;
        }

        .item-booking {
            display: inline-block;
            margin-left: 240px;
            vertical-align: top;
            text-align: left; 
            width: 300px; 
        }
    </style>
</head>
<body>
    <?php 
        include 'DBHelper.php';
        include 'inc/navigation.php';
        $query = "Select * from bars_club";
        $result = DBHelper::execute($query);
        
        if ($result != null && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
    <div class="item-booking">
        <div class="booking-image">
            <?php echo '<img src="data:image;base64,' . base64_encode($row['image']) . '" alt="Image" style="width: 310px; height: 180px;">'; ?>
        </div>
        <div class="booking-content">
            <h4>Quán Bars & Club  <?php echo $row['room_name']; ?> </h4>
            <div class="item">
                <i class="fa-solid fa-location-dot"></i>
                <p>Vị Trí:</p>
                <p><?php echo $row['location'] ?></p>
            </div>
            <div class="item">
                <i class="fa-solid fa-warehouse"></i>
                <p>Sức Chứa: </p>
                <p><?php echo $row['capacity']; ?> Chỗ Ngồi</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-box-open"></i>
                <p>Giờ Mở Cửa: </p>
                <p><?php echo $row['date_open'] ?></p>
            </div>
            <div>
                <a href="booking_bars_form.php?room_name=<?php echo $row['room_name']; ?>" class="button-submit">Đặt Phòng</a>
            </div>
        </div>
    </div>
    <?php
            }
        } else {
            // Hiển thị thông báo nếu không có dữ liệu
            echo "Không có dữ liệu để hiển thị.";
        }
    ?>
</body>
</html>

