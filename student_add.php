<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>新增學生</h2>
        <form method="POST" action="student_insert.php">
            <label for="schid">學號：</label>
            <input type="text" name="schid" required>

            <label for="name">姓名：</label>
            <input type="text" name="name" required>

            <label for="gender">性別：</label>
            <select name="gender" required>
                <option value="M">男</option>
                <option value="F">女</option>
            </select>

            <label for="birthday">生日：</label>
            <input type="date" name="birthday" required>

            <label for="email">電子郵件：</label>
            <input type="email" name="email" required>

            <label for="address">住址：</label>
            <input type="text" name="address" required>

            <button type="submit">新增學生</button>
        </form>
    </div>
</body>
</html>
