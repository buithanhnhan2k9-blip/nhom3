<?html

$host = "localhost";
$user = "root";
$password = "1234";
$database = "tiem_do_chat";

/* =========================
   KẾT NỐI DATABASE
========================= */

$conn = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if(!$conn){

    die(
        "Kết nối thất bại: "
        . mysqli_connect_error()
    );
}

/* =========================
   LẤY DỮ LIỆU
========================= */

$name = $_POST['name'];

$email = $_POST['email'];

$pass = $_POST['password'];

$confirm = $_POST['confirm_password'];

/* =========================
   KIỂM TRA PASSWORD
========================= */

if($pass != $confirm){

    die("Mật khẩu xác nhận không khớp!");

}

/* =========================
   KIỂM TRA EMAIL
========================= */

$check = "
SELECT *
FROM users
WHERE email='$email'
";

$result = mysqli_query(
    $conn,
    $check
);

if(mysqli_num_rows($result) > 0){

    die("Email đã tồn tại!");

}

/* =========================
   MÃ HÓA PASSWORD
========================= */

$hashed_password =
password_hash(
    $pass,
    PASSWORD_DEFAULT
);

/* =========================
   INSERT DATABASE
========================= */

$sql = "
INSERT INTO users(
    name,
    email,
    password
)

VALUES(
    '$name',
    '$email',
    '$hashed_password'
)
";

if(mysqli_query($conn,$sql)){

    echo "
    <script>

        alert('Đăng ký thành công!');

        window.location.href='login.html';

    </script>
    ";

}else{

    echo "Đăng ký thất bại!";

}

?>