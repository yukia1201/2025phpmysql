<?php include 'db.php';

$limit = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$total = $pdo->query("SELECT COUNT(*) FROM movie")->fetchColumn();
$totalPages = ceil($total / $limit);

$stmt = $pdo->prepare("SELECT * FROM movie ORDER BY id DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$movies = $stmt->fetchAll();
?>

<h2>電影列表</h2>
<a href="add.php">➕ 新增電影</a>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>名稱</th><th>年份</th><th>導演</th><th>操作</th>
    </tr>
    <?php foreach ($movies as $m): ?>
    <tr>
        <td><?= $m['id'] ?></td>
        <td><?= htmlspecialchars($m['title']) ?></td>
        <td><?= $m['year'] ?></td>
        <td><?= htmlspecialchars($m['director']) ?></td>
        <td>
            <a href="view.php?id=<?= $m['id'] ?>">查看</a> |
            <a href="edit.php?id=<?= $m['id'] ?>">編輯</a> |
            <a href="delete.php?id=<?= $m['id'] ?>" onclick="return confirm('確定刪除嗎？')">刪除</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>

<div>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>" <?= $i == $page ? 'style="font-weight:bold;color:red"' : '' ?>><?= $i ?></a>
    <?php endfor ?>
</div>
