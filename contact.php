<?php
include("config/config.php");
session_start();

/* =========================================
   KẾT NỐI DATABASE
========================================= */

$host = "localhost";
$dbname = "tiem_do_chat";
$username = "root";
$password = "1234";

try{

    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

}catch(PDOException $e){

    die(
        "Kết nối database thất bại: "
        . $e->getMessage()
    );

}

/* =========================================
   XỬ LÝ FORM LIÊN HỆ
========================================= */

$thong_bao = "";

if(
    $_SERVER["REQUEST_METHOD"] == "POST"
    && isset($_POST['btn_gui_lien_he'])
){

    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if(
        !empty($full_name)
        && !empty($email)
        && !empty($message)
    ){

        try{

            $sql = "
            INSERT INTO contacts
            (full_name, email, message)
            VALUES (?, ?, ?)
            ";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                $full_name,
                $email,
                $message
            ]);

            $thong_bao = "
            <div class='alert success'>
                Gửi liên hệ thành công!
            </div>
            ";

        }catch(Exception $e){

            $thong_bao = "
            <div class='alert error'>
                Lỗi hệ thống!
            </div>
            ";

        }

    }else{

        $thong_bao = "
        <div class='alert error'>
            Vui lòng nhập đầy đủ thông tin!
        </div>
        ";

    }

}
?>

<!DOCTYPE html>

<html lang="vi">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
    Liên hệ - Tiệm Đồ Chất
</title>

<link
rel="stylesheet"
href="style/contact.css">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- =========================
     HEADER
========================= -->

<header>


<div class="logo">

    <img
    src="image/l.png"
    alt="Logo">

</div>

<nav>

    <ul>

        <li>
            <a href="index.html">
                Trang chủ
            </a>
        </li>

        <li>
            <a href="products.php">
                Sản phẩm
            </a>
        </li>

        <li>
            <a href="collection.php">
                Bộ sưu tập
            </a>
        </li>

        <li>
            <a href="news.php">
                Tin tức
            </a>
        </li>

        <li>
            <a
            href="contact.php"
            class="active">

                Liên hệ

            </a>
        </li>

        <li>
            <a href="cart.php">
                Giỏ hàng
            </a>
        </li>

        <li>
            <a href="register.php">
                Đăng ký
            </a>
        </li>

        <li>
            <a
            href="#"
            onclick="openLogoutPopup()">

                Đăng xuất

            </a>
        </li>

    </ul>

</nav>
```

</header>

<!-- =========================
     CONTACT
========================= -->

<section class="contact">

<div class="contact-container">

    <div class="contact-left">

        <h1>
            LIÊN HỆ VỚI CHÚNG TÔI
        </h1>

        <p class="contact-desc">

            Nếu bạn có câu hỏi hoặc góp ý,
            hãy gửi thông tin cho chúng tôi.

        </p>

        <?= $thong_bao ?>

        <form
        method="POST"
        action="contact.php">

            <input
            type="text"
            name="full_name"
            placeholder="Nhập họ tên"
            required>

            <input
            type="email"
            name="email"
            placeholder="Nhập email"
            required>

            <textarea
            name="message"
            placeholder="Nhập nội dung"
            required></textarea>

            <button
            type="submit"
            name="btn_gui_lien_he">

                Gửi liên hệ

            </button>

        </form>

    </div>

    

</div>

</section>

<!-- =========================
     FOOTER
========================= -->

<footer class="site-footer">


<div class="footer-container">

    <!-- CỘT 1 -->

    <div class="footer-column">

        <h2 class="footer-logo">

            TIỆM
            <span>
                ĐỒ CHẤT
            </span>

        </h2>

        <p class="footer-text">

            Website thời trang dành cho giới trẻ
            với phong cách hiện đại và cá tính.

        </p>

        <div class="footer-social">

            <a href="#">
                <i class="fab fa-facebook-f"></i>
            </a>

            <a href="#">
                <i class="fab fa-instagram"></i>
            </a>

            <a href="#">
                <i class="fab fa-tiktok"></i>
            </a>

            <a href="#">
                <i class="fab fa-youtube"></i>
            </a>

        </div>

    </div>

    <!-- CỘT 2 -->

    <div class="footer-column">

        <h3>
            Liên kết nhanh
        </h3>

        <ul class="footer-links">

            <li>
                <a href="index.html">
                    Trang chủ
                </a>
            </li>

            <li>
                <a href="products.php">
                    Sản phẩm
                </a>
            </li>

            <li>
                <a href="collection.php">
                    Bộ sưu tập
                </a>
            </li>

            <li>
                <a href="news.php">
                    Tin tức
                </a>
            </li>

            <li>
                <a href="contact.php">
                    Liên hệ
                </a>
            </li>

        </ul>

    </div>

    <!-- CỘT 3 -->

    <div class="footer-column">

        <h3>
            Thông tin liên hệ
        </h3>

        <p>
            <i class="fas fa-map-marker-alt"></i>

            Công viên phần mềm Quang Trung,
            Hồ Chí Minh
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

    <!-- CỘT 4 -->

    <div class="footer-column">

        <h3>
            Hỗ trợ khách hàng
        </h3>

        <ul class="footer-links">

            <li>
                <a href="#">
                    Chính sách đổi trả
                </a>
            </li>

            <li>
                <a href="#">
                    Chính sách bảo mật
                </a>
            </li>

            <li>
                <a href="#">
                    Hướng dẫn mua hàng
                </a>
            </li>

            <li>
                <a href="#">
                    Điều khoản dịch vụ
                </a>
            </li>

        </ul>

    </div>

</div>

<!-- GOOGLE MAP -->

<iframe
src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.457885785332!2d106.62667807304837!3d10.852736257785551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529798a06bc69%3A0xc1c961c2fe6bde91!2sIMC!5e0!3m2!1svi!2s!4v1779948410134!5m2!1svi!2s"
width="100%"
height="300"
style="border:0;"
allowfullscreen=""
loading="lazy">
</iframe>

<!-- FOOTER BOTTOM -->

<div class="footer-bottom">

    <p>

        © <?= date('Y') ?>
        Tiệm Đồ Chất

    </p>

</div>
```

</footer>

<!-- =========================
     LOGOUT POPUP
========================= -->

<div
class="logout-popup"
id="logoutPopup">

```
<div class="logout-box">

    <h2>
        Xác nhận đăng xuất
    </h2>

    <p>
        Bạn có chắc chắn muốn đăng xuất?
    </p>

    <div class="logout-actions">

        <button
        class="cancel-btn"
        onclick="closeLogoutPopup()">

            Hủy

        </button>

        <a
        href="logout.php"
        class="confirm-btn">

            Đăng xuất

        </a>

    </div>

</div>
```

</div>

<!-- =========================
     JAVASCRIPT
========================= -->

<script>

function openLogoutPopup(){

    document
    .getElementById("logoutPopup")
    .style.display = "flex";

}

function closeLogoutPopup(){

    document
    .getElementById("logoutPopup")
    .style.display = "none";

}

window.onclick = function(e){

    let popup =
    document.getElementById(
    "logoutPopup"
    );

    if(e.target == popup){

        popup.style.display = "none";

    }

}

</script>

</body>

</html>
