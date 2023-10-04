<?php 
  
  $select_all = "Select * from service_event_room where type_room != 'Bars'";
  $res2 = DBHelper::executeResult($select_all);
  if ($res2->num_rows > 0) {
  echo "<table>";
          echo "<tr>
                  <th>Tên Phòng</th>
                  <th>Sức Chứa</th>
                  <th>Diện Tích</th>
                  <th>Loại Phòng</th>
                  <th>Ảnh Phòng</th>
                  <th>Đặt Dịch Vụ</th>
              </tr>";
              while ($row = $res2->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row['room_name'] . "</td>";
                  echo "<td>" . $row['capacity'] . "</td>";
                  echo "<td>" . $row['area'] . "</td>";
                  echo "<td>" . $row['type_room'] . "</td>";
                  echo '<td><img src="data:image;base64,' . base64_encode($row['image']) . '" alt="Image" style="width: 170px; height: 100px;"></td>';
                  $condition = "SELECT * FROM information_booking WHERE room_name = '" . $row['room_name'] . "' AND user_booking = '$username_booking'";
                  $clause = DBHelper::executeResult($condition);
                  if($clause->num_rows > 0){
                    echo '<td><a href="#"  style="color: red;"><i class="fas fa-calendar-alt"></i> Bạn Đã Đặt</a></td>';


                  }
                  else{
                      echo '<td><a href="form_service.php?room_name=' . $row['room_name'] . '" "><i class="fas fa-calendar-alt"></i> Đặt Ngay</a></td>';
                  }
                  echo "</tr>";
              }
          echo "</table>";
            }
?>