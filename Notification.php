<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo đặt phòng</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="message-box">
            <h1>Thông báo</h1>
            <p>Rất tiếc! Phòng của bạn đã bị trùng lịch. Vui lòng chọn ngày khác.</p>
            <?php $id = isset($_GET['id']) ? $_GET['id'] : '' ?>
            <a href="form_booking.php?id=<?php echo $id ?>" class="btn">Quay lại</a>
        </div>
    </div>
</body>
</html>