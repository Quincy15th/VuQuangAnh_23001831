<?php
$host = 'localhost';
$dbname = 'shopping_cart';
$user = 'root'; // Thay bằng user của bạn
$pass = '';     // Thay bằng password của bạn

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối database thất bại: " . $conn->connect_error);
}
?>