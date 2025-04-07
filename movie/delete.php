<?php include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM movie WHERE id = ?");
$stmt->execute([$id]);

header("Location: list.php");
exit;
