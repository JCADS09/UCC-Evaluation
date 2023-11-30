<?php
require_once('db.php');

if (isset($_POST["FG1"], $_POST["value"], $_POST["pk"])) {
    $FG1 = $_POST["FG1"];
    $value = $_POST["value"];
    $pk = $_POST["pk"];

    // Escape the values to prevent SQL injection
    $FG1 = mysqli_real_escape_string($con, $FG1);
    $value = mysqli_real_escape_string($con, $value);
    $pk = mysqli_real_escape_string($con, $pk);

    $query = "UPDATE students SET $FG1 = '$value' WHERE sno = '$pk'";

    if ($con->query($query) === TRUE) {
        echo "Update successful!";
    } else {
        echo "Error updating record: " . $con->error;
    }
} else {
    echo "Missing required data!";
}
