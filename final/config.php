<?php
$host = 'localhost';
$dbname = 'school';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
} catch (PDOException $e) {
    die("資料庫連線失敗：" . $e->getMessage());
}
?>
