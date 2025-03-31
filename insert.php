<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// 建立連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
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

    // 使用預備語句防止 SQL 注入
    $stmt = $conn->prepare("INSERT INTO book (bookname, author, publisher, pubdate, price, content) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $bookname, $author, $publisher, $pubdate, $price, $content);

    if ($stmt->execute()) {
        echo "新增成功！<a href='index.php'>回到書籍列表</a>";
    } else {
        echo "錯誤: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
