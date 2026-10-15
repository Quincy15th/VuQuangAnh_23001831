
<?php
// Kiểm tra đăng nhập
require_once __DIR__ . "/common/auth.php";

// Gọi model
require_once __DIR__ . "/model/product.php";

// Lấy danh sách sản phẩm
$products = getAllProducts();

// Hiển thị giao diện
require_once __DIR__ . "/view/header.php";
?>


<h2>Danh sach san pham</h2>

<a href="product_add.php" class="btn">
    + Them san pham
</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Ten san pham</th>
            <th>Gia</th>
            <th>So luong</th>
            <th>Chuc nang</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($products)): ?>
            <tr>
                <td colspan="5">
                    Chua co san pham nao.
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?= (int)$product["id"] ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $product["name"],
                            ENT_QUOTES,
                            "UTF-8"
                        ) ?>
                    </td>

                    <td>
                        <?= number_format(
                            $product["price"],
                            0,
                            ",",
                            "."
                        ) ?> VND
                    </td>

                    <td>
                        <?= (int)$product["quantity"] ?>
                    </td>

                    <td>
                        <a href="product_edit.php?id=<?= (int)$product['id'] ?>">
                            Sua
                        </a>

                        <a href="product_delete.php?id=<?= (int)$product['id'] ?>">
                            Xoa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php
require_once __DIR__ . "/view/footer.php";
?>
