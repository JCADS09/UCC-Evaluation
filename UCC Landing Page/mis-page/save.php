<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if (!$con) {
    die("Connection Error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campusName = $_POST["campus_name"];
    $campusAddress = $_POST["campus_location"];

    $stmt = $con->prepare("INSERT INTO campus (campus_name, campus_location) VALUES (?, ?)");
    $stmt->bind_param("ss", $campusName, $campusAddress);
    $stmt->execute();

    $_SESSION['message'] = 'New campus added successfully!';
    header("Location: addcampus.php");
    exit();
}
?>
