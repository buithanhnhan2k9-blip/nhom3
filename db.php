<?php
// Cấu hình các thông số kết nối
$servername = "127.0.0.1"; // Dùng IP này để tránh lỗi phân giải tên miền trên Windows
$username = "root";        // Tài khoản mặc định
$dbname = "tiem_do_chat";  // Tên database của bạn

/* ⚠️ LƯU Ý VỀ MẬT KHẨU (PASSWORD):
- Nếu bạn dùng XAMPP mặc định: để trống $password = "";
- Nếu bạn từng tự đặt mật khẩu khi cài MySQL hoặc dùng MAMP: hãy thử đổi thành "root" hoặc mật khẩu của bạn.
*/
$password = "1234";

try {
    // Khởi tạo kết nối PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    
    // Thiết lập chế độ báo lỗi để dễ dàng debug khi có sự cố
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    // Nếu kết nối thất bại, thông báo lỗi và dừng chương trình
    die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
}
?>