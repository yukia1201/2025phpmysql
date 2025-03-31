<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資料列表</title>
</head>
<body>
<?php

// 設定主機、資料庫名稱、權限帳密
$hostname = 'localhost';
$database = 'school';
$dbuser = 'rootx';
$dbpass = '';

try {

    // 連接資料庫
    $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=UTF8", $dbuser, $dbpass);

    // 設定錯誤處理模式 set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 執行查詢指令
    $sql = "SELECT * FROM table_name";
    $stmt = $conn->query($sql);

    // 設定資料取出的方式
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // 取出資料集
    $datarows = $stmt -> fetchAll();

    // 逐項顯示
    foreach ($datarows as $row) {
        echo $row['bookname']."<br>\n";
        echo $row['author']."<br>\n";
        echo $row['price']."<br>\n";
        echo "</ul>";
    }

} catch(PDOException $e) {

    echo "連線失敗 Connection failed: " . $e->getMessage();

} finally {

    $conn = null;

}

?>
</body>
</html>