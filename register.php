<?php

$conn = mysqli_connect("localhost","root","1234","tiem_do_chat");

if(!$conn){

    die("Kết nối thất bại: " . mysqli_connect_error());

}

$message = "";

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string(
        $conn,
        $_POST['name']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = mysqli_real_escape_string(
        $conn,
        $_POST['password']
    );

    $confirm_password = mysqli_real_escape_string(
        $conn,
        $_POST['confirm_password']
    );

    // KIỂM TRA MẬT KHẨU

    if($password != $confirm_password){

        $message = "Mật khẩu xác nhận không khớp!";

    }else{

        // KIỂM TRA EMAIL

        $check = "SELECT * FROM users
                  WHERE email='$email'";

        $result = mysqli_query($conn,$check);

        if(mysqli_num_rows($result) > 0){

            $message = "Email đã tồn tại!";

        }else{

            // THÊM TÀI KHOẢN

            $sql = "INSERT INTO users(name,email,password)
                    VALUES('$name','$email','$password')";

            if(mysqli_query($conn,$sql)){

                $message = "Đăng ký thành công!";

            }else{

                $message = "Đăng ký thất bại!";

            }

        }

    }

}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Đăng ký</title>

    <link rel="stylesheet"
          href="style/register.css">

</head>

<body>

<header>

    <div class="logo">

        <img src="image/l.png"
             alt="Logo">

    </div>

    <nav>

        <ul>

            <li><a href="index.php">Trang chủ</a></li>

            <li><a href="products.php">Sản phẩm</a></li>

            <li><a href="collection.php">Bộ sưu tập</a></li>

            <li><a href="news.php">Tin tức</a></li>

            <li><a href="contact.php">Liên hệ</a></li>

            <li><a href="cart.php">Giỏ hàng</a></li>

            <li><a href="register.php">Đăng ký</a></li>

        </ul>

    </nav>

</header>

<section class="register">

    <div class="form-box">

        <h1>ĐĂNG KÝ TÀI KHOẢN</h1>

        <?php if($message != ""){ ?>

            <p class="message">

                <?php echo $message; ?>

            </p>

        <?php } ?>

        <form method="POST">

            <input type="text"
                   name="name"
                   placeholder="Nhập họ tên"

                   value="<?php
                   echo isset($_POST['name'])
                   ? htmlspecialchars($_POST['name'])
                   : '';
                   ?>"

                   required>

            <input type="email"
                   name="email"
                   placeholder="Nhập email"

                   value="<?php
                   echo isset($_POST['email'])
                   ? htmlspecialchars($_POST['email'])
                   : '';
                   ?>"

                   required>

            <input type="password"
                   name="password"
                   placeholder="Nhập mật khẩu"
                   required>

            <input type="password"
                   name="confirm_password"
                   placeholder="Xác nhận mật khẩu"
                   required>

            <button type="submit"
                    name="register">

                Đăng ký

            </button>

        </form>

        <div class="login-link">

            <p>Đã có tài khoản?</p>

            <a href="login.php">

                Đăng nhập ngay

            </a>

        </div>

    </div>

</section>


</body>

</html>