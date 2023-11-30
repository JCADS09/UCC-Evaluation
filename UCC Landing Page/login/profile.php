<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

// Retrieve user data from the session
$username = $_SESSION["username"];
$name = $_SESSION["name"];
$profile_picture = $_SESSION["profile_picture"];

// Display user information on the profile page
echo "<h2>Welcome, $name!</h2>";
echo "<p>Username: $username</p>";
echo "<img src='$profile_picture' alt='Profile Picture'>";

// Logout option
echo "<a href='logout.php'>Logout</a>";
?>
