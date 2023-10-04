<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:ital,wght@0,400;0,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_booking_event.css">
    <title>Tìm kiếm phòng</title>
</head>
<?php
            include 'inc/navigation.php';
         ?>
<style>
    body {
    font-family: Arial, sans-serif;
}

/* Thiết lập phong cách cho container chính */
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

/* Phong cách cho biểu mẫu tìm kiếm */
.search-form {
    background-color: #f2f2f2;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
}

.search-form h4 {
    font-size: 18px;
    margin-bottom: 10px;
}

.search-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.search-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.search-submit {
    background-color: orange;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
}

.info-text {
    font-size: 14px;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    border: solid 1px;
    text-align: center;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center; 
}

table th {
    background-color: #f2f2f2;
    text-align: center; 
}
a{
    text-decoration: none;
}

</style>

<body>
    <div class="container">
    <form method="post" class="search-form" >

        <h4>Tìm Kiếm</h4>
        <div class="search-container">
        <select class="search-input" name="searchOption" id="searchOption">
    <option value="Delux">Delux</option>
    <option value="Fabulous">Fabulous</option>
    <option value="FullHouse">FullHouse</option>
    <option value="Retrist">Retrist</option>
</select>

    <input class="search-input" type="date" name="checkInDate" min="<?php echo date('Y-m-d') ?>" placeholder="Ngày đến">
    <input class="search-input" type="number" name="capacity" min="0" placeholder="Sức chứa">
    <input class="search-input" type="number" name="area" min="0" placeholder="Diện tích">
    <input class="search-submit" type="submit" name="btnSearch" value="Tìm">
</div>

    </form>
        <div><p>Welcome Back <?php echo $username_booking ?> !</p></div>
        <div><p>Danh sách các phòng cho thuê tổ chức sự kiện</p></div>

        <?php
          require_once('DBHelper.php');
          if (isset($_POST['searchOption'])) {
            $text = $_POST['searchOption'];
        }
        if (isset($_POST['capacity'])) {
            $getcapacity = $_POST['capacity'];
        }
        if (isset($_POST['area'])) {
            $getarea = $_POST['area'];
        }
        if (isset($_POST['checkInDate'])) {
            $checkInDate = $_POST['checkInDate'];
        }
        if (isset($_POST['btnSearch'])) {

            
           
            $search = "SELECT * FROM service_event_room WHERE (capacity = '$getcapacity' OR area = '$getarea')";
            if (!empty($text)) {
                $search .= " OR room_name LIKE '%$text%'";
            }
            $search .= " AND type_room != 'Bars'";
            $checkInDate = date('Y-m-d',strtotime($checkInDate)); // chuyển dữ liệu từ mm/dd/yyyy thành yy/mm/dd để so sánh 
            $search_info = "Select * from information_booking where '$checkInDate' NOT BETWEEN date_booking AND  date_checkout  AND room_name = '$text' ";
            $res2 = DBHelper::executeResult($search_info);
                $res = DBHelper::executeResult($search);
                
                if ($res->num_rows > 0 && empty($_POST['checkInDate']) ) {
                    echo "<table>";
                    echo "<tr>
                            <th>Tên Phòng</th>
                            <th>Sức Chứa</th>
                            <th>Diện Tích</th>
                            <th>Loại Phòng</th>
                            <th>Ảnh Phòng</th>
                            <th>Đặt Dịch Vụ</th>
                        </tr>";
                        while ($row = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['room_name'] . "</td>";
                            echo "<td>" . $row['capacity'] . "</td>";
                            echo "<td>" . $row['area'] . "</td>";
                            echo "<td>" . $row['type_room'] . "</td>";
                            echo '<td><img src="data:image;base64,' . base64_encode($row['image']) . '" alt="Image" style="width: 170px; height: 100px;"></td>';
                            $condition = "SELECT * FROM information_booking WHERE room_name = '" . $row['room_name'] . "' AND user_booking = '$username_booking'";
                            $clause = DBHelper::executeResult($condition);
                            if($clause->num_rows > 0){
                                echo '<td><a href="#" style="color: red;"><i class="fas fa-calendar-alt"></i> Bạn Đã Đặt</a></td>';

                              
                            }
                            else{
                                echo '<td><a href="form_service.php?room_name=' . $row['room_name'] . '" "><i class="fas fa-calendar-alt"></i> Đặt Ngay</a></td>';
                            }
                            echo "</tr>";
                        }
                    echo "</table>";
                }
                else if ($res->num_rows > 0 && $res2->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>
                            <th>Tên Phòng</th>
                            <th>Sức Chứa</th>
                            <th>Diện Tích</th>
                            <th>Loại Phòng</th>
                            <th>Ảnh Phòng</th>
                            <th>Đặt Dịch Vụ</th>
                        </tr>";
                        while ($row = $res->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['room_name'] . "</td>";
                            echo "<td>" . $row['capacity'] . "</td>";
                            echo "<td>" . $row['area'] . "</td>";
                            echo "<td>" . $row['type_room'] . "</td>";
                            echo '<td><img src="data:image;base64,' . base64_encode($row['image']) . '" alt="Image" style="width: 170px; height: 100px;"></td>';
                            $condition = "SELECT * FROM information_booking WHERE room_name = '" . $row['room_name'] . "' AND user_booking = '$username_booking'";
                            $clause = DBHelper::executeResult($condition);
                            if($clause->num_rows > 0){
                                echo '<td><a href="#" style="color: red;"><i class="fas fa-calendar-alt"></i> Bạn Đã Đặt</a></td>';

                              
                            }
                            else{
                                echo '<td><a href="form_service.php?room_name=' . $row['room_name'] . '" "><i class="fas fa-calendar-alt"></i> Đặt Ngay</a></td>';
                            }
                            echo "</tr>";
                        }
                    echo "</table>";
                } 
                else {
                    echo "<script>alert('Phòng Đã Hết Vào Ngày Đó Hoặc Đã Có Người Đặt')</script>";
                require 'display_booking.php' ; 
                    }
                
            
        } else {
            require 'display_booking.php';
        }
        ?>
    

    </div>
    <script>
</script>

</body>
</html>
