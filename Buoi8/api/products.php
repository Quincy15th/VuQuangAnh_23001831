<?php
header('Content-Type: application/json; charset=utf-8');

function respond(bool $success, string $message = '', $data = null, int $status = 200): void {
    http_response_code($status);
    $result = ['success' => $success];
    if ($message !== '') $result['message'] = $message;
    if ($data !== null) $result['data'] = $data;
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

function jsonInput(): array {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($data) || array_is_list($data)) {
        respond(false, 'JSON không hợp lệ, cần một đối tượng dữ liệu', null, 400);
    }
    return $data;
}

function validateProduct(array $data): array {
    $name = $data['name'] ?? null;
    $price = $data['price'] ?? null;
    $stock = $data['stock'] ?? null;

    if (!is_string($name)) respond(false, 'Tên sản phẩm không hợp lệ', null, 400);
    $name = trim($name);
    $length = function_exists('mb_strlen') ? mb_strlen($name, 'UTF-8') : preg_match_all('/./us', $name);
    if ($length === false || $length < 1 || $length > 100) {
        respond(false, 'Tên sản phẩm phải từ 1 đến 100 ký tự', null, 400);
    }
    if (!is_int($price) || $price <= 0 || $price > 2147483647) {
        respond(false, 'Đơn giá phải là số nguyên lớn hơn 0 (tối đa 2147483647)', null, 400);
    }
    if (!is_int($stock) || $stock < 0 || $stock > 2147483647) {
        respond(false, 'Tồn kho phải là số nguyên không âm (tối đa 2147483647)', null, 400);
    }
    return [$name, $price, $stock];
}

try {
    // XAMPP mặc định: root không có mật khẩu. Sửa nếu máy bạn khác.
    $pdo = new PDO(
        'mysql:host=localhost;dbname=quanlysanpham;charset=utf8mb4',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_EMULATE_PREPARES => false]
    );

    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
        $rows = $pdo->query('SELECT id, name, price, stock FROM products ORDER BY id')->fetchAll();
        respond(true, '', $rows);
    }

    if ($method === 'POST') {
        [$name, $price, $stock] = validateProduct(jsonInput());
        $stmt = $pdo->prepare('INSERT INTO products (name, price, stock) VALUES (?, ?, ?)');
        $stmt->execute([$name, $price, $stock]);
        respond(true, 'Thêm sản phẩm thành công', ['id' => (int) $pdo->lastInsertId()], 201);
    }

    if ($method === 'PUT' || $method === 'DELETE') {
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($id === false || $id === null) respond(false, 'ID không hợp lệ', null, 400);

        // Kiểm tra dữ liệu trước khi ghi vào MySQL.
        if ($method === 'PUT') [$name, $price, $stock] = validateProduct(jsonInput());

        $stmt = $pdo->prepare('SELECT id FROM products WHERE id = ?');
        $stmt->execute([$id]);
        if (!$stmt->fetch()) respond(false, 'Sản phẩm không tồn tại', null, 404);

        if ($method === 'PUT') {
            $stmt = $pdo->prepare('UPDATE products SET name = ?, price = ?, stock = ? WHERE id = ?');
            $stmt->execute([$name, $price, $stock, $id]);
            respond(true, 'Cập nhật sản phẩm thành công');
        }

        $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
        $stmt->execute([$id]);
        respond(true, 'Xóa sản phẩm thành công');
    }

    header('Allow: GET, POST, PUT, DELETE');
    respond(false, 'Phương thức không được hỗ trợ', null, 405);
} catch (PDOException $e) {
    respond(false, 'Lỗi cơ sở dữ liệu. Kiểm tra MySQL và cấu hình kết nối.', null, 500);
}
