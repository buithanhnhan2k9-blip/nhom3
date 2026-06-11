<?php
session_start();

/* =========================================
   KẾT NỐI DATABASE
========================================= */
$host = "localhost";
$dbname = "tiem_do_chat";
$username = "root";
$password = "1234";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối database thất bại: " . $e->getMessage());
}

/* =========================================
   XÓA SẢN PHẨM KHỎI GIỎ
========================================= */
if (
    isset($_GET['action']) &&
    $_GET['action'] == "delete" &&
    isset($_GET['id'])
) {
    $id = $_GET['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: cart.php");
    exit();
}

/* =========================================
   THANH TOÁN
========================================= */
if (isset($_POST['checkout'])) {
    if (!isset($_POST['payment'])) {
        echo "<script>
                alert('Vui lòng chọn phương thức thanh toán!');
              </script>";
    } else {
        if (!isset($_SESSION['user_id'])) {
            echo "<script>
                    alert('Vui lòng đăng nhập!');
                    window.location.href='login.php';
                  </script>";
            exit();
        }

        $payment_method = $_POST['payment'];
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

        if (count($cart) > 0) {
            $total_amount = 0;
            foreach ($cart as $item) {
                $total_amount += $item['price'];
            }
            $user_id = $_SESSION['user_id'];

            try {
                $conn->beginTransaction();

                /* THÊM ORDER */
                $sql_order = "
                    INSERT INTO orders
                    (
                        user_id,
                        total_amount,
                        shipping_address,
                        payment_method,
                        status
                    )
                    VALUES
                    (?, ?, ?, ?, 'Chờ xác nhận')
                ";
                $stmt_order = $conn->prepare($sql_order);
                $stmt_order->execute([
                    $user_id,
                    $total_amount,
                    'Chưa cập nhật',
                    $payment_method
                ]);

                $order_id = $conn->lastInsertId();

                /* THÊM CHI TIẾT ĐƠN HÀNG */
                $sql_detail = "
                    INSERT INTO order_details
                    (
                        order_id,
                        product_name,
                        price,
                        image
                    )
                    VALUES
                    (?, ?, ?, ?)
                ";
                $stmt_detail = $conn->prepare($sql_detail);

                foreach ($cart as $item) {
                    // Nếu sau này database của bạn có thêm cột size, bạn có thể truyền thêm biến $item['size'] vào đây nhé
                    $stmt_detail->execute([
                        $order_id,
                        $item['name'],
                        $item['price'],
                        $item['image']
                    ]);
                }

                $conn->commit();
                unset($_SESSION['cart']);

                echo "<script>
                        alert('Đặt hàng thành công!');
                        window.location.href='products.php';
                      </script>";
                exit();

            } catch (Exception $e) {
                $conn->rollBack();
                echo "<script>
                        alert('Lỗi hệ thống: ".$e->getMessage()."');
                      </script>";
            }
        }
    }
}

/* =========================================
   DỮ LIỆU GIỎ HÀNG
========================================= */
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng - Tiệm Đồ Chất</title>
    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Thêm chút CSS cho cột Size hiển thị đẹp hơn */
        .product-size {
            text-align: center;
            font-weight: 600;
            color: #333;
        }
    </style>
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

<section class="cart">
    <h1>GIỎ HÀNG CỦA BẠN</h1>

    <?php if(count($cart) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Size</th> <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart as $key => $item): ?>
                    <?php $total += $item['price']; ?>
                    <tr>
                        <td>
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Ảnh sản phẩm" class="product-image">
                        </td>
                        <td class="product-name">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </td>
                        
                        <td class="product-size">
                            <?php 
                                // Hiển thị Size, nếu ko có thì để dấu "-"
                                echo isset($item['size']) ? htmlspecialchars($item['size']) : '-'; 
                            ?>
                        </td>
                        <td class="product-price">
                            <?php
                                echo number_format($item['price'], 0, ',', '.');
                            ?>đ
                        </td>
                        <td>
                            <a href="cart.php?action=delete&id=<?php echo $key; ?>" class="btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                <i class="fas fa-trash-alt"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            <h2>
                Tổng tiền:
                <span>
                    <?php echo number_format($total, 0, ',', '.'); ?>đ
                </span>
            </h2>
        </div>

        <div class="payment">
            <h2>PHƯƠNG THỨC THANH TOÁN</h2>
            <form method="POST" action="cart.php">
                <label class="payment-option">
                    <input type="radio" name="payment" value="COD" checked>
                    Thanh toán khi nhận hàng (COD)
                </label>
                <label class="payment-option">
                    <input type="radio" name="payment" value="Chuyển khoản">
                    Chuyển khoản ngân hàng
                </label>

                <div class="bank-box">
                    <h3>Quét mã QR để thanh toán</h3>
                    <img src="image/qr.jpg" alt="QR" class="qr-image">
                    <p><strong>Ngân hàng:</strong> MB Bank</p>
                    <p><strong>Chủ tài khoản:</strong> BÙI THÀNH NHÂN</p>
                    <p><strong>Số tài khoản:</strong> 0928858951</p>
                    <p>
                        <strong>Nội dung:</strong>
                        <span class="transfer-content">THANHTOAN_TDC</span>
                    </p>
                </div>

                <button type="submit" name="checkout" class="checkout-btn">
                    XÁC NHẬN THANH TOÁN
                </button>
            </form>
        </div>

    <?php else: ?>
        <div class="empty-cart">
            <h2>Giỏ hàng đang trống!</h2>
            <a href="products.php">
                <button class="shop-btn">Mua sắm ngay</button>
            </a>
        </div>
    <?php endif; ?>
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
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="register.php">Đăng ký</a></li>
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
/* =========================
   HIỆN / ẨN QR
========================= */
const radios = document.querySelectorAll('input[name="payment"]');
const bankBox = document.querySelector('.bank-box');

if(bankBox){
    bankBox.style.display = "none";
}

radios.forEach(radio => {
    radio.addEventListener('change', function(){
        if(this.value === "Chuyển khoản"){
            bankBox.style.display = "block";
        }else{
            bankBox.style.display = "none";
        }
    });
});

/* =========================
   POPUP ĐĂNG XUẤT
========================= */
function openLogoutPopup(){
    document.getElementById("logoutPopup").style.display = "flex";
}

function closeLogoutPopup(){
    document.getElementById("logoutPopup").style.display = "none";
}

/* CLICK NGOÀI ĐỂ ĐÓNG */
window.onclick = function(e){
    let popup = document.getElementById("logoutPopup");
    if(e.target == popup){
        popup.style.display = "none";
    }
}
</script>

</body>
</html>