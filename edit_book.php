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
    <title>編輯書籍</title>
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
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
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
    <h2>編輯書籍</h2>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <table>
            <tr>
                <td><label>書名：</label></td>
                <td><input type="text" name="bookname" value="<?php echo $row['bookname']; ?>" required></td>
            </tr>
            <tr>
                <td><label>作者：</label></td>
                <td><input type="text" name="author" value="<?php echo $row['author']; ?>" required></td>
            </tr>
            <tr>
                <td><label>出版社：</label></td>
                <td><input type="text" name="publisher" value="<?php echo $row['publisher']; ?>" required></td>
            </tr>
            <tr>
                <td><label>出版日期：</label></td>
                <td><input type="date" name="pubdate" value="<?php echo $row['pubdate']; ?>" required></td>
            </tr>
            <tr>
                <td><label>定價：</label></td>
                <td><input type="number" name="price" value="<?php echo $row['price']; ?>" required></td>
            </tr>
            <tr>
                <td><label>內容：</label></td>
                <td><textarea name="content" rows="4" required><?php echo $row['content']; ?></textarea></td>
            </tr>
        </table>
        <button type="submit">更新書籍</button>
    </form>
    <a class="back-link" href="index.php">返回書籍列表</a>
</div>

</body>
</html>
