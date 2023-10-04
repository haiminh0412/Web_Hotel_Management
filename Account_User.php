<li class="nav-item dropdown" style="margin-left: 570px;">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Tài Khoản: <?php
            $username = $_SESSION['username'];
            echo $username;
        ?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="history_booking.php">1.Phòng đã đặt</a></li>
        <li><a class="dropdown-item" href="favorite_view.php">2 Phòng yêu thích</a></li>
        <li><a class="dropdown-item" href="form_rating.php">3.Đánh giá</a></li>
        <li><a class="dropdown-item" href="logout.php">4.Đăng Xuất</a></li>
    </ul>
</li>