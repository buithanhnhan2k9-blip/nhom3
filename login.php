<?php
session_start();

include "config/config.php";

$error = "";

// Nếu đã đăng nhập
if (isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($email === "" || $password === "") {

        $error = "Vui lòng nhập đầy đủ thông tin!";

    } else {

        try {

            // PDO
            $stmt = $conn->prepare("
                SELECT id, name, email, password, role 
                FROM users 
                WHERE email = ?
            ");

            $stmt->execute([$email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra tài khoản
            if ($user && password_verify($password, $user["password"])) {

                session_regenerate_id(true);

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["name"]    = $user["name"];
                $_SESSION["email"]   = $user["email"];
                $_SESSION["role"]    = $user["role"];

                header("Location: index.html");
                exit;

            } else {

                $error = "Sai email hoặc mật khẩu!";
            }

        } catch (PDOException $e) {

            $error = "Lỗi hệ thống: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>

    <link rel="stylesheet" href="style/login.css">
</head>
<body>

<header>

    <div class="logo">
        <img src="image/l.png" alt="Logo">
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

<div class="login-wrapper">

    <div class="login-box">

        <h2>Đăng Nhập</h2>

        <?php if (!empty($error)): ?>

            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <div class="input-group">
                <label>Email</label>

                <input 
                    type="email"
                    name="email"
                    required
                    placeholder="Nhập email..."
                    value="<?= htmlspecialchars($email ?? '') ?>"
                >
            </div>

            <div class="input-group">
                <label>Mật khẩu</label>

                <input 
                    type="password"
                    name="password"
                    required
                    placeholder="Nhập mật khẩu..."
                >
            </div>

            <button type="submit">
                Đăng nhập
            </button>

        </form>

    </div>

</div>

</body>
</html>