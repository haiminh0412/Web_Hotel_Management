<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
    <?php require('inc/links.php') ?>
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require('DBHelper.php');

$ngayden = new DateTime();

// Lấy ngày hôm sau
$ngaydi = new DateTime();
$ngaydi->modify('+1 day');

// Định dạng ngày thành chuỗi
$ngayden = $ngayden->format('Y-m-d');
$ngaydi = $ngaydi->format('Y-m-d');

$conditionGuests = 'room.Quantity >= 1';
$conditionRangePrice = 'room.PricePerNight >= 0 and room.PricePerNight <= 100000000';
$conditionRoomType = "roomtype.TypeName like '%%'";
$conditionRoom = 'room.RoomId != -1';
if (isset($_POST['search'])) {
    $room_type = isset($_POST['rdo-room-type']) ?  $_POST['rdo-room-type'] : '';
    $guests = isset($_POST['guests']) ? $_POST['guests'] : 1;
    $minPrice = isset($_POST['min-price']) ? $_POST['min-price'] : 0;
    $maxPrice = isset($_POST['max-price']) ? $_POST['max-price'] : 100000000;
    $conditionRoomType = $room_type === "All" ? "roomtype.TypeName like '%%'" : "roomtype.TypeName = '$room_type'";
    $conditionGuests = "room.Quantity >= $guests";
    $conditionRangePrice = "room.PricePerNight >= $minPrice and room.PricePerNight <= $maxPrice";
    $checkIn = $_POST['check-in'];
    // echo 'Ngay checkin ' . $checkIn . ' </br> ';

    $_SESSION['check-in'] = $checkIn;
    $checkOut = $_POST['check-out'];
    $_SESSION['check-out'] = $checkOut;
}

if (isset($_SESSION['check-in'])) {
    $ngayden = $_SESSION['check-in'];
}

if (isset($_SESSION['check-out'])) {
    $ngaydi = $_SESSION['check-out'];
}

?>

