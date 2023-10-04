<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="styles_login.css">
</head>
<body>
    <div class="wrapper">
        <form action="forgot_password.php" method="POST">
            <h1>Quên Mật Khẩu</h1>
            <div class="input-box">
            <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-box">
            <input type="text" placeholder="Code Forgot" name="code" required>
            </div>
            <button type="submit" class="btn" name="submit">Lấy Lại Mật Khẩu</button>
        </form>
    </div>
    <?php 
    $conn = new mysqli('localhost','root','','hotel_management');
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    if(isset($_POST['code'])){
        $code_forgot = $_POST['code'];
    }
    if(isset($_POST['submit'])){
        $query = "SELECT * FROM Account WHERE code_forgot = '$code_forgot' AND UserName = '$username'";
        $res = $conn->query($query);
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                    echo $row['Password'];
            }
        }
        else{
            echo "Không tìm thấy thông tin người dùng với mã code_forgot và tên người dùng cung cấp.";
        }
    }
?>
</body>
</html>
