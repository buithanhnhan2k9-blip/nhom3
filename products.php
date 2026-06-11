<?php
session_start();
require_once("config/config.php");

/* =========================
   LẤY DANH SÁCH SẢN PHẨM TỪ DATABASE
========================= */
try{
    $stmt = $conn->prepare("SELECT * FROM products ORDER BY id DESC");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    $products = [];
}

/* =========================
   DANH SÁCH SẢN PHẨM BẰNG CODE (ĐÃ THÊM 2 SẢN PHẨM HOODIE MỚI)
========================= */
$custom_products = [
    [
        "id" => 101,
        "product_name" => "Áo Sơ Mi Nam Đen Dài Tay",
        "base_price" => 350000,
        "thumbnail_image" => "image/a (2).webp",
        "category" => "ao"
    ],
    [
        "id" => 102,
        "product_name" => "Áo Sơ Mi Nam Họa Tiết Lá Cọ",
        "base_price" => 295000,
        "thumbnail_image" => "image/a (3).webp",
        "category" => "ao"
    ],
    [
        "id" => 103,
        "product_name" => "Áo Thun Đen Basic Dáng Suông",
        "base_price" => 190000,
        "thumbnail_image" => "image/ao thun.jpeg",
        "category" => "ao"
    ],
    [
        "id" => 104,
        "product_name" => "Áo Khoác Hoodie Nỉ Basic",
        "base_price" => 320000,
        "thumbnail_image" => "image/images (1).jpg",
        "category" => "ao-khoac"
    ],
    [
        "id" => 105,
        "product_name" => "Quần Tây Nữ Ống Suông Công Sở",
        "base_price" => 280000,
        "thumbnail_image" => "image/q (2).jpg",
        "category" => "quan"
    ],
    [
        "id" => 106,
        "product_name" => "Quần Dài Nam Cạp Chun Dây Rút",
        "base_price" => 250000,
        "thumbnail_image" => "image/q.jpg",
        "category" => "quan"
    ],
    // --- BẮT ĐẦU THÊM 2 SẢN PHẨM MỚI TỪ ẢNH ---
    [
        "id" => 107,
        "product_name" => "Áo Khoác Hoodie Xám Goddess Energy",
        "base_price" => 380000,
        "thumbnail_image" => "image/k (2).jpg",
        "category" => "ao-khoac"
    ],
    [
        "id" => 108,
        "product_name" => "Áo Khoác Hoodie Nỉ Trơn Basic Pink",
        "base_price" => 350000,
        "thumbnail_image" => "image/k.jpg",
        "category" => "ao-khoac"
    ]
    // --- KẾT THÚC THÊM ---
];

// Gộp các sản phẩm viết bằng code vào danh sách chung từ database
$products = array_merge($products, $custom_products);

/* =========================
   XỬ LÝ LỌC CATEGORY & TÌM KIẾM
========================= */
$current_category = isset($_GET['category']) ? $_GET['category'] : 'tat-ca';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$filtered_products = [];

foreach($products as $product){
    $product_category = isset($product['category']) ? $product['category'] : '';

    $match_category = ($current_category == 'tat-ca' || $product_category == $current_category);
    $match_search = ($search == '' || stripos($product['product_name'], $search) !== false);

    if($match_category && $match_search){
        $filtered_products[] = $product;
    }
}

/* =========================
   XỬ LÝ THÊM VÀO GIỎ HÀNG NHANH TỪ TRANG DANH SÁCH
========================= */
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_GET['add'])){
    $id = intval($_GET['add']);
    foreach($products as $product){
        if($product['id'] == $id){
            $found = false;
            foreach($_SESSION['cart'] as &$item){
                if($item['id'] == $id && $item['size'] == 'M'){
                    $item['quantity'] += 1;
                    $found = true;
                    break;
                }
            }
            if(!$found){
                $_SESSION['cart'][] = [
                    "id" => $product['id'],
                    "name" => $product['product_name'],
                    "price" => $product['base_price'],
                    "image" => $product['thumbnail_image'],
                    "size" => "M",
                    "quantity" => 1
                ];
            }
            break;
        }
    }
    header("Location: products.php?category=" . $current_category);
    exit();
}

$cart_count = 0;
foreach($_SESSION['cart'] as $item){
    $cart_count += $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm - Tiệm Đồ Chất</title>
    <link class="content" rel="stylesheet" href="style/products.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="index.php"><img src="image/l.png" alt="Logo"></a>
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
                    <i class="fas fa-shopping-cart"></i> Giỏ hàng (<?= $cart_count ?>)
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

<section class="products">
    <h1>DANH SÁCH SẢN PHẨM</h1>
    <div class="category-menu">
        <a href="?category=tat-ca" class="<?= $current_category == 'tat-ca' ? 'active' : '' ?>">Tất cả</a>
        <a href="?category=ao" class="<?= $current_category == 'ao' ? 'active' : '' ?>">Áo</a>
        <a href="?category=quan" class="<?= $current_category == 'quan' ? 'active' : '' ?>">Quần</a>
        <a href="?category=ao-khoac" class="<?= $current_category == 'ao-khoac' ? 'active' : '' ?>">Áo khoác</a>
    </div>

    <div class="container">
        <?php if(count($filtered_products) > 0){ ?>
            <?php foreach($filtered_products as $product){ ?>
                <div class="card">
                    <a href="product-detail.php?id=<?= $product['id'] ?>">
                        <img src="<?= htmlspecialchars($product['thumbnail_image']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                    </a>
                    <div class="card-content">
                        <h3><a href="product-detail.php?id=<?= $product['id'] ?>"><?= htmlspecialchars($product['product_name']) ?></a></h3>
                        <p class="price"><?= number_format($product['base_price'], 0, ',', '.') ?>đ</p>
                        <a href="?add=<?= $product['id'] ?>&category=<?= $current_category ?>"> 
                            <button style="cursor:pointer;"> Thêm vào giỏ </button> 
                        </a>
                    </div>
                </div>
            <?php } ?>
        <?php }else{ ?>
            <div class="empty-product">
                <i class="fas fa-box-open"></i>
                <p>Không tìm thấy sản phẩm</p>
            </div>
        <?php } ?>
    </div>
</section>

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
            <p><i class="fas fa-map-marker-alt"></i> Hồ Chí Minh, Việt Nam</p>
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
        <p>Bạn có chắc chắn muốn đăng xuất?</p>
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