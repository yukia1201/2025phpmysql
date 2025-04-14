<?php
// db.php
$host = 'localhost';
$dbname = 'school';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "連線失敗: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>電影管理系統</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

<h2 class="mb-4">🎬 電影列表</h2>
<a href="add.php" class="btn btn-success mb-3">➕ 新增電影</a>
<table class="table table-bordered">
<tr><th>ID</th><th>電影名稱</th><th>年份</th><th>操作</th></tr>

<?php
$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$start = ($page - 1) * $perPage;
$totalStmt = $pdo->query("SELECT COUNT(*) FROM movie");
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $perPage);
$stmt = $pdo->prepare("SELECT * FROM movie ORDER BY id DESC LIMIT :start, :perPage");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
$stmt->execute();
$movies = $stmt->fetchAll();
?>

<?php foreach ($movies as $movie): ?>
<tr>
    <td><?= $movie['id'] ?></td>
    <td><?= htmlspecialchars($movie['title']) ?></td>
    <td><?= $movie['year'] ?></td>
    <td>
        <a href="view.php?id=<?= $movie['id'] ?>" class="btn btn-info btn-sm">🔍 檢視</a>
        <a href="edit.php?id=<?= $movie['id'] ?>" class="btn btn-warning btn-sm">✏️ 編輯</a>
        <a href="delete.php?id=<?= $movie['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除嗎？')">🗑️ 刪除</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<nav>
  <ul class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <li class="page-item <?= $i === $page ? 'active' : '' ?>">
        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>
  </ul>
</nav>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
