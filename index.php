<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySOL</title>
</head>
<body>
    <H1>Home Sweet Home</H1>
    <hr>
    <p>計算結果: <?= 333*555 ?></p>
    
    <p>今天的日期是: <?= Date("Y/m/d") ?></p>
    <hr>

    <form action="myact.php">
    姓名:
    <input type="text" name="name">
    年紀:
    <input type="text" name="age">
    身高:
    <input type="text" name="height">
    體重:
    <input type="text" name="weight">
    <br>
    <input type="submit" value="送出">
    </form>

    <p>我的身高是: <?= $h=157 ?></p>
    <p>我的體重是: <?= $w=45 ?></p>
    <p>我的BMI是: <?= $w/($h/100*$h/100) ?></p>
    <hr>
    <p>我的名字是: <?= $_GET["name"] ?></p>
    <p>我的年紀是: <?= $_GET["age"] ?></p>
    <p>我的身高是: <?= $_GET["height"] ?></p>
    <p>我的體重是: <?= $_GET["weight"] ?></p>
    <hr>
</body>
</html>