<?php

// 設定主機、資料庫名稱、權限帳密
$hostname = 'localhost';
$database = 'database_name';
$dbuser = 'username';
$dbpass = 'password';

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=UTF8", $dbuser, $dbpass);

    // 設定錯誤處理模式 set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "連線成功 Connected successfully";

} catch(PDOException $e) {

    echo "連線失敗 Connection failed: " . $e->getMessage();

} finally {

    // 關閉連線
    $conn = null;

}
?>