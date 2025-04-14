<?php
$host = 'localhost';
$dbname = 'school';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("連線失敗：" . $e->getMessage());
}
?>
