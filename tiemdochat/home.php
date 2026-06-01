<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

<h1>Xin chào <?php echo $_SESSION["user"]; ?></h1>

<a href="logout.php">Đăng xuất</a>

</body>
</html>