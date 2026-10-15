
<?php
session_start();

if (isset($_SESSION["user_id"])) {
    // Đã đăng nhập
    header("Location: product_list.php");
} else {
    // Chưa đăng nhập
    header("Location: login.php");
}

exit;
