<?php
session_start();
require_once "dbconfig.php";

// 建立連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

function loginOK() {
    return (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
}

// 刪除資料
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if (loginOK()) {
        $stmt = $conn->prepare("DELETE FROM cafes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: cafes_list.php");
    exit();
}

// 查詢資料
$result = $conn->query("SELECT * FROM cafes");
if (!$result) {
    die("查詢失敗: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>咖啡廳管理系統</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-wrapper {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .btn-action {
            margin-right: 5px;
        }
        .modal-content {
            border-radius: 15px;
        }
        .modal-header {
            background-color: #343a40;
            color: white;
        }
        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            border-radius: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center my-5">☕ 咖啡廳管理系統</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <?php if (loginOK()) { ?>
                <span class="me-3">👩‍💼 管理者：<strong><?= htmlspecialchars($_SESSION["username"]) ?></strong></span>
                <a class="btn btn-outline-danger btn-sm" href="#" id="logout">登出</a>
            <?php } else { ?>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#loginModal">登入管理</button>
            <?php } ?>
        </div>
        <?php if (loginOK()) { ?>
            <a href="cafe_add.php" class="btn btn-success btn-sm">➕ 新增咖啡廳</a>
        <?php } ?>
    </div>

    <div class="table-wrapper">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>咖啡廳名稱</th>
                    <th>地址</th>
                    <th>電話</th>
                    <th>營業時間</th>
                    <th>特色</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["address"]) ?></td>
                    <td><?= htmlspecialchars($row["phone"]) ?></td>
                    <td><?= htmlspecialchars($row["business_hours"]) ?></td>
                    <td class="text-start"><?= nl2br(htmlspecialchars($row["features"])) ?></td>
                    <td>
                        <a href="cafe_detail.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info btn-action">查看</a>
                        <?php if (loginOK()) { ?>
                            <a href="cafe_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning btn-action">修改</a>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('確定要刪除這間咖啡廳嗎？');" class="btn btn-sm btn-danger">刪除</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: 登入視窗 -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">🔐 登入管理系統</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="關閉"></button>
      </div>
      <div class="modal-body">
        <form id="loginForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="username" placeholder="使用者名稱" required />
                <label for="username">使用者名稱</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="userpass" id="userpass" placeholder="密碼" required />
                <label for="userpass">密碼</label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary w-100" id="login_button">登入</button>
      </div>
    </div>
  </div>
</div>

<!-- JS 套件 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $('#login_button').click(function () {
        const username = $('#username').val().trim();
        const userpass = $('#userpass').val().trim();

        if (username && userpass) {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: {
                    action: "login",
                    username: username,
                    userpass: userpass
                },
                success: function (data) {
                    if (data === 'Yes') {
                        alert("✅ 成功登入！");
                        location.reload();
                    } else {
                        alert('❌ 登入失敗，請檢查帳號或密碼！');
                    }
                },
                error: function () {
                    alert('⚠️ 系統錯誤，請稍後再試。');
                }
            });
        } else {
            alert("❗請輸入帳號與密碼");
        }
    });

    $('#logout').click(function () {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { action: "logout" },
            success: function () {
                alert("👋 您已成功登出！");
                location.reload();
            }
        });
    });
});
</script>

</body>
</html>

<?php
$conn->close();
?>
