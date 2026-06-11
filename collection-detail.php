<?php
session_start();
include("config/config.php");

/* =========================
   GỘP DỮ LIỆU TỪ 3 BỘ SƯU TẬP
========================= */
$collection_data = [
    // ÁO
    ["id"=>101, "name"=>"Áo Oversize Đen","price"=>350000,"image"=>"image/ao thun.jpeg", "desc"=>"Áo form rộng thoải mái, chất cotton 100% thoáng mát, phong cách đường phố cá tính."],
    ["id"=>102, "name"=>"Áo Local Brand Trắng","price"=>420000,"image"=>"image/ao brand.jpg", "desc"=>"Sản phẩm thiết kế độc quyền từ Local Brand, form áo ôm vừa vặn, họa tiết in sắc nét bền màu."],
    ["id"=>103, "name"=>"Áo Graphic Tee","price"=>390000,"image"=>"image/ao Graphic Tee.jpg", "desc"=>"Áo thun Graphic nổi bật với họa tiết sáng tạo, dễ dàng phối hợp với nhiều kiểu trang phục."],
    ["id"=>104, "name"=>"Áo Hoodie Đen","price"=>650000,"image"=>"image/ao thun denjpg", "desc"=>"Hoodie nỉ bông dày dặn, giữ ấm tốt, mũ rộng có dây rút, thiết kế basic dễ mặc."],
    ["id"=>105, "name"=>"Áo Polo Nam","price"=>299000,"image"=>"image/polo.jpg", "desc"=>"Áo Polo cổ bẻ thanh lịch, chất cá sấu co giãn, phù hợp đi học, đi làm hay dạo phố."],
    ["id"=>106, "name"=>"Áo Sơ Mi Local","price"=>490000,"image"=>"image/ao so mi.webp", "desc"=>"Sơ mi tay ngắn phom rộng trẻ trung, chất liệu lụa mềm chống nhăn hiệu quả."],
    
    // ÁO KHOÁC
    ["id"=>201, "name"=>"Áo Khoác Bomber Đen","price"=>550000,"image"=>"image/Áo Khoác Bomber Đen.jpg", "desc"=>"Bomber form chuẩn, lớp gió chống nước nhẹ, viền bo thun khỏe khoắn năng động."],
    ["id"=>202, "name"=>"Áo Khoác Dù 2 Lớp","price"=>450000,"image"=>"image/V.jpg", "desc"=>"Áo dù 2 lớp siêu nhẹ, cản gió cản bụi cực tốt, thiết kế thể thao hiện đại."],
    ["id"=>203, "name"=>"Áo Khoác Varsity Nhám","price"=>690000,"image"=>"image/Áo Khoác Varsity Nhám.jpg", "desc"=>"Áo Varsity phối màu bắt mắt, chất da lộn nhám cao cấp mang đậm chất thời trang học đường."],
    ["id"=>204, "name"=>"Áo Khoác Denim Bụi","price"=>750000,"image"=>"image/Áo Khoác Denim Bụi.jpg", "desc"=>"Khoác Denim dày dặn, chi tiết wash rách bụi bặm, item kinh điển không bao giờ lỗi mốt."],
    ["id"=>205, "name"=>"Áo Cardigan Len Nam","price"=>399000,"image"=>"image/Áo Cardigan Len Nam.webp", "desc"=>"Cardigan len dệt kim mềm mại, độ dày vừa phải, tạo phong cách lãng tử phong trần."],
    ["id"=>206, "name"=>"Áo Khoác Da Biker","price"=>890000,"image"=>"image/Áo Khoác Da Biker.jpg", "desc"=>"Áo da Biker cực ngầu, chất da PU cao cấp không nổ, tôn dáng chuẩn nam tính."],

    // QUẦN
    ["id"=>301, "name"=>"Quần Jean Ống Rộng","price"=>450000,"image"=>"image/Quần Jean Ống Rộng.jpg", "desc"=>"Jean ống rộng xu hướng mới, hack dáng cực đỉnh, dễ dàng mix match cùng áo thun, hoodie."],
    ["id"=>302, "name"=>"Quần Kaki Túi Hộp","price"=>520000,"image"=>"image/Quần Kaki Túi Hộp.jpg", "desc"=>"Quần Kaki Cargo túi hộp tiện dụng, chất kaki thun co giãn nhẹ, phong cách Techwear/Streetwear."],
    ["id"=>303, "name"=>"Quần Short Thể Thao","price"=>250000,"image"=>"image/Quần Short Thể Thao.jpg", "desc"=>"Short nam thể thao chất vải dù gió siêu mát, lưng chun thoải mái vận động."],
    ["id"=>304, "name"=>"Quần Tây Nam Basic","price"=>400000,"image"=>"image/Quần Tây Nam Basic.png", "desc"=>"Quần tây ống đứng lịch lãm, dáng vừa vặn, không nhăn nhàu, thích hợp môi trường công sở."],
    ["id"=>305, "name"=>"Quần Jogger Nỉ Đen","price"=>350000,"image"=>"image/Quần Jogger Nỉ Đen.jpg", "desc"=>"Jogger nỉ thể thao bo gấu, lưng thun rút dây, đem lại sự êm ái tối đa khi mặc nhà hoặc đi gym."],
    ["id"=>306, "name"=>"Quần Jean Rách Gối","price"=>490000,"image"=>"image/Quần Jean Rách Gối.jpg", "desc"=>"Quần Jean form Slimfit tôn chân, chi tiết rách gối tinh tế tạo điểm nhấn mạnh mẽ."]
];

