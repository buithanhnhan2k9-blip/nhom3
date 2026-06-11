<?php
session_start();
require_once("config/config.php");

/* =========================
   LẤY ID SẢN PHẨM Từ URL
========================= */
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($product_id <= 0){
    header("Location: products.php");
    exit();
}

/* =========================
   BƯỚC 1: LẤY DỮ LIỆU TỪ DATABASE
========================= */
try{
    $stmt = $conn->prepare("
        SELECT * FROM products 
        WHERE id = :id
    ");
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $detail_product = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    $detail_product = null;
}

/* =========================
   BƯỚC 2: PHÒNG HỜ (FALLBACK LOGIC)
   Nếu Database không tìm thấy ID, quét qua danh sách sản phẩm code cứng
========================= */
if(!$detail_product){
    $custom_details = [
        101 => ["product_name" => "Áo Sơ Mi Nam Đen Dài Tay", "base_price" => 350000, "thumbnail_image" => "image/a (2).webp", "description" => "Áo sơ mi nam dài tay thanh lịch, chất vải lụa nến cao cấp co giãn nhẹ, thấm hút mồ hôi cực tốt phù hợp đi làm, đi tiệc.", "stock_quantity" => 15],
        102 => ["product_name" => "Áo Sơ Mi Nam Họa Tiết Lá Cọ", "base_price" => 295000, "thumbnail_image" => "image/a (3).webp", "description" => "Áo sơ mi cộc tay họa tiết lá cọ trẻ trung, chất vải thô đũi mát mẻ, chuyên dụng cho các chuyến đi biển, du lịch mùa hè năng động.", "stock_quantity" => 20],
        103 => ["product_name" => "Áo Thun Đen Basic Dáng Suông", "base_price" => 190000, "thumbnail_image" => "image/ao thun.jpeg", "description" => "Áo thun đen cổ tròn basic dáng suông rộng thời trang unisex, chất liệu 100% Cotton mềm mịn dày dặn thích hợp mặc hằng ngày.", "stock_quantity" => 45],
        104 => ["product_name" => "Áo Khoác Hoodie Nỉ Basic", "base_price" => 320000, "thumbnail_image" => "image/images (1).jpg", "description" => "Áo khoác hoodie nỉ mỏng nhẹ, phom dáng cơ bản dễ phối cùng nhiều trang phục, giữ nhiệt và che nắng hiệu quả.", "stock_quantity" => 12],
        105 => ["product_name" => "Quần Tây Nữ Ống Suông Công Sở", "base_price" => 280000, "thumbnail_image" => "image/q (2).jpg", "description" => "Quần tây nữ ống suông rộng cạp cao tôn dáng dài miên man, chất liệu vải tuyết mưa bền đẹp đứng phom hoàn hảo.", "stock_quantity" => 8],
        106 => ["product_name" => "Quần Dài Nam Cạp Chun Dây Rút", "base_price" => 250000, "thumbnail_image" => "image/q.jpg", "description" => "Quần kaki dài nam lưng thun phối dây rút tiện ích, phong cách đường phố rộng rãi năng động dễ mặc dễ phối đồ.", "stock_quantity" => 30],
        
        // CHI TIẾT CỦA 2 SẢN PHẨM HOODIE MỚI
        107 => [
            "product_name" => "Áo Khoác Hoodie Xám Goddess Energy", 
            "base_price" => 380000, 
            "thumbnail_image" => "image/k (2).jpg", 
            "description" => "Áo khoác hoodie nỉ màu xám phối họa tiết loang sơn đen cực ngầu cùng dòng chữ 'Goddess Energy' đậm chất bụi bặm đường phố. Sản phẩm sở hữu mũ trùm đầu to rộng, túi bụng trước tiện ích, vải nỉ bông siêu dày dặn ấm áp giữ phom cực đỉnh.", 
            "stock_quantity" => 50
        ],
        108 => [
            "product_name" => "Áo Khoác Hoodie Nỉ Trơn Basic Pink", 
            "base_price" => 350000, 
            "thumbnail_image" => "image/k.jpg", 
            "description" => "Áo khoác hoodie phom rộng oversized trơn màu hồng pastel trẻ trung mix lớp lót mũ màu đen tương phản cá tính. Thiết kế đơn giản hiện đại, chất nỉ ngoại mềm mịn không xù lông, bo tay bo gấu ôm phom gọn gàng.", 
            "stock_quantity" => 35
        ]
    ];

    if(isset($custom_details[$product_id])){
        $detail_product = $custom_details[$product_id];
        $detail_product['id'] = $product_id; // Đảm bảo giữ ID gốc cho giỏ hàng
    }
}

/* =========================
   KHÔNG TÌM THẤY SẢN PHẨM Ở CẢ 2 NƠI
========================= */
if(!$detail_product){
    header("Location: products.php");
    exit();
}

/* =========================
   XỬ LÝ THÊM VÀO GIỎ HÀNG
========================= */
if(isset($_POST['add_to_cart'])){
    $selected_size = $_POST['size'] ?? 'M';

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach($_SESSION['cart'] as &$item){
        if($item['id'] == $detail_product['id'] && ($item['size'] ?? '') == $selected_size){
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    if(!$found){
        $_SESSION['cart'][] = [
            "id" => $detail_product['id'],
            "name" => $detail_product['product_name'],
            "price" => $detail_product['base_price'],
            "image" => $detail_product['thumbnail_image'],
            "size" => $selected_size,
            "quantity" => 1
        ];
    }

    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($detail_product['product_name']) ?> - Tiệm Đồ Chất</title>
    <link rel="stylesheet" href="style/products.css">
    <link rel="stylesheet" href="style/product-detail.css">
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
            <li><a href="products.php" class="active">Sản phẩm</a></li>
            <li><a href="collection.php">Bộ sưu tập</a></li>
            <li><a href="news.php">Tin tức</a></li>
            <li><a href="contact.php">Liên hệ</a></li>
            <li>
                <a href="cart.php">
                    Giỏ hàng
                    <?php
                        $cart_count = 0;
                        if(isset($_SESSION['cart'])){
                            foreach($_SESSION['cart'] as $item){
                                $cart_count += $item['quantity'];
                            }
                        }
                    ?>
                    (<?= $cart_count ?>)
                </a>
            </li>
            <?php if(isset($_SESSION['user_id'])){ ?>
                <li><a href="#" onclick="openLogoutPopup()">Đăng xuất</a></li>
            <?php }else{ ?>
                <li><a href="login.php">Đăng nhập</a></li>
                <li><a href="register.php">Đăng ký</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>

<main class="detail-wrapper">
    <section class="product-detail-section">
        <div class="detail-image-box">
            <img src="<?= htmlspecialchars($detail_product['thumbnail_image']) ?>" alt="<?= htmlspecialchars($detail_product['product_name']) ?>">
        </div>

        <div class="detail-info-box">
            <a href="products.php" class="back-to-products">
                <i class="fas fa-arrow-left"></i> Quay lại sản phẩm
            </a>

            <h1><?= htmlspecialchars($detail_product['product_name']) ?></h1>

            <div class="detail-price">
                <?= number_format($detail_product['base_price'], 0, ',', '.') ?>đ
            </div>

            <div class="detail-status">
                <?php if((isset($detail_product['stock_quantity']) ? $detail_product['stock_quantity'] : 10) > 0){ ?>
                    <span class="in-stock">
                        <i class="fas fa-check-circle"></i> Còn hàng (Còn <?= $detail_product['stock_quantity'] ?? 10 ?> sản phẩm)
                    </span>
                <?php }else{ ?>
                    <span class="out-stock">
                        <i class="fas fa-times-circle"></i> Hết hàng
                    </span>
                <?php } ?>
            </div>

            <div class="detail-desc">
                <h3>Mô tả sản phẩm</h3>
                <p><?= nl2br(htmlspecialchars($detail_product['description'] ?? 'Chưa có mô tả cho sản phẩm này.')) ?></p>
            </div>

            <form method="POST">
                <div class="detail-size">
                    <h3>Chọn size</h3>
                    <div class="size-options">
                        <input type="radio" id="size-s" name="size" value="S">
                        <label for="size-s">S</label>

                        <input type="radio" id="size-m" name="size" value="M" checked>
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
            <p class="footer-text">Website thời trang dành cho giới trẻ với phong cách hiện đại, cá tính và năng động.</p>
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
            <p><i class="fas fa-phone"></i> 0778989336</p>
            <p><i class="fas fa-envelope"></i> buithanhnhan2k9@gmail.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2026 Tiệm Đồ Chất | All Rights Reserved</p>
    </div>
</footer>

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

<script>
function openLogoutPopup(){ document.getElementById("logoutPopup").style.display = "flex"; }
function closeLogoutPopup(){ document.getElementById("logoutPopup").style.display = "none"; }
window.onclick = function(e){
    let popup = document.getElementById("logoutPopup");
    if(e.target == popup){ popup.style.display = "none"; }
}
</script>
</body>
</html>