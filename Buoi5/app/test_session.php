
<?php
session_start();

if (isset($_SESSION["user_id"])) {
    echo "Da dang nhap!<br>";

    echo "User ID: "
        . (int)$_SESSION["user_id"]
        . "<br>";

    echo "Username: "
        . htmlspecialchars(
            $_SESSION["username"],
            ENT_QUOTES,
            "UTF-8"
        );
} else {
    echo "Chua dang nhap!";
}
?>
