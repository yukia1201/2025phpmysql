<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
$id = $_GET['id'];
$conn->query("DELETE FROM book WHERE id=$id");
header("Location: index.php");
?>
