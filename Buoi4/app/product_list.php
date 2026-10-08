<?php
require_once 'model/product.php';
require_once 'view/header.php';

$products = getAllProducts();
?>
<h2>Danh sách sản phẩm</h2>
<a href="product_add.php">Thêm sản phẩm mới</a>
<br><br>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Chức năng</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= $p['price'] ?></td>
        <td><?= $p['quantity'] ?></td>
        <td>
            <a href="product_edit.php?id=<?= $p['id'] ?>">[Sửa]</a> 
            <a href="product_delete.php?id=<?= $p['id'] ?>">[Xóa]</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php require_once 'view/footer.php'; ?>