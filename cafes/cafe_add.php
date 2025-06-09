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

$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $business_hours = $_POST['business_hours'];
    $description = $_POST['description'];

    $sql = "INSERT INTO cafes (name, address, phone, business_hours, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "SQL 錯誤：" . $conn->error;
        exit;
    }

    $stmt->bind_param("sssss", $name, $address, $phone, $business_hours, $description);

    if ($stmt->execute()) {
        header("Location: cafes_list.php");
        exit();
    } else {
        echo "新增失敗: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>新增咖啡店</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            border-top: 5px solid #6f4e37; /* 咖啡色 */
        }
        h2 {
            text-align: center;
            color: #6f4e37;
            font-size: 1.8rem;
            margin-bottom: 25px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            color: #555;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }
        button {
            background-color: #6f4e37;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            width: 100%;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #5a3b2a;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #6f4e37;
            font-size: 1rem;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>新增咖啡店</h2>
        <form method="post">
            <label>咖啡店名稱:</label>
            <input type="text" name="name" required />

            <label>地址:</label>
            <input type="text" name="address" required />

            <label>電話:</label>
            <input type="text" name="phone" required />

            <label>營業時間:</label>
            <input type="text" name="business_hours" required />

            <label>簡介說明:</label>
            <textarea name="description" rows="4" required></textarea>

            <button type="submit">新增</button>
        </form>
        <a class="back-link" href="cafes_list.php">返回咖啡店列表</a>
    </div>
</body>
</html>
