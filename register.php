<?php
// Thay đổi đường dẫn này nếu file kết nối DB của bạn nằm chỗ khác
include("config/config.php"); 

$message = "";

if (isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if ($password != $confirm_password) {
        $message = "Mật khẩu xác nhận không khớp!";
    } else {
        try {
            // Kiểm tra email trùng lặp
            $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $check->execute([$email]);

            if ($check->rowCount() > 0) {
                $message = "Email đã tồn tại!";
            } else {
                // MÃ HÓA MẬT KHẨU TRƯỚC KHI LƯU
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Thêm tài khoản mới vào DB
                $sql = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $result = $sql->execute([$name, $email, $hashed_password]);

                if ($result) {
                    $message = "Đăng ký thành công! Hãy chuyển sang Đăng nhập.";
                } else {
                    $message = "Đăng ký thất bại!";
                }
            }
        } catch (PDOException $e) {
            $message = "Lỗi database: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="image/l.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <li><a href="index.html">Trang chủ</a></li> 
    <li><a href="products.php">Sản phẩm</a></li>
    <li><a href="collection.php">Bộ sưu tập</a></li>
    <li><a href="news.php">Tin tức</a></li>
    <li><a href="contact.php">Liên hệ</a></li>
    <li><a href="cart.php">Giỏ hàng</a></li>
    <li><a href="register.php">Đăng ký</a></li>
    </nav>
</header>

<section class="register">
    <div class="form-box">
        <h1>ĐĂNG KÝ TÀI KHOẢN</h1>

        <?php if ($message != ""): ?>
            <p class="message" style="color: green; text-align: center; margin-bottom: 15px;">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Nhập họ tên" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" required>
            <input type="email" name="email" placeholder="Nhập email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
            <input type="password" name="password" placeholder="Nhập mật khẩu" required>
            <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
            <button type="submit" name="register">Đăng ký</button>
        </form>

        <div class="login-link">
            <p>Đã có tài khoản?</p>
            <a href="login.php">Đăng nhập ngay</a>
        </div>
    </div>
</section>
<footer class="site-footer">

    <div class="footer-container">

        <!-- Cột 1 -->
        <div class="footer-column">
            <h2 class="footer-logo">
                Tiệm <span>Đồ Chất</span>
            </h2>

            <p class="footer-desc">
                Chuyên cung cấp thời trang nam nữ hiện đại, cá tính và chất lượng cao.
            </p>

            <div class="footer-socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <!-- Cột 2 -->
        <div class="footer-column">
            <h3 class="footer-heading">
                Liên kết nhanh
            </h3>

            <ul class="footer-links">
                <li><a href="index.html">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="collection.php">Bộ sưu tập</a></li>
                <li><a href="news.php">Tin tức</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
            </ul>
        </div>

        <!-- Cột 3 -->
        <div class="footer-column">
            <h3 class="footer-heading">
                Thông tin liên hệ
            </h3>

            <div class="footer-contact">
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    Công viên phần mềm Quang Trung, TP.HCM
                </p>

                <p>
                    <i class="fas fa-phone"></i>
                    0778989336
                </p>

                <p>
                    <i class="fas fa-envelope"></i>
                    buithanhnhan2k9@gmail.com
                </p>
            </div>
        </div>

        <!-- Cột 4 -->
        <div class="footer-column">
            <h3 class="footer-heading">
                Bản đồ
            </h3>

            <div class="footer-map">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.457885785332!2d106.62667807304837!3d10.852736257785551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529798a06bc69%3A0xc1c961c2fe6bde91!2sIMC!5e0!3m2!1svi!2s!4v1779948410134!5m2!1svi!2s"
                    width="100%"
                    height="220"
                    style="border:0;border-radius:15px;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
        </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">

        <div class="footer-bottom-container">

            <p>
                © 2026 Tiệm Đồ Chất | All Rights Reserved
            </p>

            <div class="footer-payments">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-apple-pay"></i>
            </div>

        </div>

    </div>

</footer>

</body>
</html>