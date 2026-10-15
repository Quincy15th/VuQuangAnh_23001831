
<?php
// Khởi tạo phiên hiện tại
session_start();

// Xóa tất cả biến SESSION
$_SESSION = [];

// Xóa cookie phiên nếu có
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Hủy SESSION
session_destroy();

// Chuyển về trang đăng nhập
header("Location: login.php");
exit;
