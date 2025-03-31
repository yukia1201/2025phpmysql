<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 設定每頁顯示的筆數
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $records_per_page;

// 取得總筆數
$total_sql = "SELECT COUNT(*) FROM book";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_row();
$total_records = $total_row[0];
$total_pages = ceil($total_records / $records_per_page);

// 取得書籍資料
$sql = "SELECT * FROM book LIMIT $offset, $records_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>書籍列表</title>
</head>
<body>
    <h2>書籍列表</h2>
    <a href="add_book.php">新增書籍</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>書名</th>
            <th>作者</th>
            <th>出版社</th>
            <th>出版日期</th>
            <th>定價</th>
            <th>內容</th>
            <th>操作</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["bookname"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["publisher"] . "</td>";
                echo "<td>" . $row["pubdate"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["content"] . "</td>";
                echo "<td>
                        <a href='edit_book.php?id=" . $row["id"] . "'>編輯</a> | 
                        <a href='delete_book.php?id=" . $row["id"] . "' onclick='return confirm(\"確定要刪除嗎？\")'>刪除</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>沒有書籍資料</td></tr>";
        }
        ?>
    </table>

    <div>
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?= $page - 1 ?>">上一頁</a>
        <?php endif; ?>
        <span>第 <?= $page ?> 頁 / 共 <?= $total_pages ?> 頁</span>
        <?php if ($page < $total_pages): ?>
            <a href="index.php?page=<?= $page + 1 ?>">下一頁</a>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
$conn->close();
?>
