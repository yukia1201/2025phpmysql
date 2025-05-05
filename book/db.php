<?php
$host = 'localhost';  // 資料庫主機，通常是 localhost
$dbname = 'school';     // 這是資料庫名稱，請確認這裡是否正確
$username = 'root';   // 資料庫使用者名稱（XAMPP 預設為 root）
$password = '';       // 資料庫密碼（XAMPP 預設為空）

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // 設定錯誤模式為例外
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '連接錯誤: ' . $e->getMessage();
}
?>
