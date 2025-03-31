<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯學生</title>
    <style>
        /* 美化表單 */
    </style>
</head>
<body>
    <div class="form-container">
        <h2>編輯學生資料</h2>
        <form method="POST" action="student_update.php">
            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

            <label for="schid">學號：</label>
            <input type="text" name="schid" value="<?php echo $student['schid']; ?>" required>

            <label for="name">姓名：</label>
            <input type="text" name="name" value="<?php echo $student['name']; ?>" required>

            <label for="gender">性別：</label>
            <select name="gender" required>
                <option value="M" <?php echo $student['gender'] == 'M' ? 'selected' : ''; ?>>男</option>
                <option value="F" <?php echo $student['gender'] == 'F' ? 'selected' : ''; ?>>女</option>
            </select>

            <label for="birthday">生日：</label>
            <input type="date" name="birthday" value="<?php echo $student['birthday']; ?>" required>

            <label for="email">電子郵件：</label>
            <input type="email" name="email" value="<?php echo $student['email']; ?>" required>

            <label for="address">住址：</label>
            <input type="text" name="address" value="<?php echo $student['address']; ?>" required>

            <button type="submit">更新學生資料</button>
        </form>
    </div>
</body>
</html>
