<?php
session_start();

/* =========================
   DANH SÁCH SẢN PHẨM
========================= */

$products = [

    [
        "id" => 1,
        "name" => "Áo Sơ Mi Đen Dài Tay",
        "price" => 350000,
        "image" => "image/a (2).webp",
        "category" => "ao"
    ],

    [
        "id" => 2,
        "name" => "Áo Sơ Mi Họa Tiết Lá",
        "price" => 295000,
        "image" => "image/a (3).webp",
        "category" => "ao"
    ],

    [
        "id" => 3,
        "name" => "Áo Polo Đỏ In Hình",
        "price" => 280000,
        "image" => "image/a.jpg",
        "category" => "ao"
    ],

    [
        "id" => 4,
        "name" => "Áo Thun Basic Đen",
        "price" => 190000,
        "image" => "image/a.webp",
        "category" => "ao"
    ],

    [
        "id" => 5,
        "name" => "Quần Tây Ống Rộng",
        "price" => 420000,
        "image" => "image/q (2).jpg",
        "category" => "quan"
    ],

    [
        "id" => 6,
        "name" => "Quần Jean Routine",
        "price" => 490000,
        "image" => "image/q.webp",
        "category" => "quan"
    ],

    [
        "id" => 7,
        "name" => "Áo Hoodie Xám",
        "price" => 480000,
        "image" => "image/k (2).jpg",
        "category" => "ao-khoac"
    ],

    [
        "id" => 8,
        "name" => "Áo Hoodie Oversize",
        "price" => 450000,
        "image" => "image/k.jpg",
        "category" => "ao-khoac"
    ],

    [
        "id" => 9,
        "name" => "Mũ Lưỡi Trai",
        "price" => 150000,
        "image" => "image/t (2).webp",
        "category" => "phu-kien"
    ],

    [
        "id" => 10,
        "name" => "Kính Mát Unisex",
        "price" => 180000,
        "image" => "image/t (3).webp",
        "category" => "phu-kien"
    ]

];

/* =========================
   CATEGORY
========================= */

$current_category =
isset($_GET['category'])
? $_GET['category']
: 'tat-ca';

/* =========================
   ADD TO CART
========================= */

if(isset($_GET['add'])){

    $id = $_GET['add'];

    foreach($products as $product){

        if($product['id'] == $id){

            $_SESSION['cart'][] = $product;

            break;
        }
    }

    header(
        "Location: products.php?category="
        . $current_category
    );

    exit();
}

/* =========================
   FILTER PRODUCTS
========================= */

$filtered_products = [];

if($current_category == 'tat-ca'){

    $filtered_products = $products;

}else{

    foreach($products as $product){

        if($product['category']
        == $current_category){

            $filtered_products[] = $product;
        }
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
    Sản phẩm - Tiệm Đồ Chất
</title>

<link rel="stylesheet"
href="style/products.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- =========================
     HEADER
========================= -->

<header>

    <div class="logo">

        <img src="image/l.png">

    </div>

    <nav>

        <ul>

            <li>
                <a href="index.php">
                    Trang chủ
                </a>
            </li>

            <li>
                <a href="products.php"
                class="active">
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

            <li>
                <a href="cart.php">
                    Giỏ hàng
                </a>
            </li>
            <li><a href="register.php">Đăng ký</a></li>

        </ul>

    </nav>

</header>

<!-- =========================
     PRODUCTS
========================= -->

<section class="products">

    <h1>
        DANH SÁCH SẢN PHẨM
    </h1>

    <!-- CATEGORY -->

    <div class="category-menu">

        <a href="?category=tat-ca"
        class="<?=
        $current_category == 'tat-ca'
        ? 'active'
        : ''
        ?>">
            Tất cả
        </a>

        <a href="?category=ao"
        class="<?=
        $current_category == 'ao'
        ? 'active'
        : ''
        ?>">
            Áo
        </a>

        <a href="?category=quan"
        class="<?=
        $current_category == 'quan'
        ? 'active'
        : ''
        ?>">
            Quần
        </a>

        <a href="?category=ao-khoac"
        class="<?=
        $current_category == 'ao-khoac'
        ? 'active'
        : ''
        ?>">
            Áo khoác
        </a>

        <a href="?category=phu-kien"
        class="<?=
        $current_category == 'phu-kien'
        ? 'active'
        : ''
        ?>">
            Phụ kiện
        </a>

    </div>

    <!-- PRODUCTS -->

    <div class="container">

        <?php
        foreach($filtered_products
        as $product){
        ?>

        <div class="card">

            <img
            src="<?=
            $product['image']
            ?>">

            <div class="card-content">

                <h3>

                    <?=
                    $product['name']
                    ?>

                </h3>

                <p>

                    <?=
                    number_format(
                    $product['price']
                    )
                    ?>đ

                </p>

                <a href="
                ?add=<?=
                $product['id']
                ?>&category=<?=
                $current_category
                ?>">

                    <button>

                        Thêm vào giỏ

                    </button>

                </a>

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

        <!-- CỘT 1 -->

        <div>

            <h2 class="footer-logo">

                TIỆM
                <span>
                    ĐỒ CHẤT
                </span>

            </h2>

            <p class="footer-desc">

                Website thời trang hiện đại
                dành cho giới trẻ cá tính.

            </p>

            <div class="footer-socials">

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

        <div>

            <h3 class="footer-heading">

                Liên kết

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
                    <a href="contact.php">
                        Liên hệ
                    </a>
                </li>

            </ul>

        </div>

        <!-- CỘT 3 -->

        <div class="footer-contact">

            <h3 class="footer-heading">

                Liên hệ

            </h3>

            <p>

                <i class="fas fa-map-marker-alt"></i>

                Công viên phần mềm Quang Trung, Trung Mỹ Tây, Hồ Chí Minh 70000, Việt Nam

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
    
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.457885785332!2d106.62667807304837!3d10.852736257785551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529798a06bc69%3A0xc1c961c2fe6bde91!2sIMC!5e0!3m2!1svi!2s!4v1779948410134!5m2!1svi!2s" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <div class="footer-bottom-container">
            

            <p>

                © 2026 Tiệm Đồ Chất

            </p>

            <div class="footer-payments">

                <i class="fab fa-cc-visa"></i>

                <i class="fab fa-cc-mastercard"></i>

                <i class="fab fa-paypal"></i>

            </div>

        </div>

    </div>

</footer>

</body>

</html>