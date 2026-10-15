
<?php
session_start();

require_once __DIR__ . "/common/dbConnect.php";

// Nếu đã đăng nhập thì chuyển đến danh sách
if (isset($_SESSION["user_id"])) {
    header("Location: product_list.php");
    exit;
}

$error = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Vui long nhap day du thong tin!";
    } else {

        // 1. Tìm tài khoản theo username
        $sql = "SELECT id, username, password
                FROM users
                WHERE username = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // 2. Kiểm tra mật khẩu
        if (
            $user &&
            password_verify($password, $user["password"])
        ) {
            // 3. Đăng nhập thành công
            session_regenerate_id(true);

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            // 4. Chuyển đến danh sách sản phẩm
            header("Location: product_list.php");
            exit;

        } else {
            $error = "Sai ten dang nhap hoac mat khau!";
        }
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>DANG NHAP</h2>

<?php if (isset($_GET["registered"])): ?>
    <p style="color: green;">
        Dang ky thanh cong! Vui long dang nhap.
    </p>
<?php endif; ?>

<?php if ($error !== ""): ?>
    <p style="color: red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>Ten dang nhap:</label><br>
    <input
        type="text"
        name="username"
        value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>"
        required
    >
    <br><br>

    <label>Mat khau:</label><br>
    <input
        type="password"
        name="password"
        required
    >
    <br><br>

    <button type="submit">
        Dang nhap
    </button>

</form>

<p>
    Chua co tai khoan?
    <a href="register.php">Dang ky</a>
</p>

<?php
require_once __DIR__ . "/view/footer.php";
?>
