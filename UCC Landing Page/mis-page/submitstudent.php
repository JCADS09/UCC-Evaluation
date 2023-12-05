<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requiredFields = ['sname', 'fname', 'mname', 'sno', 'sex', 'course', 'year1', 'section', 'status1', 'semester', 'sy1', 'sy2', 'date_enrol'];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['message2'] = 'Please complete the form.';
            header("Location: addstudent.php");
            exit();
        }
    }
    
    $con = mysqli_connect("localhost", "root", "", "uccevaluation");
    if (!$con) {
        die("Connection Error: " . mysqli_connect_error());
    }

    $sname = $_POST['sname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $sno = $_POST['sno'];
    $sex = $_POST['sex'];
    $course = $_POST['course'];
    $year1 = $_POST['year1'];
    $section = $_POST['section'];
    $status1 = $_POST['status1'];
    $semester = $_POST['semester'];
    $sy1 = $_POST['sy1'];
    $sy2 = $_POST['sy2'];
    $date = $_POST['date_enrol'];

    $scodeValues = $_POST['scode'];
    $descValues = $_POST['desc'];
    $unitValues = $_POST['unit'];

    $selectQuery = "SELECT campus_name FROM campus";
    $result = mysqli_query($con, $selectQuery);
    $campusRow = mysqli_fetch_assoc($result);
    $selectedCampus = $campusRow['campus_name'];
    $selectedCampus = $_POST['campus_name'];
    // $tableName = "student" . $semester . "sem" . $sy1 . $sy2;
    $tableName1 = $sy1 . $sy2 . $semester . "sem" . $selectedCampus;
    // Construct the dynamic part of the query for scode, desc, and unit columns
    $columnInserts = '';
    for ($i = 0; $i < count($scodeValues); $i++) {
        $columnInserts .= "scode" . ($i + 1) . ", desc" . ($i + 1) . ", unit" . ($i + 1) . ", ";
    }
    $columnInserts = rtrim($columnInserts, ", ");

    $valuePlaceholders = rtrim(str_repeat("?, ?, ?, ", count($scodeValues)), ", ");

    $typeDefinitionString = "sssssssssssss" . str_repeat("sss", count($scodeValues));

    // // Define your condition here
    // $useTableName1 = ($selectedCampus === 'Congress'); // Modify this condition accordingly

    // // Use the dynamically determined table name based on the condition
    // $tableNameToUse = $useTableName1 ? $tableName1 : $tableName;

    $insertQuery = "INSERT INTO $tableName1 (sname, fname, mname, sno, sex, course, year1, section, status1, semester, sy1, sy2, date_enrol, $columnInserts) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, $valuePlaceholders)";

    $stmt = mysqli_prepare($con, $insertQuery);

    if ($stmt) {
        $bindParams = [&$stmt, $typeDefinitionString, &$sname, &$fname, &$mname, &$sno, &$sex, &$course, &$year1, &$section, &$status1, &$semester, &$sy1, &$sy2, &$date];

        for ($i = 0; $i < count($scodeValues); $i++) {
            $bindParams[] = &$scodeValues[$i];
            $bindParams[] = &$descValues[$i];
            $bindParams[] = &$unitValues[$i];
        }

        // Call the function with references
        call_user_func_array('mysqli_stmt_bind_param', $bindParams);

        mysqli_stmt_execute($stmt);
        
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION['message'] = 'Record added successfully!';
            header("Location: addstudent.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }

        //echo "Inserted Values: sname=$sname, fname=$fname, mname=$mname, sno=$sno, sex=$sex, course=$course, year1=$year1, section=$section, status1=$status1, semester=$semester, sy1=$sy1, sy2=$sy2, date_enrol=$date, campus=$selectedCampus, scodeValues=" . implode(", ", $scodeValues) . ", descValues=" . implode(", ", $descValues) . ", unitValues=" . implode(", ", $unitValues) . "<br>";

        mysqli_stmt_close($stmt);
    } else {
        echo "Error in preparing the statement: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>