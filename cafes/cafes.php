<?php
session_start();

// 載入資料庫設定
require_once "dbconfig.php";

// 建立 MySQLi 連線
$conn = new mysqli($hostname, $dbuser, $dbpass, $database);

// 檢查連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// 設定編碼
$conn->set_charset("utf8mb4");

// 判斷是否登入
function loginOK() {
    return (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
}

// 如果有要刪除資料
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    // 只有登入狀態才能刪除，安全一點
    if (loginOK()) {
        $stmt = $conn->prepare("DELETE FROM cafes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: cafes.php");
    exit();
}

// 抓所有咖啡廳資料
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
    <h1 class="text-center mb-4">咖啡廳管理系統</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <?php if (loginOK()) { ?>
                <span class="me-3">管理者: <strong><?= htmlspecialchars($_SESSION["username"]) ?></strong></span>
                <a class="btn btn-outline-danger" href="#" id="logout">登出</a>
            <?php } else { ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">登入管理</button>
            <?php } ?>
        </div>
        <?php if (loginOK()) { ?>
            <a href="cafe_add.php" class="btn btn-success">新增咖啡廳</a>
        <?php } ?>
    </div>

    <div class="table-wrapper">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
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
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('確定刪除?');" class="btn btn-sm btn-danger">刪除</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal 登入 -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">登入管理</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
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

        if (username !== '' && userpass !== '') {
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
            data: { action: "logout" },
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

<?php
// 關閉資料庫連線
$conn->close();
?>
