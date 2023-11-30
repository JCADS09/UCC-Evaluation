<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "uccevaluation");

if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uniqueId = $_POST['uniqueId'];
    $collegeDepartment = $_POST['collegeDepartment'];

    if (
        isset($_POST['courseDescription'], $_POST['acronym']) &&
        is_array($_POST['courseDescription']) &&
        is_array($_POST['acronym'])
    ) {
        $courseDescriptions = $_POST['courseDescription'];
        $acronyms = $_POST['acronym'];

        $insertCoursesQuery = "INSERT INTO courses (uniqueid, course, acronym) VALUES (?, ?, ?)";
        $stmtCourses = mysqli_prepare($con, $insertCoursesQuery);

        if (!$stmtCourses) {
            die("Insertion Error: " . mysqli_error($con));
        }

        for ($i = 0; $i < count($courseDescriptions); $i++) {
            $fullDescription = $courseDescriptions[$i];
            $acronym = $acronyms[$i];

            mysqli_stmt_bind_param($stmtCourses, "iss", $uniqueId, $fullDescription, $acronym);
            mysqli_stmt_execute($stmtCourses);

            if (mysqli_stmt_affected_rows($stmtCourses) < 1) {
                die("Insertion Failed: " . mysqli_error($con));
            }

            $courseId = mysqli_insert_id($con);

            $insertCdeptQuery = "INSERT INTO cdept (course_id, cdepartment) VALUES (?, ?)";
            $stmtCdept = mysqli_prepare($con, $insertCdeptQuery);

            if (!$stmtCdept) {
                die("Insertion Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmtCdept, "is", $courseId, $collegeDepartment);
            mysqli_stmt_execute($stmtCdept);

            if (mysqli_stmt_affected_rows($stmtCdept) < 1) {
                die("Insertion Failed: " . mysqli_error($con));
            }

            mysqli_stmt_close($stmtCdept);
        }

        mysqli_stmt_close($stmtCourses);

        header("Location: managecampus.php");
    } else {
        echo "Invalid request!";
    }
}

mysqli_close($con);
?>
