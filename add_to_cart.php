<?php
require_once 'config/config.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // Bảo mật: Ép kiểu số nguyên

    // Kiểm tra sản phẩm dựa trên cấu trúc bảng products của bạn
    $stmt = $conn->prepare("SELECT id, product_name, base_price, thumbnail_image FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    if ($product) {
        // Nếu giỏ hàng trống, tạo mảng mới
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Nếu sản phẩm đã có thì tăng số lượng lên 1
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            // Nếu chưa có, thêm mới thông tin
            $_SESSION['cart'][$product_id] = [
                'name'     => $product['product_name'],
                'price'    => $product['base_price'],
                'image'    => $product['thumbnail_image'],
                'quantity' => 1
            ];
        }
    }
}

// Chuyển hướng ngay tới trang hiển thị giỏ hàng
header('Location: cart.php');
exit();
?>