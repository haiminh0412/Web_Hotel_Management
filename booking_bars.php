<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_booking_bars.css">
    <title>Document</title>
</head>
<body>
    <?php 
       include 'inc/navigation.php';
    ?>
    <div class="item-booking" style="margin-left: 220px;">
        <div class="booking-image">
            <img src="https://grandhanoicentre.muongthanh.com/images/foods/2022/06/lcl_2715_1.jpg" alt="Restaurant Image">
        </div>
        <div class="booking-content">
            <h4>Quán Bars Rone Romace</h4>
            <div class="item">
                <i class="fa-solid fa-location-dot"></i>
                <p>Vị Trí:</p>
                <p>Tầng 3 Khách Sạn</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-warehouse"></i>
                <p>Sức Chứa: </p>
                <p>100 Chỗ Ngồi</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-box-open"></i>
                <p>Giờ Mở Cửa: </p>
                <p>6h30 : 10h30</p>
            </div>
            <div>
            <a href="booking_bars_form.php?room_name=RoneRomace" class="button-submit">Đặt Phòng</a>
            </div>
        </div>
    </div>
    <div class="item-booking">
        <div class="booking-image">
            <img src="https://blog.dktcdn.net/files/share-quan-bar-pub.jpg" alt="Restaurant Image">
        </div>
        <div class="booking-content">
            <h4>Quán Bars Chill & Private </h4>
            <div class="item">
                <i class="fa-solid fa-location-dot"></i>
                <p>Vị Trí:</p>
                <p>Tầng 4 Khách Sạn</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-warehouse"></i>
                <p>Sức Chứa: </p>
                <p>80 Chỗ Ngồi</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-box-open"></i>
                <p>Giờ Mở Cửa: </p>
                <p>12h00 : 5h00</p>
            </div>
            <div>
            <a href="booking_bars_form.php?room_name=BarsOverNight" class="button-submit">Đặt Phòng</a>
            </div>
        </div>
    </div>
    <div class="item-booking">
        <div class="booking-image">
            <img src="https://grandhanoicentre.muongthanh.com/images/service/2022/06/dsc00808.jpg" alt="Restaurant Image">
        </div>
        <div class="booking-content">
            <h4>Club Chill BarsNightTeen</h4>
            <div class="item">
                <i class="fa-solid fa-location-dot"></i>
                <p>Vị Trí:</p>
                <p>Tầng 3 Khách Sạn</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-warehouse"></i>
                <p>Sức Chứa: </p>
                <p>80 Chỗ Ngồi</p>
            </div>
            <div class="item">
                <i class="fa-solid fa-box-open"></i>
                <p>Giờ Mở Cửa: </p>
                <p>7h00 : 10h00</p>
            </div>
            <div>
            <a href="booking_bars_form.php?room_name=BarsNightTeen" class="button-submit">Đặt Phòng</a>
            </div>
        </div>
    </div>
</body>
</html>