/* =========================
   TÌM KIẾM SẢN PHẨM THEO ID
========================= */
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$detail_product = null;

foreach($collection_data as $item){
    if($item['id'] == $product_id){
        $detail_product = $item;
        break;
    }
}

if(!$detail_product){
    header("Location: collection.php");
    exit();
}

/* =========================
   XỬ LÝ THÊM VÀO GIỎ HÀNG
========================= */
if(isset($_POST['add_to_cart'])){
    $selected_size = isset($_POST['size']) ? $_POST['size'] : 'M';
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        "name" => $detail_product['name'],
        "price" => $detail_product['price'],
        "image" => $detail_product['image'],
        "size" => $selected_size
    ];

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $detail_product['name'] ?> - Bộ Sưu Tập</title>
    <link rel="stylesheet" href="style/bosuutapao.css"> 
    <link rel="stylesheet" href="style/product-detail.css">
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
            <li><a href="collection.php" class="active">Bộ sưu tập</a></li>
            <li><a href="news.php">Tin tức</a></li>
            <li><a href="contact.php">Liên hệ</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
            <li><a href="register.php">Đăng kí</a></li>
            <li><a href="#" onclick="openLogoutPopup()">Đăng xuất</a></li>
        </ul>
    </nav>
</header>

<main class="detail-wrapper">
    <section class="product-detail-section">
        <div class="detail-image-box">
            <img src="<?= $detail_product['image'] ?>" alt="<?= $detail_product['name'] ?>">
        </div>
        
        <div class="detail-info-box">
            <a href="javascript:history.back()" class="back-to-products">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
            <h1><?= $detail_product['name'] ?></h1>
            <p class="detail-price"><?= number_format($detail_product['price'], 0, ',', '.') ?>đ</p>
            
            <div class="detail-desc">
                <h3>Mô tả sản phẩm:</h3>
                <p><?= $detail_product['desc'] ?></p>
            </div>
            
            <form method="POST">
                <div class="detail-size">
                    <h3>Chọn Size:</h3>
                    <div class="size-options">
                        <input type="radio" id="size-s" name="size" value="S" required>
                        <label for="size-s">S</label>

                        <input type="radio" id="size-m" name="size" value="M">
                        <label for="size-m">M</label>

                        <input type="radio" id="size-l" name="size" value="L">
                        <label for="size-l">L</label>

                        <input type="radio" id="size-xl" name="size" value="XL">
                        <label for="size-xl">XL</label>

                        <input type="radio" id="size-xxl" name="size" value="XXL">
                        <label for="size-xxl">XXL</label>
                    </div>
                </div>

                <button type="submit" name="add_to_cart" class="btn-add-cart">
                    <i class="fas fa-shopping-cart"></i> THÊM VÀO GIỎ HÀNG
                </button>
            </form>
        </div>
    </section>
</main>

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
                <li><a href="register.php">Đăng kí</a></li>
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
function openLogoutPopup(){ document.getElementById("logoutPopup").style.display = "flex"; }
function closeLogoutPopup(){ document.getElementById("logoutPopup").style.display = "none"; }
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