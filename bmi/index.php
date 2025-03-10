<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySOL</title>
</head>
<body>
    <H1>Home Sweet Home</H1>
    <form action="">
    姓名:
    <input type="text" name="name">
    年紀:
    <input type="text" name="age">
    身高:
    <input type="text" name="height">
    體重:
    <input type="text" name="weight">
    <br>
    <input type="submit" value="送出" name="submit">
    </form>

    <hr>

    <?php if(isset($_GET["submit"])) {?>

    <h1>資料收到</h1>
    <p>我的名字是: <?= $_GET["name"] ?></p>
    <p>我的年紀是: <?= $_GET["age"] ?></p>
    <p>我的身高是: <?= $h=$_GET["height"] ?></p>
    <p>我的體重是: <?= $w=$_GET["weight"] ?></p>
    <p>你的BMI值:  <?= $bmi = $w/($h/100*$h/100) ?></p>
    
    <?php
     if ($bmi>25) {
        echo "你好胖";
    } elseif ($bmi<18){
        echo "你太瘦";
    } else {
        echo "身材適中，繼續保持!";
    }
    ?>
    <?php } ?>
    
</body>
</html>