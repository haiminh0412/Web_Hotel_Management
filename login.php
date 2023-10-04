<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form in HTML and CSS</title>
    <link rel="stylesheet" href="styles_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="userName" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remeber-forgot">
                <label for="checkbox">
                    <input type="checkbox" checked> Remember me
                </label>
                <a href="forgot_password.php"><br>Forgot password</a>
            </div>
            <button type="submit" class="btn" name="login">
                Login
            </button>

            <div class="register-link">
                <p>Don't have an account?
                    <a href="resigter.php">Register</a>
                </p>
            </div>
        </form>
        <?php
        require('DBHelper.php');

        if (isset($_POST['login'])) {
            $username = $_POST['userName'];
            $password = $_POST['password'];
            $query_login = "Select accountid from Account where UserName = '$username' and Password = '$password'";
            $result = DBHelper::execute($query_login);
            $count = $result->num_rows;
            if ($count > 0) {
                echo "<script> alert('Đăng nhập thành công') </script>";
                session_start();
                $id = $result->fetch_array(MYSQLI_ASSOC)['accountid'];
                // cap nhap dang online
                $query = "update Account set status = 'online' where accountid = '$id'";
                DBHelper::execute($query);
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;

                //lay id khach hang
                $query = "select customer.customerid 
                        from customer
                        inner join account
                        on customer.customerid = account.customerid
                        where account.accountid = '$id'";

                $result = DBHelper::execute($query);
                $customerId = $result->fetch_array(MYSQLI_ASSOC)['customerid'];
                $_SESSION['customerId'] = $customerId;

                header('Location: index.php');
            } else {
                echo "<script> alert('Tên tài khoản hoặc mật khẩu không chính xác') </script>";
            }
        }
        ?>
    </div>
</body>

</html>