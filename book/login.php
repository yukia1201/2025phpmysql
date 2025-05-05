<?php
session_start();
require 'db.php';

// 顯示 POST 資料，幫助除錯
echo "<pre>";
var_dump($_POST);  // 檢查 POST 資料
echo "</pre>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    // 查詢資料庫，檢查是否有該用戶
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        // 顯示從資料庫中取得的用戶資料
        echo "<pre>User found:</pre>";
        var_dump($user);

        // 密碼比對
        if (password_verify($password, $user['userpass'])) {
            // 密碼比對成功
            $_SESSION['user'] = $user['username'];

            // 跳轉到書籍頁面
            header("Location: booklist.php");
            exit; // 確保後續程式碼不再執行
        } else {
            // 密碼錯誤
            $error = "登入失敗。帳號或密碼錯誤。";
        }
    } else {
        // 找不到用戶
        $error = "登入失敗。帳號或密碼錯誤。";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>登入</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>登入</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
        <div class="mb-3">
            <label>帳號：</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>密碼：</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">登入</button>
        <a href="register.php" class="btn btn-warning">註冊</a>
    </form>
</body>
</html>
