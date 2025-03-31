<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

// 創建資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 檢查表單是否提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 從 POST 請求中獲取資料
    $id = $_POST['id'];
    $schid = $_POST['schid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // 建立 SQL 更新語句
    $sql = "UPDATE student 
            SET schid = '$schid', name = '$name', gender = '$gender', birthday = '$birthday', email = '$email', address = '$address'
            WHERE id = $id";

    // 執行 SQL 語句並檢查是否成功
    if ($conn->query($sql) === TRUE) {
        echo "學生資料更新成功！";
        // 更新後跳轉回學生列表
        header("Location: student_list.php");
        exit();
    } else {
        echo "錯誤: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
