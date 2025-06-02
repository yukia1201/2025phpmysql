<?php
// Initialize the session
session_start();

// Include config file
require_once "dbconfig.php";

// 定義登入成功後要跳轉的頁面（記得改成你實際頁面）
$main = "welcome.php"; 

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: $main");
    exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=UTF8", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "請輸入帳號。";
        } else{
            $username = trim($_POST["username"]);
        }

        // Check if password is empty
        if(empty(trim($_POST["userpass"]))){
            $password_err = "請輸入密碼。";
        } else{
            $password = trim($_POST["userpass"]);
        }

        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id, username, userpass FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $row["id"];
                $username = $row["username"];
                $hashed_password = $row["userpass"];

                if(password_verify($password, $hashed_password)){
                    // 登入成功，設定 session
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;

                    header("location: $main");
                    exit;
                } else{
                    $login_err = "帳號或密碼錯誤。";
                }
            } else{
                $login_err = "帳號或密碼錯誤。";
            }
        }
    } catch (PDOException $e) {
        echo "資料庫錯誤：" . $e->getMessage();
    }

    // 關閉連線
    $conn = null;
}
?>
