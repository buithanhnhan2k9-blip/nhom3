<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiệm Đồ Chất</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="image/l.png" alt="Logo">
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

<section class="banner">
    <div class="overlay">
        <h1>THỜI TRANG GIỚI TRẺ</h1>
        <p>Phong cách hiện đại - Cá tính - Năng động</p>
        <a href="products.php">
            <button>Mua ngay</button>
        </a>
    </div>
</section>

<section class="intro">
    <div class="intro-container">
        <h2>GIỚI THIỆU WEBSITE</h2>
        <p class="intro-tagline">Định hình phong cách - Khẳng định chất riêng!</p>
        <p class="intro-description">
            Chào mừng bạn đến với <strong>Tiệm Đồ Chất</strong> – trạm dừng chân lý tưởng dành cho những tín đồ đam mê phong cách Streetwear độc đáo và phá cách. Ra đời với sứ mệnh mang đến làn gió mới cho xu hướng thời trang giới trẻ, chúng tôi không chỉ bán quần áo, mà còn cùng bạn tự tin nói lên cái tôi khác biệt của chính mình. 
        </p>
        
        <div class="intro-features">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-fire-alt"></i>
                </div>
                <h3>Thiết Kế Độc Bản</h3>
                <p>Liên tục cập nhật xu hướng Local Brand, Oversize "chất lừ" giúp bạn luôn dẫn đầu xu hướng.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h3>Chất Lượng Vượt Trội</h3>
                <p>Từng thớ vải, đường kim mũi chỉ đều được chọn lọc kỹ càng, mang lại sự thoải mái tối đa.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Trải Nghiệm Tuyệt Vời</h3>
                <p>Giao hàng siêu tốc, chính sách đổi trả linh hoạt và đội ngũ support luôn online vì bạn.</p>
            </div>
        </div>
    </div>
</section>

<section class="hot-products">
    <h2>Sản phẩm nổi bật</h2>
    <div class="product-container">
        <div class="product-card">
            <img src="image/k (2).jpg" alt="Áo Hoodie">
            <h3>Áo Hoodie Local Brand</h3>
            <p>350.000đ</p>
            <button>Mua ngay</button>
        </div>
        <div class="product-card">
            <img src="image/a.jpg" alt="Áo Thun">
            <h3>Áo Thun Oversize</h3>
            <p>220.000đ</p>
            <button>Mua ngay</button>
        </div>
        <div class="product-card">
            <img src="image/q.png" alt="Quần Jean">
            <h3>Quần Baggy Jean</h3>
            <p>420.000đ</p>
            <button>Mua ngay</button>
        </div>
        <div class="product-card">
            <img src="image/k (2).webp" alt="Áo Khoác">
            <h3>Áo Khoác Streetwear</h3>
            <p>550.000đ</p>
            <button>Mua ngay</button>
        </div>
    </div>
</section>

<div class="messenger">
    <div class="messenger-icon" id="chatIcon">💬</div>
    <div class="messenger-box" id="chatBox">
        <div class="messenger-header">
            <div class="header-info">
                <img src="image/l.png" alt="Avatar Shop">
                <div>
                    <h3>Tiệm Đồ Chất</h3>
                    <span>Đang hoạt động</span>
                </div>
            </div>
            <button id="closeChat">✖</button>
        </div>
        <div class="messenger-body" id="chatBody"></div>
        <div class="messenger-footer">
            <input type="text" id="messageInput" placeholder="Nhập tin nhắn...">
            <button onclick="sendMessage()">➤</button>
        </div>
    </div>
</div>

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

<script>
/* CHATBOX SCRIPT */
const chatIcon = document.getElementById("chatIcon");
const chatBox = document.getElementById("chatBox");
const closeChat = document.getElementById("closeChat");

chatIcon.onclick = function(){
    if(chatBox.style.display === "flex"){
        chatBox.style.display = "none";
    }else{
        chatBox.style.display = "flex";
    }
}

closeChat.onclick = function(){
    chatBox.style.display = "none";
}

function sendMessage(){
    let input = document.getElementById("messageInput");
    let message = input.value;

    if(message.trim() == ""){
        return;
    }

    let chatBody = document.getElementById("chatBody");
    chatBody.innerHTML += `
        <div class="chat right">
            ${message}
        </div>
    `;

    input.value = "";
    chatBody.scrollTop = chatBody.scrollHeight;

    setTimeout(function(){
        let reply = "";
        let lower = message.toLowerCase();

        if(lower.includes("xin chào")){
            reply = "Xin chào 👋 Shop có thể hỗ trợ gì cho bạn?";
        }
        else if(lower.includes("giá")){
            reply = "Bạn vui lòng gửi tên sản phẩm để shop báo giá nhé.";
        }
        else if(lower.includes("size")){
            reply = "Shop hiện có size S, M, L, XL nhé 👕";
        }
        else{
            reply = "Shop đã nhận tin nhắn ❤️ Giờ làm việc shop sẽ rep ngay nha!";
        }

        chatBody.innerHTML += `
            <div class="chat left">
                ${reply}
            </div>
        `;
        chatBody.scrollTop = chatBody.scrollHeight;
    }, 1000);
}

document.getElementById("messageInput").addEventListener("keypress", function(e){
    if(e.key === "Enter"){
        sendMessage();
    }
});
</script>

</body>
</html>