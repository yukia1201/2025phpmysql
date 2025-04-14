<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = $conn->query("SELECT * FROM book WHERE id=$id");

if ($result->num_rows == 0) {
    echo "找不到該書籍！<br>";
    echo "<a href='index.php'>返回列表</a>";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>查看書籍</title>
</head>
<body>
    <h2>書籍詳細資訊</h2>
    <p><strong>書名：</strong><?= $row['bookname'] ?></p>
    <p><strong>作者：</strong><?= $row['author'] ?></p>
    <p><strong>出版社：</strong><?= $row['publisher'] ?></p>
    <p><strong>出版日期：</strong><?= $row['pubdate'] ?></p>
    <p><strong>定價：</strong><?= $row['price'] ?> 元</p>
    <p><strong>內容：</strong><br><?= nl2br($row['content']) ?></p>
    
    <a href="index.php">返回列表</a>
</body>
</html>

<?php
$conn->close();
?>
