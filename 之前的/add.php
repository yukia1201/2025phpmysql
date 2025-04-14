<?php include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO movie (title, year, director, mtype, mdate, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'], $_POST['year'], $_POST['director'],
        $_POST['mtype'], $_POST['mdate'], $_POST['content']
    ]);
    header("Location: list.php");
    exit;
}
?>

<h2>新增電影</h2>
<form method="post">
    名稱：<input type="text" name="title" required><br>
    年份：<input type="number" name="year" required><br>
    導演：<input type="text" name="director" required><br>
    類型：<input type="text" name="mtype" required><br>
    首映日期：<input type="date" name="mdate" required><br>
    簡介：<br><textarea name="content" rows="5" cols="50" required></textarea><br>
    <button type="submit">儲存</button>
</form>
<a href="list.php">返回列表</a>
