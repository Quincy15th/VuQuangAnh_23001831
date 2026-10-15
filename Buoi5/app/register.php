
<?php
require_once __DIR__ . "/common/dbConnect.php";

$error = "";
$success = "";
$username = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    // 1. Kiểm tra dữ liệu
    if ($username === "" || $password === "") {
        $error = "Vui long nhap day du thong tin!";
    } elseif (strlen($username) > 50) {
        $error = "Ten dang nhap toi da 50 ky tu!";
    } else {

        // 2. Kiểm tra username đã tồn tại chưa
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Ten dang nhap da ton tai!";
        } else {

            // 3. Băm mật khẩu
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // 4. Lưu tài khoản vào database
            $sql = "INSERT INTO users (username, password)
                    VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "ss",
                $username,
                $hashedPassword
            );

            try {
                if ($stmt->execute()) {
                    // Đăng ký thành công
                    header("Location: login.php?registered=1");
                    exit;
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    $error = "Ten dang nhap da ton tai!";
                } else {
                    $error = "Dang ky that bai!";
                }
            }
        }
    }
}

require_once __DIR__ . "/view/header.php";
?>

<h2>DANG KY TAI KHOAN</h2>

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
        maxlength="50"
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
        Dang ky
    </button>

</form>

<p>
    Da co tai khoan?
    <a href="login.php">Dang nhap</a>
</p>

<?php
require_once __DIR__ . "/view/footer.php";
?>
