
<?php
require_once __DIR__ . '/../common/dbConnect.php';

// Lấy tất cả sản phẩm
function getAllProducts() {
    global $conn;

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Lấy sản phẩm theo ID
function getProductById($id) {
    global $conn;

    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}

// Thêm sản phẩm
function addProduct($name, $price, $quantity) {
    global $conn;

    $sql = "INSERT INTO products (name, price, quantity)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $name, $price, $quantity);

    return $stmt->execute();
}

// Sửa sản phẩm
function updateProduct($id, $name, $price, $quantity) {
    global $conn;

    $sql = "UPDATE products
            SET name = ?, price = ?, quantity = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sdii",
        $name,
        $price,
        $quantity,
        $id
    );

    return $stmt->execute();
}

// Xóa sản phẩm
function deleteProduct($id) {
    global $conn;

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute();
}
