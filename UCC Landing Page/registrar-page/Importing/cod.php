<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$con = mysqli_connect('localhost', 'root', '', 'evaluation');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
    if(isset($_POST['save_excel_data']))
    {
        $fileName = $_FILES['import_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed_ext = ['xls', 'csv', 'xlsx'];


    $inputFileName = $_FILES['import_file']['tmp_name'];
    $spreadsheet = IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();

    $columnIndices = [
        'Course' => 'C',
        'SubjectCode' => 'D',
        'YearSection' => 'E',
        'SubjectDescription' => 'G',
        'Day' => 'I',
        'Time' => 'K',
        'Name' => 'C',
        'StudentNumber' => 'D',
        'Midterm' => 'E',
        'Finalterm' => 'F',
        'Finalgrades' => 'G',
    ];

    $row = 10; // Start from the row where student data begins

    while ($worksheet->getCell($columnIndices['Name'] . $row)->getValue() != "") {
        $course = $worksheet->getCell($columnIndices['Course'])->getValue();
        $subjectCode = $worksheet->getCell($columnIndices['SubjectCode'])->getValue();
        $yearSection = $worksheet->getCell($columnIndices['YearSection'])->getValue();
        $subjectDescription = $worksheet->getCell($columnIndices['SubjectDescription'])->getValue();
        $day = $worksheet->getCell($columnIndices['Day'])->getValue();
        $time = $worksheet->getCell($columnIndices['Time'])->getValue();

        $name = $worksheet->getCell($columnIndices['Name'] . $row)->getValue();
        $studentNumber = $worksheet->getCell($columnIndices['StudentNumber'] . $row)->getValue();
        $midterm = $worksheet->getCell($columnIndices['Midterm'] . $row)->getValue();
        $finalterm = $worksheet->getCell($columnIndices['Finalterm'] . $row)->getValue();
        $finalgrades = $worksheet->getCell($columnIndices['Finalgrades'] . $row)->getValue();

        // Validate and sanitize input data
        if (!is_numeric($midterm) || !is_numeric($finalterm) || !is_numeric($finalgrades)) {
            echo "Invalid grades for student: $name ($studentNumber)<br>";
            $row++;
            continue; // Skip this student record
        }

        // Use prepared statements to prevent SQL injection
        $checkQuery = "SELECT * FROM students WHERE CONCAT(sname, ', ', fname, ' ', mname) = ? AND studentno = ?";
        $stmtCheck = mysqli_prepare($con, $checkQuery);

        if (!$stmtCheck) {
            echo "Error preparing check statement: " . mysqli_error($con) . "<br>";
            $row++;
            continue; // Skip this student record
        }

        mysqli_stmt_bind_param($stmtCheck, "ss", $name, $studentNumber);
        mysqli_stmt_execute($stmtCheck);
        $result = mysqli_stmt_get_result($stmtCheck);

        if (mysqli_num_rows($result) > 0) {
            $updateQuery = "UPDATE students SET midterm = ?, finalterm = ?, finalgrades = ? WHERE name = ? AND studentno = ? AND subjectcode = ?";
            $stmtUpdate = mysqli_prepare($con, $updateQuery);

            if (!$stmtUpdate) {
                echo "Error preparing update statement: " . mysqli_error($con) . "<br>";
                $row++;
                continue; // Skip this student record
            }

            mysqli_stmt_bind_param($stmtUpdate, "ddssss", $midterm, $finalterm, $finalgrades, $name, $studentNumber, $subjectCode);
            $updateResult = mysqli_stmt_execute($stmtUpdate);

            if ($updateResult) {
                echo "Updated grades for student: $name ($studentNumber)<br>";
            } else {
                echo "Error updating grades for student: $name ($studentNumber)<br>";
            }

            mysqli_stmt_close($stmtUpdate);
        } else {
            $insertQuery = "INSERT INTO students (name, studentno, course, subjectcode, yearsection, subjectdescription, day, time, midterm, finalterm, finalgrades) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtInsert = mysqli_prepare($con, $insertQuery);

            if (!$stmtInsert) {
                echo "Error preparing insert statement: " . mysqli_error($con) . "<br>";
                $row++;
                continue; // Skip this student record
            }

            mysqli_stmt_bind_param($stmtInsert, "ssssssssddd", $name, $studentNumber, $course, $subjectCode, $yearSection, $subjectDescription, $day, $time, $midterm, $finalterm, $finalgrades);
            $insertResult = mysqli_stmt_execute($stmtInsert);

            if ($insertResult) {
                echo "Inserted grades for student: $name ($studentNumber)<br>";
            } else {
                echo "Error inserting grades for student: $name ($studentNumber)<br>";
            }

            mysqli_stmt_close($stmtInsert);
        }

        $row++;
    }
}
mysqli_close($con);
?>
