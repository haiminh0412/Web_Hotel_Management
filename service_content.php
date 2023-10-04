<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .transparent-button {
            background-color: transparent;
            border: none;
            color: red;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form method="post">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Phòng</th>
                    <th>Sức Chứa</th>
                    <th>Diện Tích</th>
                    <th>Loại Phòng</th>
                    <th>Đặt Dịch Vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'hotel_management');
                $query = "SELECT * FROM service_event_room";
                $res = $conn->query($query);
                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['stt']; ?></td>
                        <td><?php echo $row['room_name']; ?></td>
                        <td><?php echo $row['capacity']; ?></td>
                        <td><?php echo $row['area']; ?></td>
                        <td><?php echo $row['type_room']; ?></td>
                        <td>
                            <button class="transparent-button">Sửa</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</body>
</html>
