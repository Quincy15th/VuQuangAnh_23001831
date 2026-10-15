

<?php
require_once __DIR__ . "/common/auth.php";
require_once __DIR__ . "/model/product.php";

$error = "";
$name = "";
$price = "";
$quantity = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $quantity = trim($_POST["quantity"] ?? "");

    // Kiểm tra dữ liệu
    if ($name === "") {
        $error = "Ten san pham khong duoc rong!";
    } elseif (
        $price === "" ||
        !is_numeric($price) ||
        $price <= 0
    ) {
        $error = "Gia phai lon hon 0!";
    } elseif (
        $quantity === "" ||
        filter_var($quantity, FILTER_VALIDATE_INT) === false ||
        (int)$quantity < 0
    ) {
        $error = "So luong phai la so nguyen >= 0!";
    } else {

        // Gọi hàm thêm sản phẩm
        if (addProduct($name, $price, (int)$quantity)) {
            header("Location: product_list.php");
            exit;
        } else {
            $error = "Them san pham that bai!";
        }
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>THEM SAN PHAM</h2>

<?php if ($error !== ""): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>Ten san pham:</label><br>
    <input
        type="text"
        name="name"
        value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"
    >
    <br><br>

    <label>Gia san pham:</label><br>
    <input
        type="number"
        name="price"
        step="0.01"
        min="0.01"
        value="<?= htmlspecialchars($price, ENT_QUOTES, 'UTF-8') ?>"
    >
    <br><br>

    <label>So luong:</label><br>
    <input
        type="number"
        name="quantity"
        step="1"
        min="0"
        value="<?= htmlspecialchars($quantity, ENT_QUOTES, 'UTF-8') ?>"
    >
    <br><br>

    <button type="submit">Them san pham</button>

    <a href="product_list.php">Quay lai</a>

</form>

<?php
require_once __DIR__ . "/view/footer.php";
?>
