<?php
session_start();

function loginOK() {
    return (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] === true));
}

if (!loginOK()) { 
    header("location: login.php");
    exit();
}

// Include config file
require_once "dbconfig.php";

// 建立連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];       // 店名
    $address = $_POST['address'];         // 地址
    $phone = $_POST['phone'];       // 電話
    $business_hours = $_POST['business_hours'];             // 營業時間
    $features = $_POST['features'];       // 特色
    $description = $_POST['description']; // 簡介

    $stmt = $conn->prepare("UPDATE cafes SET name=?, address=?, phone=?, business_hours=?, features=?, description=? WHERE id=?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssssssi", $name, $address, $phone, $business_hours, $features,  $description, $id);

    if ($stmt->execute()) {
        header("Location: cafes_list.php");
        exit();
    } else {
        echo "更新失敗: " . $stmt->error;
    }
    $stmt->close();
}

// 讀取咖啡店資料用的SQL
$stmt = $conn->prepare("SELECT * FROM cafes WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}
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
    <title>修改咖啡店資料</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-top: 15px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">修改咖啡店資料</h2>
        <?php if ($cafe): ?>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $cafe['id']; ?>" />
                
                <label>店名:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($cafe['name']); ?>" required />
                
                <label>地址:</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($cafe['address']); ?>" required />

                <label>電話:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($cafe['phone']); ?>" required />
                
                <label>營業時間:</label>
                <input type="text" name="business_hours" value="<?php echo htmlspecialchars($cafe['business_hours']); ?>" required />
                
                <label>特色:</label>
                <textarea name="features" rows="3" required><?php echo htmlspecialchars($cafe['features']); ?></textarea>
                
                <label>簡介:</label>
                <textarea name="description" rows="4" required><?php echo htmlspecialchars($cafe['description']); ?></textarea>
                
                <button type="submit">儲存</button>
            </form>
        <?php else: ?>
            <p>找不到該咖啡店資料。</p>
        <?php endif; ?>
        <a class="back-link" href="cafes_list.php">返回咖啡店列表</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
