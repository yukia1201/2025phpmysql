<?php include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO product (pname, pspec, price, pdate, content) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['pname'],
        $_POST['pspec'],
        $_POST['price'],
        $_POST['pdate'],
        $_POST['content']
    ]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>新增產品</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>新增產品</h2>
    <form method="post">
        <div class="mb-2">
            <label>名稱</label><input type="text" name="pname" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>規格</label><input type="text" name="pspec" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>價格</label><input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>製作日期</label><input type="date" name="pdate" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>內容說明</label><textarea name="content" class="form-control" rows="4" required></textarea>
        </div>
        <button class="btn btn-success">新增</button>
        <a href="index.php" class="btn btn-secondary">取消</a>
    </form>
</body>
</html>
