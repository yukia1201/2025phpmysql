<?php include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE movie SET title=?, year=?, director=?, mtype=?, mdate=?, content=? WHERE id=?");
    $stmt->execute([
        $_POST['title'], $_POST['year'], $_POST['director'],
        $_POST['mtype'], $_POST['mdate'], $_POST['content'], $id
    ]);
    header("Location: list.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM movie WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    echo "資料不存在"; exit;
}
?>

<h2>編輯電影</h2>
<form method="post">
    名稱：<input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>"><br>
    年份：<input type="number" name="year" value="<?= $movie['year'] ?>"><br>
    導演：<input type="text" name="director" value="<?= htmlspecialchars($movie['director']) ?>"><br>
    類型：<input type="text" name="mtype" value="<?= htmlspecialchars($movie['mtype']) ?>"><br>
    首映日期：<input type="date" name="mdate" value="<?= $movie['mdate'] ?>"><br>
    簡介：<br><textarea name="content" rows="5" cols="50"><?= htmlspecialchars($movie['content']) ?></textarea><br>
    <button type="submit">儲存</button>
</form>
<a href="list.php">返回列表</a>
