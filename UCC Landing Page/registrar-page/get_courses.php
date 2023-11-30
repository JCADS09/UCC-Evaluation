<?php
$con = mysqli_connect("localhost", "root", "", "uccevaluation");

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

if (isset($_GET['department'])) {
    $department = $_GET['department'];

    // Fetch courses based on the selected department
    $query = "SELECT c.course, cd.cdepartment, c.acronym FROM courses c 
              INNER JOIN cdept cd ON c.course_id = cd.course_id 
              WHERE cd.cdepartment = ?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $department);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $course, $cdepartment, $acronym);

        $courses = array();

        while (mysqli_stmt_fetch($stmt)) {
            $courses[] = array("course" => $course, "cdepartment" => $cdepartment, "acronym" => $acronym);
        }

        echo json_encode($courses);

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
