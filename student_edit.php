<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$id = $_GET["id"];
$sql = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schid = $_POST["schid"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $sql = "UPDATE student SET schid='$schid', name='$name', gender='$gender', birthday='$birthday', email='$email', address='$address' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: student_list.php");
    } else {
        echo "錯誤: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>修改學生</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>修改學生</h2>
    <form method="POST">
        <label>學號：</label><input type="text" name="schid" value="<?= $row['schid'] ?>" required><br>
        <label>姓名：</label><input type="text" name="name" value="<?= $row['name'] ?>" required><br>
        <label>性別：</label>
        <select name="gender">
            <option value="M" <?= ($row['gender'] == 'M') ? 'selected' : '' ?>>男</option>
            <option value="F" <?= ($row['gender'] == 'F') ? 'selected' : '' ?>>女</option>
        </select><br>
        <label>生日：</label><input type="date" name="birthday" value="<?= $row['birthday'] ?>" required><br>
        <label>電子郵件：</label><input type="email" name="email" value="<?= $row['email'] ?>" required><br>
        <label>住址：</label><input type="text" name="address" value="<?= $row['address'] ?>" required><br>
        <button type="submit">更新</button>
    </form>
</body>
</html>
