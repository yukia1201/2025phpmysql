<?php
// 資料庫連線設定
$host = 'localhost';
$dbname = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("連線失敗: " . $e->getMessage());
}

// 每頁顯示的資料筆數
$limit = 10;

// 取得目前頁數
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

// 計算要跳過的資料筆數
$offset = ($page - 1) * $limit;

// 計算總筆數
$totalStmt = $pdo->query("SELECT COUNT(*) FROM movie");
$totalRows = $totalStmt->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// 取得當前頁面的資料
$stmt = $pdo->prepare("SELECT * FROM movie ORDER BY id ASC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>電影列表</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #aaa;
            text-align: left;
        }
        nav {
            text-align: center;
        }
        a {
            margin: 0 5px;
            text-decoration: none;
            color: blue;
        }
        a.current {
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <h1>電影列表（每頁10筆）</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>電影名稱</th>
                <th>發行年份</th>
                <th>導演</th>
                <th>類型</th>
                <th>首映日期</th>
                <th>內容簡介</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?= htmlspecialchars($movie['id']) ?></td>
                <td><?= htmlspecialchars($movie['title']) ?></td>
                <td><?= htmlspecialchars($movie['year']) ?></td>
                <td><?= htmlspecialchars($movie['director']) ?></td>
                <td><?= htmlspecialchars($movie['mtype']) ?></td>
                <td><?= htmlspecialchars($movie['mdate']) ?></td>
                <td><?= htmlspecialchars($movie['content']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'current' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </nav>
</body>
</html>
