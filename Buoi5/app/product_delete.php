<?php
require_once __DIR__ . "/common/auth.php";
require_once __DIR__ . "/model/product.php";
// Lấy ID
$id = filter_input(
    INPUT_GET,
    "id",
    FILTER_VALIDATE_INT
);

if (!$id || $id <= 0) {
    die("ID san pham khong hop le!");
}

// Tìm sản phẩm
$product = getProductById($id);

if (!$product) {
    die("San pham khong ton tai!");
}

$error = "";

// Chỉ xóa khi người dùng xác nhận
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (deleteProduct($id)) {
        header("Location: product_list.php");
        exit;
    } else {
        $error = "Xoa san pham that bai!";
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>XAC NHAN XOA SAN PHAM</h2>

<?php if ($error !== ""): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<p>Ban co chac chan muon xoa san pham nay?</p>

<p>
    <strong>Ten san pham:</strong>
    <?= htmlspecialchars(
        $product["name"],
        ENT_QUOTES,
        "UTF-8"
    ) ?>
</p>

<p>
    <strong>Gia:</strong>
    <?= number_format($product["price"], 0, ",", ".") ?> VND
</p>

<p>
    <strong>So luong:</strong>
    <?= (int)$product["quantity"] ?>
</p>

<form method="POST">
    <button type="submit">
        Xac nhan xoa
    </button>

    <a href="product_list.php">
        Huy
    </a>
</form>

<?php
require_once __DIR__ . "/view/footer.php";
?>
