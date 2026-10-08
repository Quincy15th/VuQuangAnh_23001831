<?php
require_once 'model/product.php';
require_once 'view/header.php';

if (!isset($_GET['id'])) {
    die("Thiếu ID sản phẩm.");
}
$id = $_GET['id'];
$product = getProductById($id);

if (!$product) {
    die("Sản phẩm không tồn tại.");
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (empty($name)) {
        $error = "Tên không được rỗng.";
    } elseif ($price <= 0) {
        $error = "Giá phải > 0.";
    } elseif ($quantity < 0) {
        $error = "Số lượng phải >= 0.";
    } else {
        if (updateProduct($id, $name, $price, $quantity)) {
            header("Location: product_list.php");
            exit();
        } else {
            $error = "Có lỗi xảy ra khi cập nhật.";
        }
    }
}
?>
<h2>Sửa sản phẩm</h2>
<?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST" action="">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>"><br>
    <label>Giá:</label><br>
    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>"><br>
    <label>Số lượng:</label><br>
    <input type="number" name="quantity" value="<?= $product['quantity'] ?>"><br><br>
    <button type="submit">Cập nhật</button>
    <a href="product_list.php">Hủy</a>
</form>
<?php require_once 'view/footer.php'; ?>