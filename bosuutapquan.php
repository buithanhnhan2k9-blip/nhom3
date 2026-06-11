<?php
session_start();
include("config/config.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart'])) { $_SESSION['cart'] = []; }
    $product_item = [
        "name" => $_POST['product_name'],
        "price" => $_POST['product_price'],
        "image" => $_POST['product_image']
    ];
    $_SESSION['cart'][] = $product_item;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$pants = [
    ["id"=>301, "name"=>"Quần Jean Ống Rộng","price"=>450000,"image"=>"image/Quần Jean Ống Rộng.jpg","tag"=>"NEW"],
    ["id"=>302, "name"=>"Quần Kaki Túi Hộp","price"=>520000,"image"=>"image/Quần Kaki Túi Hộp.jpg","tag"=>"HOT"],
    ["id"=>303, "name"=>"Quần Short Thể Thao","price"=>250000,"image"=>"image/Quần Short Thể Thao.jpg","tag"=>"TREND"],
    ["id"=>304, "name"=>"Quần Tây Nam Basic","price"=>400000,"image"=>"image/Quần Tây Nam Basic.png","tag"=>"BEST"],
    ["id"=>305, "name"=>"Quần Jogger Nỉ Đen","price"=>350000,"image"=>"image/Quần Jogger Nỉ Đen.jpg","tag"=>"SALE"],
    ["id"=>306, "name"=>"Quần Jean Rách Gối","price"=>490000,"image"=>"image/Quần Jean Rách Gối.jpg","tag"=>"LIMITED"]
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ Sưu Tập Quần</title>
    <link rel="stylesheet" href="style/bosuutapquan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            <li><a href="#" onclick="openLogoutPopup()">Đăng xuất</a></li>
        </ul>
    </nav>
</header>

<section class="products">
    <h1>BỘ SƯU TẬP QUẦN</h1>
    <div class="container">
        <?php foreach($pants as $p): ?>
        <div class="card">
            <span class="card-tag"><?= $p['tag'] ?></span>
            
            <a href="collection-detail.php?id=<?= $p['id'] ?>">
                <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>">
            </a>
            
            <div class="card-content">
                <h3>
                    <a href="collection-detail.php?id=<?= $p['id'] ?>" style="text-decoration: none; color: inherit;">
                        <?= $p['name'] ?>
                    </a>
                </h3>
                <p><?= number_format($p['price'], 0, ',', '.') ?>đ</p>
                
                <form method="POST" action="">
                    <input type="hidden" name="product_name" value="<?= $p['name'] ?>">
                    <input type="hidden" name="product_price" value="<?= $p['price'] ?>">
                    <input type="hidden" name="product_image" value="<?= $p['image'] ?>">
                    <button type="submit" name="add_to_cart" style="cursor: pointer;">THÊM VÀO GIỎ</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h2 class="footer-logo">TIỆM <span>ĐỒ CHẤT</span></h2>
            <p class="footer-text">
                Website thời trang dành cho giới trẻ với phong cách hiện đại, cá tính và năng động.
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
                 <li><a href="cart.php">Giỏ hàng</a></li>
                 <li><a href="register.php">Đăng ký</a></li>
                 <li><a href="#" onclick="openLogoutPopup()">Đăng xuất</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Thông tin liên hệ</h3>
            <p><i class="fas fa-map-marker-alt"></i> Công viên phần mềm Quang Trung, Trung Mỹ Tây, Hồ Chí Minh 70000, Việt Nam</p>
            <p><i class="fas fa-phone"></i> 0778989336</p>
            <p><i class="fas fa-envelope"></i> buithanhnhan2k9@gmail.com</p>
        </div>

        <div class="footer-column">
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.457885785332!2d106.62667807304837!3d10.852736257785551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529798a06bc69%3A0xc1c961c2fe6bde91!2sIMC!5e0!3m2!1svi!2s!4v1779948410134!5m2!1svi!2s" width="100%" height="160" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="footer-support-block" style="margin-top: 25px;">
                <h3>Hỗ trợ khách hàng</h3>
                <ul class="footer-links">
                    <li><a href="#">Chính sách đổi trả</a></li>
                    <li><a href="#">Chính sách bảo mật</a></li>
                    <li><a href="#">Hướng dẫn mua hàng</a></li>
                    <li><a href="#">Điều khoản dịch vụ</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© <?= date('Y'); ?> Tiệm Đồ Chất | All Rights Reserved</p>
    </div>
</footer>

<script>
function openLogoutPopup(){
    document.getElementById("logoutPopup").style.display = "flex";
}
function closeLogoutPopup(){
    document.getElementById("logoutPopup").style.display = "none";
}
window.onclick = function(e){
    let popup = document.getElementById("logoutPopup");
    if(e.target == popup){
        popup.style.display = "none";
    }
}
</script>

<div class="logout-popup" id="logoutPopup">
    <div class="logout-box">
        <h2>Xác nhận đăng xuất</h2>
        <p>Bạn có chắc chắn muốn đăng xuất tài khoản?</p>
        <div class="logout-actions">
            <button class="cancel-btn" onclick="closeLogoutPopup()">Hủy</button>
            <a href="logout.php" class="confirm-btn">Đăng xuất</a>
        </div>
    </div>
</div>

</body>
</html>