```php
<?php
session_start();
include("config/config.php");

/* =========================
   KHỞI TẠO GIỎ HÀNG
========================= */
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

/* =========================
   DANH SÁCH ÁO
========================= */
$shirts = [

    [
        "id"=>101,
        "name"=>"Áo Oversize Đen",
        "price"=>350000,
        "image"=>"image/ao thun.jpeg",
        "tag"=>"NEW",
        "desc"=>"Áo form rộng thoải mái, chất cotton 100% thoáng mát, phong cách đường phố cá tính."
    ],

    [
        "id"=>102,
        "name"=>"Áo Local Brand Trắng",
        "price"=>420000,
        "image"=>"image/ao brand.jpg",
        "tag"=>"HOT",
        "desc"=>"Sản phẩm thiết kế độc quyền từ Local Brand, form áo ôm vừa vặn."
    ],

    [
        "id"=>103,
        "name"=>"Áo Graphic Tee",
        "price"=>390000,
        "image"=>"image/ao Graphic Tee.jpg",
        "tag"=>"TREND",
        "desc"=>"Áo thun Graphic nổi bật với họa tiết sáng tạo."
    ],

    [
        "id"=>104,
        "name"=>"Áo Thun Đen",
        "price"=>650000,
        "image"=>"image/ao thun denjpg",
        "tag"=>"BEST",
        "desc"=>"Hoodie nỉ bông dày dặn, giữ ấm cực tốt."
    ],

    [
        "id"=>105,
        "name"=>"Áo Polo Nam",
        "price"=>299000,
        "image"=>"image/polo.jpg",
        "tag"=>"SALE",
        "desc"=>"Áo Polo cổ bẻ thanh lịch, chất cá sấu co giãn."
    ],

    [
        "id"=>106,
        "name"=>"Áo Sơ Mi Local",
        "price"=>490000,
        "image"=>"image/ao so mi.webp",
        "tag"=>"LIMITED",
        "desc"=>"Sơ mi tay ngắn phom rộng trẻ trung."
    ]
];

/* =========================
   THÊM GIỎ HÀNG
========================= */
if(isset($_GET['add'])){

    $id = intval($_GET['add']);

    foreach($shirts as $shirt){

        if($shirt['id'] == $id){

            $found = false;

            foreach($_SESSION['cart'] as &$item){

                if(
                    $item['id'] == $id
                    &&
                    $item['size'] == 'M'
                ){

                    $item['quantity'] += 1;

                    $found = true;

                    break;
                }
            }

            if(!$found){

                $_SESSION['cart'][] = [

                    "id" => $shirt['id'],

                    "name" => $shirt['name'],

                    "price" => $shirt['price'],

                    "image" => $shirt['image'],

                    "size" => "M",

                    "quantity" => 1
                ];
            }

            break;
        }
    }

    header("Location: bosuutapao.php");
    exit();
}

/* =========================
   ĐẾM GIỎ HÀNG
========================= */
$cart_count = 0;

foreach($_SESSION['cart'] as $item){

    $cart_count += $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Bộ Sưu Tập Áo
    </title>

    <link
        rel="stylesheet"
        href="style/bosuutapao.css"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

</head>

<body>

<!-- =========================
     HEADER
========================= -->

<header>

    <div class="logo">

        <a href="index.php">

            <img src="image/l.png" alt="Logo">

        </a>

    </div>

    <nav>

        <ul>

            <li>
                <a href="index.php">
                    Trang chủ
                </a>
            </li>

            <li>
                <a href="products.php">
                    Sản phẩm
                </a>
            </li>

            <li>
                <a
                    href="collection.php"
                    class="active"
                >
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

            <li>

                <a href="cart.php">

                    <i class="fas fa-shopping-cart"></i>

                    Giỏ hàng
                    

                </a>

            </li>

            <?php if(isset($_SESSION['user_id'])){ ?>

                <li>

                    <a
                        href="#"
                        onclick="openLogoutPopup()"
                    >
                        Đăng xuất
                    </a>

                </li>

            <?php }else{ ?>

                <li>
                    <a href="login.php">
                        Đăng nhập
                    </a>
                </li>

                <li>
                    <a href="register.php">
                        Đăng ký
                    </a>
                </li>

            <?php } ?>

        </ul>

    </nav>

</header>

<!-- =========================
     PRODUCTS
========================= -->

<section class="products">

    <h1>
        BỘ SƯU TẬP ÁO
    </h1>

    <div class="container">

        <?php foreach($shirts as $shirt){ ?>

            <div class="card">

                <span class="card-tag">

                    <?= $shirt['tag'] ?>

                </span>

                <a
                    href="collection-detail.php?id=<?= $shirt['id'] ?>"
                >

                    <img
                        src="<?= $shirt['image'] ?>"
                        alt="<?= $shirt['name'] ?>"
                    >

                </a>

                <div class="card-content">

                    <h3>

                        <?= $shirt['name'] ?>

                    </h3>

                    <p>

                        <?= number_format(
                            $shirt['price'],
                            0,
                            ',',
                            '.'
                        ) ?>đ

                    </p>

                    <div class="card-buttons">

                        <a
                            href="collection-detail.php?id=<?= $shirt['id'] ?>"
                            class="detail-btn"
                        >

                            

                        </a>

                        <a
                            href="?add=<?= $shirt['id'] ?>"
                        >

                            <button
                                class="add-cart-btn"
                            >

                                <i class="fas fa-shopping-cart"></i>

                                Thêm vào giỏ

                            </button>

                        </a>

                    </div>

                </div>

            </div>

        <?php } ?>

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

                Website thời trang dành cho giới trẻ
                với phong cách hiện đại,
                cá tính và năng động.

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

        <div class="footer-column">

            <h3>
                Liên kết nhanh
            </h3>

            <ul class="footer-links">

                <li>
                    <a href="index.php">
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

        <div class="footer-column">

            <h3>
                Thông tin liên hệ
            </h3>

            <p>

                <i class="fas fa-map-marker-alt"></i>

                Hồ Chí Minh, Việt Nam

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

    <div class="footer-bottom">

        <p>

            © <?= date('Y'); ?>
            Tiệm Đồ Chất
            | All Rights Reserved

        </p>

    </div>

</footer>

<!-- =========================
     POPUP LOGOUT
========================= -->

<div
    class="logout-popup"
    id="logoutPopup"
>

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
                onclick="closeLogoutPopup()"
            >
                Hủy
            </button>

            <a
                href="logout.php"
                class="confirm-btn"
            >
                Đăng xuất
            </a>

        </div>

    </div>

</div>

<script>

function openLogoutPopup(){

    document.getElementById(
        "logoutPopup"
    ).style.display = "flex";
}

function closeLogoutPopup(){

    document.getElementById(
        "logoutPopup"
    ).style.display = "none";
}

window.onclick = function(e){

    let popup = document.getElementById(
        "logoutPopup"
    );

    if(e.target == popup){

        popup.style.display = "none";
    }
}

</script>

</body>
</html>
```