<body class="bg-light">

    <?php
    require('inc/header.php');
    // session_start();
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">DANH SÁCH PHÒNG</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">Tìm kiếm</h4>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <form action="Interace_Room.php" method="post">
                            <!-- Check-in and Check-out -->
                            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px">Thời gian đặt phòng</h5>
                                    <lable class="form-label">Check-in</lable>
                                    <input type="date" class="form-control shadow-none" id="check-in" oninput="validDate()" name="check-in" value="<?php echo $ngayden ?>" require="true">
                                    <lable class="form-label">Check-out</lable>
                                    <input type="date" class="form-control shadow-none" id="check-out" name="check-out" value="<?php echo $ngaydi ?>" require="true">
                                </div>

                                <!-- Facitilites -->

                                <!-- <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px">Tiện nghi</h5>
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f1">
                                        <lable class="form-check-label" for="f1">Wifi</lable>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f2">
                                        <lable class="form-check-label" for="f2">Tivi</lable>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f3">
                                        <lable class="form-check-label" for="f3">Điều hòa</lable>
                                    </div>
                                </div> -->

                                <!-- RoomType -->
                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px">Tiện nghi</h5>
                                    <input type="radio" class="shadow-none me-1 form-group radio-group" id="f1" value="All" name="rdo-room-type" checked="true">
                                    <label name="rdo-room-type" class="form-check-label" for="f1">All</label>
                                    <?php
                                        $truyvan_loaiphong = "select * from roomtype";
                                        $res = DBHelper::execute($truyvan_loaiphong);
                                        
                                        while($res != null && $ds = $res->fetch_array(MYSQLI_ASSOC)) {
                                            ?>
                                            <div class="mb-2">
                                                <input type="radio" class="shadow-none me-1 form-group radio-group" id="f1" value="<?php echo $ds['TypeName'] ?>" name="rdo-room-type">
                                                <label name="rdo-room-type" class="form-check-label" for="f1"><?php echo $ds['TypeName'] ?></label>
                                            </div>
                                            <?php
                                        }
                                    
                                    ?>
                                </div>

                                <!-- Guests -->

                                <div class="border bg-light p-3 rounded mb-3">
                                    <h5 class="mb-3" style="font-size: 18px">Số lượng người ở</h5>
                                    <div class="me-2">
                                        <!-- <label class="form-label">Số lượng người</label> -->
                                        <input type="number" class="form-control shadow-none" name="guests" id="guests" value="1">
                                    </div>
                                </div>

                                <!-- Room is booked -->
                                <!-- <div class="border bg-light p-3 rounded mb-3">
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f1">
                                        <lable class="form-check-label" for="f1" name="booked">Phòng đă đặt</lable>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f2">
                                        <lable class="form-check-label" for="f2" name="not-booked">Phòng chưa đặt</lable>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f1">
                                        <lable class="form-check-label" for="f1" name="empty-room">Phòng trống</lable>
                                    </div>
                                    <div class="mb-2">
                                        <input type="checkbox" class="form-check-input shadow-none me-1" id="f2">
                                        <lable class="form-check-label" for="f2" name="all">Tất cả</lable>
                                    </div>
                                </div> -->

                                <!-- Price Range Slider -->
                                <div class="wrapper">
                                    <header>
                                        <h5>Giá tiền</h5>
                                    </header>
                                    <div class="price-input">
                                        <div class="field">
                                            <span>Min</span>
                                            <input type="number" id="min-price" name="min-price" class="input-min" value="500000">
                                        </div>
                                        <div class="separator">-</div>
                                        <div class="field">
                                            <span>Max</span>
                                            <input type="number" id="max-price" name="max-price" class="input-max" value="10000000">
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="100000000" value="500000" step="200000">
                                        <input type="range" class="range-max" min="0" max="100000000" value="100000000" step="200000">
                                    </div>
                                </div>

                                <script>
                                    // Thanh gia tien
                                    const rangeInput = document.querySelectorAll(".range-input input"),
                                        priceInput = document.querySelectorAll(".price-input input"),
                                        range = document.querySelector(".slider .progress");
                                    let priceGap = 1000;

                                    priceInput.forEach(input => {
                                        input.addEventListener("input", e => {
                                            let minPrice = parseInt(priceInput[0].value),
                                                maxPrice = parseInt(priceInput[1].value);

                                            if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                                                if (e.target.className === "input-min") {
                                                    rangeInput[0].value = minPrice;
                                                    range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                                                } else {
                                                    rangeInput[1].value = maxPrice;
                                                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                                                }
                                            }
                                        });
                                    });

                                    rangeInput.forEach(input => {
                                        input.addEventListener("input", e => {
                                            let minVal = parseInt(rangeInput[0].value),
                                                maxVal = parseInt(rangeInput[1].value);

                                            if ((maxVal - minVal) < priceGap) {
                                                if (e.target.className === "range-min") {
                                                    rangeInput[0].value = maxVal - priceGap
                                                } else {
                                                    rangeInput[1].value = minVal + priceGap;
                                                }
                                            } else {
                                                priceInput[0].value = minVal;
                                                priceInput[1].value = maxVal;
                                                range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                                                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                                            }
                                        });
                                    });

                                    // if (window.history.replaceState) {
                                    //     window.history.replaceState(null, null, window.location.href);
                                    // }

                                    // Chuan hoa ngay check-in va check-out
                                    window.onload = function() {
                                        var today = new Date().toISOString().split('T')[0];
                                        var nextDay = new Date();
                                        nextDay.setDate(nextDay.getDate() + 1);
                                        document.getElementsByName("check-in")[0].setAttribute('min', today);
                                        document.getElementsByName("check-out")[0].setAttribute('min', nextDay.toISOString().split('T')[0]);
                                    }

                                    function validDate() {
                                        // 22542

                                        var checkIn = document.getElementById('check-in').valueAsDate;
                                        var checkOut = document.getElementById('check-out').valueAsDate;

                                        if (checkIn && checkOut) {
                                            // Kiểm tra nếu ngày "check-in" lớn hơn ngày "check-out"
                                            if (checkIn >= checkOut) {
                                                // Đặt giá trị "check-out" là ngày sau ngày "check-in"
                                                var nextDay = new Date(checkIn);
                                                nextDay.setDate(nextDay.getDate() + 1);
                                                document.getElementById('check-out').value = nextDay.toISOString().split('T')[0];
                                            }

                                            // Cập nhật thuộc tính 'min' của "check-out" để vô hiệu hóa tất cả các ngày trước "check-in"
                                            var minDate = new Date(checkIn);
                                            minDate.setDate(minDate.getDate() + 1);
                                            document.getElementsByName("check-out")[0].setAttribute('min', minDate.toISOString().split('T')[0]);
                                        }
                                    }

                                    function confirmResult() {
                                        var a = confirm("Vui Lòng Đăng Nhập Để Đặt Phòng");
                                        if (a === true) {
                                            window.location.href = "login.php";
                                        }
                                    }
                                </script>

                                <button type="submit" class="btn btn-sm text-white custom-bg shadow-none mb-2" name="search" id="search">Tìm Kiếm</button>
                        </form>
                    </div>
            </div>
            </nav>
        </div>

        <!-- Hien thi danh sach phong -->
        <div class="col-lg-9 col-md-12 px-4">
            <?php
            // Lấy ngày hiện tại
            $checkIn = new DateTime();
            $checkIn = $checkIn->format('Y-m-d');

            // Lấy ngày hôm sau
            $checkOut = new DateTime();
            $checkOut->modify('+1 day');
            $checkOut = $checkOut->format('Y-m-d');
            // Định dạng ngày thành chuỗi

            if (isset($_POST['search'])) {
                $checkIn = $_POST['check-in'];
                $_SESSION['check-in'] = $checkIn;
                $checkOut = $_POST['check-out'];
                $_SESSION['check-out'] = $checkOut;
            }

            $customerId = isset($_SESSION['customerId']) ? $_SESSION['customerId'] : '-1';

            $truyvan = "select * from booking
            inner join room
            on booking.RoomId = room.RoomId and CustomerId != $customerId and CheckInDate > Date(now()) and ((CheckInDate <= '$checkIn' and CheckOutDate >= '$checkOut') or (CheckInDate >= '$checkIn' and CheckInDate <= '$checkOut') 
            or (CheckOutDate >= '$checkIn' and CheckOutDate <= '$checkOut'));";

            $ketqua = DBHelper::execute($truyvan);

            $listRoom = array();
            while ($hang = $ketqua->fetch_array(MYSQLI_ASSOC)) {
                array_push($listRoom, $hang['RoomId']);
            }

          
            if (count($listRoom) > 0) {
                $conditionRoom = '';
                for ($i = 0; $i < count($listRoom); $i++) {
                    $conditionRoom = $conditionRoom . 'room.RoomId!=' . $listRoom[$i];
                    if ($i != count($listRoom) - 1) $conditionRoom = $conditionRoom . ' or ';
                }
            }

            $condition = $conditionGuests . " and " . $conditionRangePrice . " and " . $conditionRoom . " and " . $conditionRoomType;
            $query = "select * from room inner join roomtype on room.RoomTypeId = roomtype.RoomTypeId and $condition";
            $result = DBHelper::execute($query);

            if ($result != null) {
                while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                    // tim loai phong
                    $query = "select * from roomtype where RoomTypeId = {$row['RoomTypeId']}";
                    $typeRoom = DBHelper::execute($query)->fetch_array(MYSQLI_ASSOC)['TypeName'];
                    $description = DBHelper::execute($query)->fetch_array(MYSQLI_ASSOC)['Description'];
            ?>
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5">
                                <?php echo '<img src="data:image;base64,' . base64_encode($row['Image']) . '" alt="Image" style="width: 300px; height: 300px;">'; ?>
                            </div>

                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <h5 class="mb-3"> Phòng: <?php echo $row['RoomName'] ?> </h5>
                                <h5 class="mb-3"> Loại phòng: <?php echo $typeRoom ?> </h5>
                                <div class="features mb-3">
                                    <h6 class="mb-1">Phòng gồm có:</h6>
                                    <?php
                                    $my_queries = "select * from room_facilities where RoomId = {$row['RoomId']}";
                                    $thuc_hien = DBHelper::execute($my_queries);
                                    while ($my_rows = $thuc_hien->fetch_array(MYSQLI_ASSOC)) {
                                        $facilities = DBHelper::execute("select * from facilities where id = $my_rows[FacilitiesId]")->fetch_array(MYSQLI_ASSOC)['name'];

                                    ?>
                                        <span class="badge rounded-pill bg-light text-dark text-wrap">
                                            <?php echo $facilities ?>
                                        </span>
                                    <?php
                                    }

                                    ?>
                                    <!-- <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        2 giường
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        1 phòng tắm
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        ban công
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        3 ghế sofa
                                    </span> -->
                                </div>

                                <!-- <div class="facilities mb-3">
                                    <h6 class="mb-1">Vật dụng:</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Wifi
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Tivi
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Điều hòa
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        Máy sưởi
                                    </span>
                                </div> -->


                                <div class="facilities mb-3">
                                    <h6 class="mb-1">Diện tích phòng: <?php echo $row['Area'] ?>/m²</h6>
                                </div>

                                <div class="facilities mb-3">
                                    <h6 class="mb-1">Số người ở: <?php echo $row['Quantity'] ?></h6>
                                </div>

                                <div class="facilities mb-3">
                                    <h6 class="mb-1">Mô tả: <?php echo $description ?></h6>
                                </div>
                            </div>

                            <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-align-center">
                                <h6 class="mb-4"> <?php echo number_format($row['PricePerNight'], 0, '.', ',') . 'VNĐ/Một đêm' ?></h6>
                                <?php
                                if (isset($_SESSION['id']) && isset($_SESSION['customerId'])) {
                                    $q = "select * from booking where CustomerId = {$_SESSION['customerId']} and RoomId={$row['RoomId']} and CheckOutDate >= now()";
                                    $r = DBHelper::execute($q);

                                    if ($r->num_rows > 0) {
                                ?>
                                        <a href="form_edit_booking.php?id=<?php echo $row['RoomId'] ?>" class="button btn btn-sm text-white custom-bg shadow-none mb-2">Sửa thông tin</a>
                                        <a href="CancelBooking.php?id=<?php echo $row['RoomId'] ?>" class="button btn btn-sm text-white custom-bg shadow-none mb-2" onclick="return confirmDelete();">Hủy đặt phòng</a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="form_booking.php?id=<?php echo $row['RoomId'] ?>" class="button btn btn-sm text-white custom-bg shadow-none mb-2">Đặt phòng ngay</a>
                                    <?php
                                    }
                                    ?>


                                <?php
                                } else {
                                ?>
                                    <a href="login.php" class="button btn btn-sm text-white custom-bg shadow-none mb-2" onclick="confirmResult(); return false">Đặt phòng ngay</a>
                                <?php
                                }
                                ?>
                                <a id="favoriteLink" href="Add_Favorite.php?id=<?php echo $row['RoomId'] ?>" class="button btn btn-sm btn-outline-dark shadow-none">Yêu thích</a>
                                <a id="favoriteLink" href="Delete_Favorite.php?id=<?php echo $row['RoomId'] ?>" class="button btn btn-sm btn-outline-dark shadow-none" onclick="return confirmDelete();">Hủy yêu thích</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>

        <!-- <div class="col-lg-9 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5">
                        <img src="image/IMG_39782.png" class="img-fluid rounded-start" alt="#">
                    </div>

                    <div class="col-md-5 mb-lg-0mb-md-0 mb-3">
                        <h5 class="mb-3">Room Name</h5>
                        <div class = "features mb-3">
                            <h6 class="mb-1">Phòng gồm có:</h6>
                            <span class = "badge rounded-pill bg-light text-dark text-wrap">
                            2 giường
                            </span>
                            <span class = "badge rounded-pill bg-light text-dark text-wrap">
                                1 phòng tắm
                            </span>
                            <span class = "badge rounded-pill bg-light text-dark text-wrap">
                                ban công
                            </span>
                            <span class = "badge rounded-pill bg-light text-dark text-wrap">
                            3 ghế sofa
                            </span>
                            </div>

                            <div class="facilities mb-3">
                                <h6 class="mb-1">Vật dụng:</h6>
                                <span class = "badge rounded-pill bg-light text-dark text-wrap">
                                    Wifi
                                </span>
                                <span class = "badge rounded-pill bg-light text-dark text-wrap">
                                    Tivi
                                </span>
                                <span class = "badge rounded-pill bg-light text-dark text-wrap">
                                    Điều hòa
                                </span>
                                <span class = "badge rounded-pill bg-light text-dark text-wrap">
                                    Máy sưởi
                                </span>
                            </div>
                    </div>

                    <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-align-center">
                        <h6 class="mb-4">2.000.000VND/Một đêm</h6>
                        <a href="#" class="btn btn-sm text-white custom-bg shadow-none mb-2">Đặt phòng ngay</a>
                        <a href="#" class="btn btn-sm btn-outline-dark shadow-none">Thông tin chi tiết</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    </div>

    <?php require('inc/footer.php') ?>

    <script>
        const open_add = document.querySelector('.js-add');
        const overlay = document.querySelector('.js-overlay');
        const close_icon = document.querySelector('.js-close');
        open_add.addEventListener('click', function(e) {
            e.preventDefault();
            content_form.style.display = 'block';
            overlay.style.display = 'block';
        });
        close_icon.addEventListener('click', function() {
            content_form.style.display = 'none';
            overlay.style.display = 'none';
        });

        function hideForm() {
            content_form.style.display = 'none';
            overlay.style.display = 'none';
        }

        function confirmDelete() {
            var result = confirm('Bạn có muốn hủy đặt phòng?');
            if (result === true) {
                header("location: Interace_Room.php");
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>