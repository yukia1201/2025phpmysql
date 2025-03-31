<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$id = $_GET["id"];
$sql = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>學生詳細資料</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>學生詳細資料</h2>
    <p><strong>學號：</strong> <?= $row["schid"] ?></p>
    <p><strong>姓名：</strong> <?= $row["name"] ?></p>
    <p><strong>性別：</strong> <?= $row["gender"] ?></p>
    <p><strong>生日：</strong> <?= $row["birthday"] ?></p>
    <p><strong>電子郵件：</strong> <?= $row["email"] ?></p>
    <p><strong>住址：</strong> <?= $row["address"] ?></p>
    <a href="student_list.php" class="btn">返回</a>
</body>
</html>
