<?php
session_start();

// Include config file
require_once "dbconfig.php";

function loginOK() {
    return (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"]===true));
}

// 建立連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

// 檢查連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM book WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: book_list.php");
    exit();
}

$result = $conn->query("SELECT * FROM book");
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>書籍管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-wrapper {
            margin: 20px auto;
            width: 95%;
        }
        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">書籍管理系統</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <?php if (loginOK()) { ?>
                <span class="me-3">管理者: <strong><?= $_SESSION["username"] ?></strong></span>
                <a class="btn btn-outline-danger" href="#" id="logout">登出</a>
            <?php } else { ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">登入管理</button>
            <?php } ?>
        </div>
        <?php if (loginOK()) { ?>
            <a href="book_add.php" class="btn btn-success">新增書籍</a>
        <?php } ?>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
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
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["bookname"] ?></td>
                    <td><?= $row["author"] ?></td>
                    <td><?= $row["publisher"] ?></td>
                    <td><?= $row["pubdate"] ?></td>
                    <td><?= $row["price"] ?></td>
                    <td class="text-start"><?= nl2br($row["content"]) ?></td>
                    <td>
                        <a href="book_detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info btn-action">查看</a>
                        <?php if (loginOK()) { ?>
                            <a href="book_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning btn-action">修改</a>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('確定刪除?');" class="btn btn-sm btn-danger">刪除</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">登入管理</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="loginForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="使用者名稱" required>
                <label for="username">使用者名稱</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="userpass" id="userpass" placeholder="密碼" required>
                <label for="userpass">密碼</label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="login_button">登入系統</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#login_button').click(function () {
        var username = $('#username').val();
        var userpass = $('#userpass').val();

        if (username != '' && userpass != '') {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    "action": "login",
                    "username": username,
                    "userpass": userpass
                },
                success: function (data) {
                    if (data === 'Yes') {
                        alert("成功登入系統...");
                        location.reload();
                    } else {
                        alert('帳密無法使用!');
                    }
                },
                error: function () {
                    alert('無法登入');
                }
            });
        } else {
            alert("兩個欄位都要填寫!");
        }
    });

    $('#logout').click(function () {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { "action": "logout" },
            success: function () {
                alert("您已登出本系統...");
                location.reload();
            }
        });
    });
});
</script>
</body>
</html>
