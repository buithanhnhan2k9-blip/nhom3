<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Bộ sưu tập</title>

    <link rel="stylesheet"
          href="style/collection.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- =========================
     HEADER
========================= -->

<header>

    <div class="logo">

        <img src="image/l.png" alt="Logo">

    </div>

    <nav>

        <ul>

            <li><a href="index.html">Trang chủ</a></li>

            <li><a href="products.php">Sản phẩm</a></li>

            <li><a href="collection.php" class="active">Bộ sưu tập</a></li>

            <li><a href="news.php">Tin tức</a></li>

            <li><a href="contact.php">Liên hệ</a></li>

            <li><a href="cart.php">Giỏ hàng</a></li>

            <li><a href="register.php">Đăng ký</a></li>

            <li>
                <a href="#"
                   onclick="openLogoutPopup()">
                    Đăng xuất
                </a>
            </li>

        </ul>

    </nav>

</header>

<!-- =========================
     COLLECTION
========================= -->

<section class="collection">

    <h1>BỘ SƯU TẬP MỚI</h1>

    <div class="gallery">

        <div class="gallery-card">

            <a href="bosuutapao.php">

                <img src="image/images.jpg">

            </a>

            <div class="gallery-content">

                <h3>Bộ Sưu Tập Áo</h3>

                <p>Phong cách trẻ trung năng động</p>

            </div>

        </div>

        <div class="gallery-card">

            <a href="bosuutapquan.php">

                <img src="image/793-bovis-homme-64.jpg">

            </a>

            <div class="gallery-content">

                <h3>Bộ Sưu Tập Quần</h3>

                <p>Thiết kế hiện đại cá tính</p>

            </div>

        </div>

        <div class="gallery-card">

            <a href="bosuutapaokhoac.php">

                <img src="image/images (1).jpg">

            </a>

            <div class="gallery-content">

                <h3>Bộ Sưu Tập Áo Khoác</h3>

                <p>Streetwear cực chất dành cho bạn</p>

            </div>

        </div>

    </div>

</section>

<!-- =========================
     FOOTER
========================= -->

<footer class="site-footer">

    <div class="footer-container">

        <div class="footer-column">

            <h2 class="footer-logo">

                TIỆM <span>ĐỒ CHẤT</span>

            </h2>

            <p class="footer-text">

                Website thời trang dành cho giới trẻ với phong cách hiện đại,
                cá tính và năng động.

            </p>

            <div class="footer-social">

                <a href="#"><i class="fab fa-facebook-f"></i></a>

                <a href="#"><i class="fab fa-instagram"></i></a>

                <a href="#"><i class="fab fa-tiktok"></i></a>

                <a href="#"><i class="fab fa-youtube"></i></a>

            </div>

        </div>

        <div class="footer-column">

            <h3>Liên kết nhanh</h3>

            <ul class="footer-links">

                <li><a href="index.html">Trang chủ</a></li>

                <li><a href="products.php">Sản phẩm</a></li>

                <li><a href="collection.php">Bộ sưu tập</a></li>

                <li><a href="news.php">Tin tức</a></li>

                <li><a href="contact.php">Liên hệ</a></li>

            </ul>

        </div>

        <div class="footer-column">

            <h3>Thông tin liên hệ</h3>

            <p>
                <i class="fas fa-map-marker-alt"></i>
                Công viên phần mềm Quang Trung
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

        <div class="footer-column">

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.457885785332!2d106.62667807304837!3d10.852736257785551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529798a06bc69%3A0xc1c961c2fe6bde91!2sIMC!5e0!3m2!1svi!2s!4v1779948410134!5m2!1svi!2s"
                    width="100%"
                    height="220"
                    style="border:0;border-radius:12px;"
                    allowfullscreen=""
                    loading="lazy">
            </iframe>

        </div>

    </div>

    <div class="footer-bottom">

        <p>

            © 2026 Tiệm Đồ Chất | All Rights Reserved

        </p>

    </div>

</footer>

<!-- =========================
     LOGOUT POPUP
========================= -->

<div class="logout-popup"
     id="logoutPopup">

    <div class="logout-box">

        <h2>Xác nhận đăng xuất</h2>

        <p>Bạn có chắc chắn muốn đăng xuất tài khoản?</p>

        <div class="logout-actions">

            <button class="cancel-btn"
                    onclick="closeLogoutPopup()">

                Hủy

            </button>

            <a href="logout.php"
               class="confirm-btn">

                Đăng xuất

            </a>

        </div>

    </div>

</div>

<script src="js/collection.js"></script>

</body>

</html>