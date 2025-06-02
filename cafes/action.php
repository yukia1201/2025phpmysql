<?php
session_start();

require_once "dbconfig.php";

try {
    $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=UTF8", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("資料庫連線失敗：" . $e->getMessage());
}

$action = isset($_POST["action"]) ? $_POST["action"] : "";

if ($action == "login") {
    $name1 = $_POST["username"];
    $pass1 = $_POST["userpass"];

    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $stmt->bindParam(':username', $name1, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $dd = $stmt->fetch(PDO::FETCH_ASSOC);

        $id = $dd["id"];
        $username = $dd["username"];
        $hashed_password = $dd["userpass"];

        if (password_verify($pass1, $hashed_password)){
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $id;
            $_SESSION["username"] = $username;

            echo "Yes";
        } else {
            echo "No";
        }
    } else {
        echo "No";
    }

} elseif ($action == "logout") {
    $_SESSION = array();
    session_destroy();
}

unset($conn);
?>
