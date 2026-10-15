
<?php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "shopping_cart"
);

if ($conn->connect_error) {
    die("Ket noi that bai: " . $conn->connect_error);
}

$username = "admin";
$password = password_hash("123456", PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (username, password) VALUES (?, ?)"
);

$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "Tao tai khoan admin thanh cong!";
} else {
    echo "Khong the tao tai khoan: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
