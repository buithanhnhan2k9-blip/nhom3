<?php
// 1. Nhúng file kết nối database vào đầu trang
include('db.php');

// Khởi tạo phiên làm việc (session) nếu cần dùng để lưu trạng thái đăng nhập
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Kiểm tra nếu người dùng nhấn nút Đăng nhập (gửi dữ liệu qua POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailInput = trim($_POST['email'] ?? '');
    $passInput = trim($_POST['password'] ?? '');

    if (!empty($emailInput) && !empty($passInput)) {
        try {
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $emailInput, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // Nếu bạn đang lưu mật khẩu dạng văn bản thô (chưa mã hóa):
                if ($passInput === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    
                    echo "<script>alert('Đăng nhập thành công!'); window.location.href='index.php';</script>";
                    exit;
                } else {
                    $error_msg = "Mật khẩu không chính xác!";
                }
            } else {
                $error_msg = "Tài khoản email không tồn tại!";
            }
        } catch (PDOException $e) {
            $error_msg = "Lỗi xử lý dữ liệu: " . $e->getMessage();
        }
    } else {
        $error_msg = "Vui lòng điền đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Tiệm Đồ Chất</title>
    
    <link rel="stylesheet" href="style/login.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="image/l.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <ul>

            <li><a href="index.php">Trang chủ</a></li>

            <li><a href="products.php">Sản phẩm</a></li>

            <li><a href="collection.php">Bộ sưu tập</a></li>

            <li><a href="news.php">Tin tức</a></li>

            <li><a href="contact.php">Liên hệ</a></li>

            <li><a href="cart.php">Giỏ hàng</a></li>

            <li><a href="register.php">Đăng ký</a></li>

        </ul>
        </ul>
    </nav>
</header>

<div class="login-wrapper">
    <div class="login-box">
        <h2>Đăng Nhập</h2>
        
        <?php if (isset($error_msg)): ?>
            <div class="error"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="input-group">
                <label>Email đăng nhập:</label>
                <input type="email" name="email" required placeholder="Nhập email của bạn...">
            </div>
            <div class="input-group">
                <label>Mật khẩu:</label>
                <input type="password" name="password" required placeholder="Nhập mật khẩu...">
            </div>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</div>


</body>
</html>