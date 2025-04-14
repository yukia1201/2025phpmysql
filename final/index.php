<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>產品列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">產品列表</h2>
    <a href="create.php" class="btn btn-primary mb-3">新增產品</a>
    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $stmt = $pdo->query("SELECT COUNT(*) FROM product");
    $total = $stmt->fetchColumn();
    $pages = ceil($total / $limit);

    $stmt = $pdo->prepare("SELECT * FROM product ORDER BY id DESC LIMIT :start, :limit");
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>名稱</th>
                <th>規格</th>
                <th>價格</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['pname']) ?></td>
                <td><?= htmlspecialchars($row['pspec']) ?></td>
                <td>$<?= $row['price'] ?></td>
                <td>
                    <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">查看</a>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">修改</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定要刪除嗎？')">刪除</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- 分頁 -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
</body>
</html>
