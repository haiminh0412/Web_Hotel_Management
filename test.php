<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css"/>
    <title>Document</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .box-information {
        height: 200px;
        width: 600px;
        background-color: wheat;
        border: solid 1px;
        border-radius: 15px;
        box-shadow: 0px 1px 2px rgba(3,18,26,0.20);
        background-color: rgba(255,255,255,1.00);
        position: relative;
        margin-top: 20px;
        margin-left: 500px;
    }
    .box-item {
        display: flex;
        font-size: 14px;
        padding: 5px;
    }
    .line-first-item {
        display: flex;
        align-items: center;
        padding: 5px 20px; /* Thêm khoảng cách xung quanh */
        margin: 5px 0; /* Thêm khoảng cách giữa các line-item */
    }
    .line-second-item {
        display: flex;
        align-items: center;
        padding: 5px 20px; /* Thêm khoảng cách xung quanh */
        border-top: 1px solid #ccc;
        margin: 5px 0; /* Thêm khoảng cách giữa các line-item */
    }
    .line-third-item {
        display: flex;
        align-items: center;
        padding: 5px 20px; /* Thêm khoảng cách xung quanh */
        margin: 5px 0; /* Thêm khoảng cách giữa các line-item */
    }
    .line-four-item {
        display: flex;
        align-items: center;
        padding: 5px 20px; /* Thêm khoảng cách xung quanh */
        margin: 5px 0; /* Thêm khoảng cách giữa các line-item */
    }
    .room-name {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }
    .book-button {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: orange;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<body>
    <div class="box-information">
        <div class="room-name"><p><?php echo $name_presedent ?></p></div>
        <div class="line-first-item">
            <div class="box-item">
            <i class="fa-solid fa-warehouse"></i>
                <p style="padding-left: 5px;">Tầng 2 Khách Sạn</p>
            </div>
            <div class="box-item">
                <i class="fa-solid fa-user-group"></i>
                <p style="padding-left: 5px;">Lượng Khách: <?php echo $capacity_presedent?></p>
            </div>
            <div class="box-item">
            <i class="fa-solid fa-warehouse"></i>
                <p style="padding-left: 5px;">Diện Tích <?php echo $area_presedent?> </p>
            </div>
            <div class="box-item">
                <p style="margin-left: 90px;">Số Phòng Trống: <?php echo $count  ?> </p>
            </div>
        </div>
        <div class="line-second-item">
            <div class="box-item">
                <i class="fa-solid fa-mug-saucer"></i>
                <p style="margin-left: 7px;" >Bao Gồm Bữa Sáng</p>
            </div>
            <div class="box-item" style="margin-left: 10px;">
                <i class="fa-solid fa-circle-info"></i>
                <p style="margin-left: 7px;">Không Hoàn Tiền</p>
            </div>
        </div>
        <div class="line-third-item">
            <div class="box-item" >
                <i class="fa-solid fa-wifi"></i>
                <p style="margin-left: 7px;" >Wifi Miễn Phí</p>
            </div>
            <div class="box-item" style="margin-left: 30px;">
                <i class="fa-solid fa-calendar-days" style="margin-left: 23px;"></i>
                <p style="margin-left: 10px;">Không Đổi Lịch</p>
            </div>
        </div>
        <div class="line-four-item">
            <div class="box-item">
                <i class="fa-solid fa-ban-smoking"></i>
                <p style="margin-left: 7px;">Không Hút Thuốc</p>
            </div>
            <div class="box-item" style="margin-left: 30px;">
            <i class="fa-solid fa-bowl-food"></i>
                <p style="margin-left: 8px;">Không Mang Đồ Ăn </p>
            </div>
        </div>
        <button class="book-button">Đặt Ngay</button>
    </div>
</body>
</html>
