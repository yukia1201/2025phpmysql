<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';
$stmt = $pdo->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>書籍清單</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h2>書籍清單</h2>
        <div>
            <span class="me-3">👤 <?php echo $_SESSION['user']; ?></span>
            <a href="logout.php" class="btn btn-danger btn-sm">登出</a>
        </div>
    </div>
    <a href="add.php" class="btn btn-success my-3">➕ 新增書籍</a>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>書名</th>
                <th>作者</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['id']) ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['author']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-warning btn-sm">編輯</a>
                        <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除嗎？')">刪除</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
