<?php
require_once 'model/product.php';
require_once 'view/header.php';

if (!isset($_GET['id'])) {
    die("Thiếu ID sản phẩm.");
}
$id = $_GET['id'];
$product = getProductById($id);

if (!$product) {
    echo "<p>Sản phẩm không tồn tại.</p>";
    echo "<a href='product_list.php'>Quay lại danh sách</a>";
    require_once 'view/footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
        deleteProduct($id);
    }
    header("Location: product_list.php");
    exit();
}
?>
<h2>Xóa sản phẩm</h2>
<p>Bạn có chắc chắn muốn xóa sản phẩm "<strong><?= htmlspecialchars($product['name']) ?></strong>" không?</p>
<form method="POST" action="">
    <button type="submit" name="confirm" value="yes">Có, Xóa</button>
    <button type="submit" name="confirm" value="no">Không, Hủy</button>
</form>
<?php require_once 'view/footer.php'; ?>