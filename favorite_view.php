<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
     <!-- <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('image/IMG_11892.png') no-repeat;
            background-size: cover;
            background-position: center;
        }

        /* CSS cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            border: 1px solid #ddd;
            background-color: #fff;
            /* Set a white background */
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            /* Add borders to table cells */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            border-bottom: 2px solid #ddd;
        }
    </style>  -->

    <?php require('inc/links.php') ?>
</head>

<body class="bg-light">
    <table name = "table" border = "1" cellpadding = "10" cellspacing = "0.5">
        <tr>
            <th>Room Name</th>
            <th>Image</th>
            <th>Price-Per-Night</th>
            <th>Area</th>
            <th>Quantity</th>
        </tr>

    <?php
    require('inc/header.php');
    require('DBHelper.php');

    // Truy vấn SQL để lấy tất cả thông tin từ bảng
    $query = "SELECT * FROM wishlist where CustomerId = '{$_SESSION['customerId']}'";
    $result = DBHelper::execute($query);

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $truyvan = "select * from room where RoomId = {$row['RoomId']}";
            $ketqua = DBHelper::execute($truyvan);
            while ($hang = $ketqua->fetch_array(MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $hang['RoomName'] . "</td>";

                    if (!empty($hang['Image'])) {
                        echo '<td><img src="data:image;base64,' . base64_encode($hang['Image']) . '" alt="Image" style="width: 100px; height: 100px;"></td>';
                    } else {
                        echo "<td>No Image Available</td>";
                    }

                    echo "<td>" . $hang['PricePerNight'] . "</td>";
                    echo "<td>" . $hang['Area'] . "</td>";
                    echo "<td>" . $hang['Quantity'] . "</td>";
                    echo "</tr>";
            }
        }
    }
    ?>
    </table>
</body>
</html>