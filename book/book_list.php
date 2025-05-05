<?php
session_start();

// Include config file
require_once "dbconfig.php";

function loginOK() {
    return (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] === true));
}

// Establish connection
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set encoding for proper display of Chinese characters
$conn->set_charset("utf8mb4");

// Handle book deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM book WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: book_list.php");
    exit();
}

// Get the list of books
$result = $conn->query("SELECT * FROM book");
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍管理</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table { width: 100%; }
        th, td { text-align: center; padding: 8px; }
        th { background-color: #f8f9fa; }
        .table { border: 1px solid #ddd; }
        .table th, .table td { border: 1px solid #ddd; }
        .table tbody tr:hover { background-color: #f1f1f1; }
        .btn-custom { margin-right: 10px; }
        .container { margin-top: 20px; }
        .logout-btn { margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">書籍管理</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p>
            <?php if (loginOK()) { ?>
                <span class="badge bg-primary"><?= $_SESSION["username"]; ?></span>
                <a href="./logout.php" class="btn btn-danger logout-btn">登出</a>
            <?php } else { ?>
                <a href="./login.php" class="btn btn-primary">登入管理</a>
            <?php } ?> 
            </p>
            <div>
            <?php if (loginOK()) { ?>
                <a href="book_add.php" class="btn btn-success btn-custom">新增書籍</a>
            <?php } ?>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>書名</th>
                    <th>作者</th>
                    <th>出版社</th>
                    <th>出版日期</th>
                    <th>定價</th>
                    <th>內容說明</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["bookname"]; ?></td>
                    <td><?php echo $row["author"]; ?></td>
                    <td><?php echo $row["publisher"]; ?></td>
                    <td><?php echo $row["pubdate"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo nl2br($row["content"]); ?></td>
                    <td>
                        <a href="book_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">查看</a>
                        <?php if (loginOK()) { ?>
                            <a href="book_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">修改</a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('確定刪除?');">刪除</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
