<?php
// Include config file
require_once "dbconfig.php";

// 建立連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM book WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍詳細資訊</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 2rem;
        }
        .info {
            margin-bottom: 20px;
            padding: 12px;
            background-color: #fafafa;
            border-left: 5px solid #007bff;
        }
        .info label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }
        .info p {
            margin: 0;
            color: #333;
            line-height: 1.5;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: #007bff;
            text-decoration: none;
            font-size: 1rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>書籍詳細資訊</h2>
        <?php if ($book): ?>
            <div class="info">
                <label>書名:</label>
                <p><?php echo htmlspecialchars($book['bookname']); ?></p>
            </div>
            <div class="info">
                <label>作者:</label>
                <p><?php echo htmlspecialchars($book['author']); ?></p>
            </div>
            <div class="info">
                <label>出版社:</label>
                <p><?php echo htmlspecialchars($book['publisher']); ?></p>
            </div>
            <div class="info">
                <label>出版日期:</label>
                <p><?php echo $book['pubdate']; ?></p>
            </div>
            <div class="info">
                <label>定價:</label>
                <p><?php echo $book['price']; ?> 元</p>
            </div>
            <div class="info">
                <label>內容說明:</label>
                <p><?php echo nl2br(htmlspecialchars($book['content'])); ?></p>
            </div>
        <?php else: ?>
            <p>找不到該書籍。</p>
        <?php endif; ?>
        <a class="back-link" href="book_list.php">返回書籍列表</a>
    </div>
</body>
</html>
