<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">HOTEL</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active me-2" aria-current="page" href="index.php">Trang chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link booking me-2" href="Interace_Room.php">Đặt phòng</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
        <li class="nav-item">
          <a class="nav-link About us me-2" href="service.php" tabindex="-1" aria-disabled="true">Đặt Dịch Vụ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link About us me-2" href="history_booking.php" tabindex="-1" aria-disabled="true">Lịch sử đặt phòng</a>
        </li>
      </ul>

      <?php
            session_start();
            if(isset($_SESSION['username'])) {
                require('Account_User.php'); 
            }
            else {
                require('Login_SignUp.php'); 
            }
      ?>

    </div>
  </div>
</nav>