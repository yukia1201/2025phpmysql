<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 取得學生資料
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>學生列表</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>學生列表</h2>
    <a href="student_add.php" class="btn">新增學生</a>
    <table>
        <tr>
            <th>學號</th>
            <th>姓名</th>
            <th>性別</th>
            <th>生日</th>
            <th>電子郵件</th>
            <th>住址</th>
            <th>操作</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row["schid"] ?></td>
            <td><?= $row["name"] ?></td>
            <td><?= $row["gender"] ?></td>
            <td><?= $row["birthday"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["address"] ?></td>
            <td>
                <a href="student_detail.php?id=<?= $row["id"] ?>">查看</a> | 
                <a href="student_edit.php?id=<?= $row["id"] ?>">修改</a> | 
                <a href="student_delete.php?id=<?= $row["id"] ?>" onclick="return confirm('確定刪除?')">刪除</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 取得學生資料
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

// 檢查 SQL 查詢是否有錯誤
if (!$result) {
    die("錯誤: " . $conn->error);
}
?>

</body>
</html>
