<?php
// Include config file
require_once "dbconfig.php";

// 建立連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM cafes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cafe = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>咖啡店詳細資訊</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #6f4e37;
            font-size: 2rem;
        }
        .info {
            margin-bottom: 20px;
            padding: 12px;
            background-color: #fafafa;
            border-left: 5px solid #6f4e37;
        }
        .info label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }
        .info p {
            margin: 0;
            color: #333;
            line-height: 1.5;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: #6f4e37;
            text-decoration: none;
            font-size: 1rem;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>咖啡店詳細資訊</h2>
        <?php if ($cafe): ?>
            <div class="info">
                <label>咖啡店名稱:</label>
                <p><?php echo htmlspecialchars($cafe['name']); ?></p>
            </div>
            <div class="info">
                <label>地址:</label>
                <p><?php echo htmlspecialchars($cafe['address']); ?></p>
            </div>
            <div class="info">
                <label>電話:</label>
                <p><?php echo htmlspecialchars($cafe['phone']); ?></p>
            </div>
            <div class="info">
                <label>營業時間:</label>
                <p><?php echo htmlspecialchars($cafe['business_hours']); ?></p>
            </div>
            <div class="info">
                <label>簡介說明:</label>
                <p><?php echo nl2br(htmlspecialchars($cafe['description'])); ?></p>
            </div>
        <?php else: ?>
            <p>找不到該咖啡店。</p>
        <?php endif; ?>
        <a class="back-link" href="cafes_list.php">返回咖啡店列表</a>
    </div>
</body>
</html>
