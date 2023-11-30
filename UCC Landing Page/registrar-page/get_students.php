<?php
header('Content-Type: application/json');

$con = mysqli_connect("localhost", "root", "", "uccevaluation");

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

$department = $_GET['department'];
$course = $_GET['course'];

// Fetch the course acronym based on the selected department
$query = "SELECT c.acronym FROM cdept cd
          JOIN courses c ON cd.course_id = c.course_id
          WHERE cd.cdepartment = '$department'";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);
$acronym = $row['acronym'];

// Fetch students based on the course acronym and year
$query = "SELECT sno, CONCAT(sname, ', ', fname, ' ', mname) AS Name, course, year1 AS year, section AS section, status1 AS status FROM 202220231stsemcongress
          WHERE year1 = 4 AND course = '$acronym' LIMIT 300";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($con));
}

$students = array();
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

// Send the JSON response
echo json_encode($students);

mysqli_close($con);
?>
