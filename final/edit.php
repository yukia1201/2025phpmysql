<?php
include 'config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE product SET pname=?, pspec=?, price=?, pdate=?, content=? WHERE id=?");
    $stmt->execute([
        $_POST['pname'],
        $_POST['pspec'],
        $_POST['price'],
        $_POST['pdate'],
        $_POST['content'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>編輯產品</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>編輯產品</h2>
    <form method="post">
        <div class="mb-2">
            <label>名稱</label><input type="text" name="pname" value="<?= $product['pname'] ?>" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>規格</label><input type="text" name="pspec" value="<?= $product['pspec'] ?>" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>價格</label><input type="number" name="price" value="<?= $product['price'] ?>" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>製作日期</label><input type="date" name="pdate" value="<?= $product['pdate'] ?>" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>內容說明</label><textarea name="content" class="form-control" rows="4"><?= $product['content'] ?></textarea>
        </div>
        <button class="btn btn-warning">儲存修改</button>
        <a href="index.php" class="btn btn-secondary">取消</a>
    </form>
</body>
</html>
