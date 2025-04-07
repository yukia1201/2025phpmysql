<?php include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM movie WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    echo "找不到該筆資料。"; exit;
}
?>

<h2>電影詳細資料</h2>
<p><strong>名稱：</strong> <?= htmlspecialchars($movie['title']) ?></p>
<p><strong>年份：</strong> <?= $movie['year'] ?></p>
<p><strong>導演：</strong> <?= htmlspecialchars($movie['director']) ?></p>
<p><strong>類型：</strong> <?= htmlspecialchars($movie['mtype']) ?></p>
<p><strong>首映日期：</strong> <?= $movie['mdate'] ?></p>
<p><strong>簡介：</strong> <?= nl2br(htmlspecialchars($movie['content'])) ?></p>

<p><a href="edit.php?id=<?= $movie['id'] ?>">✏️ 編輯</a> | 
<a href="list.php">返回列表</a></p>
