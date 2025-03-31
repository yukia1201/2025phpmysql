<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM book WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $pubdate = $_POST['pubdate'];
    $price = $_POST['price'];
    $content = $_POST['content'];

    $sql = "UPDATE book SET bookname='$bookname', author='$author', publisher='$publisher', pubdate='$pubdate', price='$price', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "更新成功！<a href='index.php'>返回列表</a>";
    } else {
        echo "錯誤: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>編輯書籍</title>
</head>
<body>
    <h2>編輯書籍</h2>
    <form method="POST">
        <label>書名：</label><input type="text" name="bookname" value="<?= $row['bookname'] ?>" required><br>
        <label>作者：</label><input type="text" name="author" value="<?= $row['author'] ?>" required><br>
        <label>出版社：</label><input type="text" name="publisher" value="<?= $row['publisher'] ?>" required><br>
        <label>出版日期：</label><input type="date" name="pubdate" value="<?= $row['pubdate'] ?>" required><br>
        <label>定價：</label><input type="number" name="price" value="<?= $row['price'] ?>" required><br>
        <label>內容：</label><textarea name="content" required><?= $row['content'] ?></textarea><br>
        <button type="submit">更新書籍</button>
    </form>
</body>
</html>
