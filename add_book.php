<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookname = $_POST['bookname'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $pubdate = $_POST['pubdate'];
    $price = $_POST['price'];
    $content = $_POST['content'];

    $sql = "INSERT INTO book (bookname, author, publisher, pubdate, price, content) 
            VALUES ('$bookname', '$author', '$publisher', '$pubdate', '$price', '$content')";

    if ($conn->query($sql) === TRUE) {
        echo "新增成功！<a href='index.php'>返回列表</a>";
    } else {
        echo "錯誤: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>新增書籍</title>
</head>
<body>
    <h2>新增書籍</h2>
    <form method="POST">
        <label>書名：</label><input type="text" name="bookname" required><br>
        <label>作者：</label><input type="text" name="author" required><br>
        <label>出版社：</label><input type="text" name="publisher" required><br>
        <label>出版日期：</label><input type="date" name="pubdate" required><br>
        <label>定價：</label><input type="number" name="price" required><br>
        <label>內容：</label><textarea name="content" required></textarea><br>
        <button type="submit">新增書籍</button>
    </form>
</body>
</html>
