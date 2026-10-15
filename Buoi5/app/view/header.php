
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quan ly san pham</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #eeeeee;
        }

        a {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background: #1976d2;
            color: white;
            text-decoration: none;
            margin-bottom: 15px;
        }

        .user-info {
            background: #f1f1f1;
            padding: 12px;
            margin-bottom: 20px;
        }

        .logout {
            color: red;
            float: right;
        }
    </style>
</head>
<body>

<h1>QUAN LY SAN PHAM</h1>

<?php if (isset($_SESSION["user_id"])): ?>

    <div class="user-info">

        Xin chao,
        <strong>
            <?= htmlspecialchars(
                $_SESSION["username"],
                ENT_QUOTES,
                "UTF-8"
            ) ?>
        </strong>

        <a href="logout.php" class="logout">
            Dang xuat
        </a>

    </div>

<?php endif; ?>

<hr>
