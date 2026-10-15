
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_cart";

try {
    $conn = new mysqli(
        $servername,
        $username,
        $password,
        $dbname
    );

    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    die("Khong the ket noi database. Hay kiem tra MySQL va cau hinh ket noi.");
}
?>
