<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schid = $_POST['schid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "INSERT INTO student (schid, name, gender, birthday, email, address) 
            VALUES ('$schid', '$name', '$gender', '$birthday', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        header("Location: student_list.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
