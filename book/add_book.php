<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>新增書籍</title>
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
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
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
    <h2>新增書籍</h2>
    <form method="POST" action="insert.php">
        <table>
            <tr>
                <td><label>書名：</label></td>
                <td><input type="text" name="bookname" required></td>
            </tr>
            <tr>
                <td><label>作者：</label></td>
                <td><input type="text" name="author" required></td>
            </tr>
            <tr>
                <td><label>出版社：</label></td>
                <td><input type="text" name="publisher" required></td>
            </tr>
            <tr>
                <td><label>出版日期：</label></td>
                <td><input type="date" name="pubdate" required></td>
            </tr>
            <tr>
                <td><label>定價：</label></td>
                <td><input type="number" name="price" required></td>
            </tr>
            <tr>
                <td><label>內容：</label></td>
                <td><textarea name="content" rows="4" required></textarea></td>
            </tr>
        </table>
        <button type="submit">新增書籍</button>
    </form>
    <a class="back-link" href="index.php">返回書籍列表</a>
</div>

</body>
</html>
