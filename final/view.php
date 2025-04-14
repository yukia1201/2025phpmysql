<?php include 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>產品詳細資料</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>產品詳細資料</h2>
    <a href="index.php" class="btn btn-secondary mb-3">回列表</a>
    <?php if ($product): ?>
    <ul class="list-group">
        <li class="list-group-item"><strong>產品名稱：</strong><?= htmlspecialchars($product['pname']) ?></li>
        <li class="list-group-item"><strong>產品規格：</strong><?= htmlspecialchars($product['pspec']) ?></li>
        <li class="list-group-item"><strong>價格：</strong>$<?= $product['price'] ?></li>
        <li class="list-group-item"><strong>製作日期：</strong><?= $product['pdate'] ?></li>
        <li class="list-group-item"><strong>內容說明：</strong><?= nl2br(htmlspecialchars($product['content'])) ?></li>
    </ul>
    <?php else: ?>
        <div class="alert alert-danger">找不到資料！</div>
    <?php endif; ?>
</body>
</html>
