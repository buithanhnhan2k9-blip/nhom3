<?php include("config/config.php");
$id = $_GET['id'];
$row = $conn->prepare("SELECT * FROM products WHERE id=?");
$row->execute([$id]);
$p = $row->fetch();

if (isset($_POST['update'])) {
    $img = $_FILES['thumbnail_image']['name'] ? $_FILES['thumbnail_image']['name'] : $p['thumbnail_image'];
    if($_FILES['thumbnail_image']['name']) move_uploaded_file($_FILES['thumbnail_image']['tmp_name'], "image/products/".$img);
    
    $sql = $conn->prepare("UPDATE products SET product_name=?, base_price=?, description=?, thumbnail_image=? WHERE id=?");
    $sql->execute([$_POST['name'], $_POST['price'], $_POST['desc'], $img, $id]);
    header("Location: admin_products.php");
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="style/admin_products.css"></head>
<body>
    <?php include("header.php"); ?>
    <form method="POST" enctype="multipart/form-data" style="margin: 20px;">
        <h2>Sửa sản phẩm</h2>
        <input type="text" name="name" value="<?= $p['product_name'] ?>">
        <input type="number" name="price" value="<?= $p['base_price'] ?>">
        <textarea name="desc"><?= $p['description'] ?></textarea>
        <img src="image/products/<?= $p['thumbnail_image'] ?>" width="80">
        <input type="file" name="thumbnail_image">
        <button type="submit" name="update" class="btn btn-edit">Cập nhật</button>
    </form>
</body>
</html>