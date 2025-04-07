<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "找不到這本書！";
        exit;
    }
} else {
    echo "沒有提供 ID！";
    exit;
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>書籍詳情</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        .label {
            font-weight: bold;
            color: #333;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>書籍詳情</h2>
    <table>
        <tr>
            <td class="label">書名：</td>
            <td><?php echo htmlspecialchars($row['bookname']); ?></td>
        </tr>
        <tr>
            <td class="label">作者：</td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
        </tr>
        <tr>
            <td class="label">出版社：</td>
            <td><?php echo htmlspecialchars($row['publisher']); ?></td>
        </tr>
        <tr>
            <td class="label">出版日期：</td>
            <td><?php echo htmlspecialchars($row['pubdate']); ?></td>
        </tr>
        <tr>
            <td class="label">定價：</td>
            <td><?php echo htmlspecialchars($row['price']); ?> 元</td>
        </tr>
        <tr>
            <td class="label">內容：</td>
            <td><?php echo nl2br(htmlspecialchars($row['content'])); ?></td>
        </tr>
    </table>
    <a class="back-link" href="index.php">返回書籍列表</a>
</div>

</body>
</html>
