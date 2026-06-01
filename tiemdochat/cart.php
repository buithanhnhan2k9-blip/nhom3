<?php
session_start();

// --- ĐOẠN CODE XỬ LÝ XÓA SẢN PHẨM ---
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]); // Xóa sản phẩm khỏi session
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reset lại chỉ số mảng cho liên tục
    }
    header('Location: cart.php'); // Tải lại trang để cập nhật giỏ hàng và tổng tiền
    exit();
}
// ------------------------------------

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$total = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>

    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>

   <div class="logo">

        <img src="image/l.png"
             alt="Logo">


        </div>

    <nav>
        <ul>
             <li><a href="index.php">Trang chủ</a></li>
            <li><a href="products.php">Sản phẩm</a></li>
            <li><a href="collection.php">Bộ sưu tập</a></li>
            <li><a href="news.php">Tin tức</a></li>
            <li><a href="contact.php">Liên hệ</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
             <li><a href="register.php">Đăng ký</a></li>

        </ul>
    </nav>

</header>

<section class="cart">

    <h1>GIỎ HÀNG CỦA BẠN</h1>

    <?php if(count($cart) > 0){ ?>

    <table>

        <tr>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hành động</th> </tr>

        <?php 
        // Thay đổi vòng lặp để lấy thêm biến $key (vị trí của sản phẩm trong giỏ)
        foreach($cart as $key => $item){

            $total += $item['price'];

        ?>

        <tr>

            <td>
                <img src="<?php echo $item['image']; ?>">
            </td>

            <td>
                <?php echo $item['name']; ?>
            </td>

            <td>
                <?php echo number_format($item['price']); ?>đ
            </td>

            <td>
                <a href="cart.php?action=delete&id=<?php echo $key; ?>" 
                   class="btn-delete" 
                   onclick="return confirm('Bạn có chắc chắn muốn bỏ sản phẩm này khỏi giỏ hàng không?');">
                    Xóa
                </a>
            </td>

        </tr>

        <?php } ?>

    </table>

    <div class="total">

        <h2>Tổng tiền:
            <?php echo number_format($total); ?>đ
        </h2>

    </div>

    <div class="payment">

        <h2>PHƯƠNG THỨC THANH TOÁN</h2>

        <form>

            <label>

                <input type="radio" name="payment">

                Thanh toán khi nhận hàng (COD)

            </label>

            <label>

                <input type="radio" name="payment">

                Chuyển khoản ngân hàng

            </label>

            <label>

                <input type="radio" name="payment">

                Ví điện tử Momo

            </label>

            <button type="submit">

                Xác nhận thanh toán

            </button>

        </form>

    </div>

    <?php } else { ?>

        <div class="empty">

            <h2>Giỏ hàng đang trống</h2>

            <a href="products.php">

                <button>Mua sắm ngay</button>

            </a>

        </div>

    <?php } ?>

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
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="products.php">Sản phẩm</a></li>
                <li><a href="collection.php">Bộ sưu tập</a></li>
                <li><a href="news.php">Tin tức</a></li>
                <li><a href="contact.php">Liên hệ</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>Thông tin liên hệ</h3>
            <p><i class="fas fa-map-marker-alt"></i> Công viên phần mềm Quang Trung, Trung Mỹ Tây, Hồ Chí Minh 70000, Việt Nam</p>
            <p><i class="fas fa-phone"></i> 0778989336</p>
            <p><i class="fas fa-envelope"></i> buithanhnhan2k9@gmail.com</p>
        </div>
        <div class="footer-column">
            <h3>Hỗ trợ khách hàng</h3>
            <ul class="footer-links">
                <li><a href="#">Chính sách đổi trả</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Hướng dẫn mua hàng</a></li>
                <li><a href="#">Điều khoản dịch vụ</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-map" style="text-align: center; margin-top: 20px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.457885785332!2d106.62667807304837!3d10.852736257785551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529798a06bc69%3A0xc1c961c2fe6bde91!2sIMC!5e0!3m2!1svi!2s!4v1779948410134!5m2!1svi!2s" width="400" height="200" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="footer-bottom">
        <p>© 2026 Tiệm Đồ Chất | All Rights Reserved</p>
    </div>
</footer>

</body>
</html>