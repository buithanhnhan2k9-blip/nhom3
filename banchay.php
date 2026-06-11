<?php 
// BẮT BUỘC KHỞI TẠO SESSION Ở ĐẦU TRANG ĐỂ DÙNG GIỎ HÀNG
session_start();

// 1. Nhúng file cấu hình kết nối database
require_once 'config/config.php';

// XỬ LÝ KHI BẤM THÊM VÀO GIỎ HÀNG (Âm thầm, không hiện Alert)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $product_item = [
        "name" => $_POST['product_name'],
        "price" => $_POST['product_price'],
        "image" => $_POST['product_image']
    ];

    $_SESSION['cart'][] = $product_item;

    // Tải lại chính trang này một cách âm thầm
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// 2. Nhúng thanh header vào trang
include 'includes/header.php'; 

try {
    // 3. Viết câu lệnh SQL lấy ra sản phẩm (Tui đã tăng LIMIT lên 12 để hiển thị nhiều hơn)
    $query = "SELECT product_name, base_price, thumbnail_image FROM products ORDER BY id DESC LIMIT 12";
    $stmt  = $conn->query($query);
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    // Nếu có lỗi truy vấn xảy ra, tạo mảng rỗng để giao diện không bị sập lỗi
    $products = [];
}
?>

<section class="best-page">

    <h1>SẢN PHẨM BÁN CHẠY</h1>

    <div class="best-container">

        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="best-card">
                    <img src="<?php echo htmlspecialchars($product['thumbnail_image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    
                    <div class="best-content">
                        <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                        
                        <h4><?php echo number_format($product['base_price'], 0, ',', '.') . 'đ'; ?></h4>

                        <form method="POST" action="">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['base_price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['thumbnail_image']); ?>">
                            
                            <button type="submit" name="add_to_cart" style="cursor: pointer; padding: 10px 20px; background: #111; color: #fff; border: none; border-radius: 4px; font-weight: bold; width: 100%; transition: 0.3s;">
                                THÊM VÀO GIỎ
                            </button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; width: 100%;">Hiện tại chưa có sản phẩm nào trong hệ thống.</p>
        <?php endif; ?>

    </div>

</section>

<?php 
// 4. Nhúng thanh footer vào trang
include 'includes/footer.php'; 
?>