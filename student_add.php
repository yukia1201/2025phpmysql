<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "school";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    $schid = $_POST["schid"];
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $sql = "INSERT INTO student (schid, name, gender, birthday, email, address) VALUES ('$schid', '$name', '$gender', '$birthday', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        header("Location: student_list.php");
    } else {
        echo "錯誤: " . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>新增學生</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>新增學生</h2>
    <form method="POST">
        <label>學號：</label><input type="text" name="schid" required><br>
        <label>姓名：</label><input type="text" name="name" required><br>
        <label>性別：</label>
        <select name="gender">
            <option value="M">男</option>
            <option value="F">女</option>
        </select><br>
        <label>生日：</label><input type="date" name="birthday" required><br>
        <label>電子郵件：</label><input type="email" name="email" required><br>
        <label>住址：</label><input type="text" name="address" required><br>
        <button type="submit">提交</button>
    </form>
</body>
</html>
