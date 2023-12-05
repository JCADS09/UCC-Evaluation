<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Import Grades</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../system-img/check.png">

    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/owl.carousel.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/owl.transitions.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- <link rel="stylesheet" href="../../css/jvectormap/jquery-jvectormap-2.0.3.css"> -->
    <link rel="stylesheet" href="../../css/notika-custom-icon.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/wave/waves.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="stylesheet" href="../../topbarcss/topbar.css">
    <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
    <!--End Links-->
</head>
<style>
    .header {
        background-color: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0 auto 20px;
        width: 80%;
    }

    body {
        overflow-x: hidden;
    }

    .cancel {
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        border: none;
        margin-left: 6.5%;
        width: 11%;
        background-color: green;
    }
</style>

<body>

    <div class="header-top-area" style="background-color: rgb(17, 112, 22);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area" style="display: flex; align-items: center;">
                        <img src="../../system-img/check.png" width="45" height="45">
                        <span style="color: white; font-weight: bold; font-size: 24px; margin-left: 10px;">UCC
                            EVALUATION</span>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item dropdown">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="tab">
                            <a href="../../registrarnav.php">
                                <img src="../../system-img/home.png" width="28" height="27"> Dashboard
                            </a>
                        </li>

                        <li class="active">
                            <a href="code.php" style="background-color:#ff8e1c;color:white;">
                                <img src="../../system-img/import.png" width="22" height="22"> Import Grades
                            </a>
                        </li>

                        <li class="tab">
                            <a href="../evaluator-page/scholastic/students.php">
                                <img src="../../system-img/pencil.png" width="25" height="25"> Evaluate Students
                            </a>
                        </li>

                        <!-- <li class="tab">
                            <a href="../evaluate/gradingsheet.php">
                                <img src="../../system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                            </a>
                        </li> -->

                        <li class="tab">
                            <a href="../candidates.php">
                                <img src="../../system-img/trophy.png" width="25" height="25"> Candidates
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content custom-menu-content">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
        <br>
        <h1 style="text-align: center;">UCC Students' Grade</h1>

        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<h4>" . $_SESSION['message'] . "</h4>";
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div class="card-body">
                        <div>
                            <a href="../inputgrades.php"><label class="cancel">Manual Grades</label></a>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="row p-t-20" style="margin-left:5%;">
                                <div class="col-md-10">
                                    <div class="input-file">
                                        <label for="import_file">Choose Excel File:</label>
                                        <input type="file" name="import_file" class="form-control" id="import_file"
                                            accept=".xls, .xlsx, .csv" style="width:100%;">
                                    </div>
                                </div>
                                <div style="margin-top:2.8%;">
                                    <div class="btn-import">
                                        <button type="submit" name="submit_excel" class="btn btn-primary"
                                            style="background-color:#077504;border:none;">Import</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <?php
        require 'vendor/autoload.php';
        use PhpOffice\PhpSpreadsheet\IOFactory;


        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $con = mysqli_connect('localhost', 'root', '', 'uccevaluation');

        if (!$con) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        $num = 1;
        // ... (your existing code)
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['submit_excel'])) {
                $fileName = $_FILES['import_file']['name'];
                $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowed_ext = ['xls', 'csv', 'xlsx'];

                $inputFileName = $_FILES['import_file']['tmp_name'];
                $spreadsheet = IOFactory::load($inputFileName);
                $worksheet = $spreadsheet->getActiveSheet();

                $_SESSION['courseDetails'] = [
                    'courseName' => $worksheet->getCell('C4')->getValue(),
                    'year' => $worksheet->getCell('N4')->getValue(),
                    'semester' => $worksheet->getCell('J4')->getValue(),
                    'subjectCode' => $worksheet->getCell('D5')->getValue(),
                    'subjectDescription' => $worksheet->getCell('E7')->getValue(),
                    'units' => $worksheet->getCell('K6')->getValue(),
                ];


                echo "<div class='row p-t-20' style='margin-left:17%;'>";
                echo "<div class='col-md-6'>";
                echo "<justify>";
                echo "<a style='font-size:13px;font-family:arial;'>Course Name: " . $_SESSION['courseDetails']['courseName'] . "<br>";
                echo '</a>';
                echo "<a style='font-size:15px;font-family:arial;'>Subject Code: " . $_SESSION['courseDetails']['subjectCode'] . "<br>";
                echo "Subject Description: " . $_SESSION['courseDetails']['subjectDescription'] . "<br>";
                echo '</div>';
                echo "<div class='col-md-6'>";
                echo "Year: " . $_SESSION['courseDetails']['year'] . "<br>";
                echo "Semester: " . $_SESSION['courseDetails']['semester'] . "<br>";
                echo "Units: " . $_SESSION['courseDetails']['units'] . "<br>";
                echo '</div>';

                echo '</div>';
                echo "</justify>";
                echo '<br>';

                $startRow = 13;
                $endRow = $worksheet->getHighestRow();
                echo "<center>";
                echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
                echo '<table border="1">';
                echo '<thead style="background-color:#393b39;color:white;">';
                echo '<tr>';
                echo '<th>No.</th>';
                echo '<th>Name of Student (Alphabetical Order)</th>';
                echo '<th>Student No.</th>';
                echo '<th>Midterm</th>';
                echo '<th>Final Term</th>';
                echo '<th>Final Grade/Remarks</th>';
                echo '</tr>';
                echo '</thead>';
                $skipRows = range(43, 66);


                for ($row = $startRow; $row <= $endRow; $row++, $num++) {
                    if (in_array($row, $skipRows)) {
                        continue;
                    }
                    $no = $worksheet->getCell('B' . $row)->getValue();
                    $name = $worksheet->getCell('C' . $row)->getValue();
                    $studentNumber = $worksheet->getCell('H' . $row)->getValue();
                    $midterm = $worksheet->getCell('I' . $row)->getValue();
                    $finalterm = $worksheet->getCell('K' . $row)->getValue();
                    $finalgrades = $worksheet->getCell('N' . $row)->getValue();

                    if (empty($no) && empty($name) && empty($studentNumber) && empty($midterm) && empty($finalterm) && empty($finalgrades)) {
                        break;
                    }


                    echo '<tr>';
                    echo "<td>$num</td>";
                    echo "<td>$name</td>";
                    echo "<td>$studentNumber</td>";
                    $subjectCodeKey = 'subjectCode' . $num;

                    echo "<td><input type='text' name='studentData[$studentNumber][$subjectCodeKey][midterm][]' value='$midterm'></td>";
                    echo "<td><input type='text' name='studentData[$studentNumber][$subjectCodeKey][finalterm][]' value='$finalterm'></td>";
                    echo "<td><input type='text' name='studentData[$studentNumber][$subjectCodeKey][finalgrades][]' value='$finalgrades'></td>";
                    echo '</tr>';
                    $num++;



                }

                echo '</table>';

                echo '<div >';
                echo '<button class="btn btn-success" style="position:relative" type="submit" name="action" value="save_data">Save</button>';
                echo '</div>';
                echo '</form>';
            }
        }



        function updateDatabase($con, $tableName, $mtColumn, $ftColumn, $fgColumn, $midterm, $finalterm, $finalgrades, $studentNumber)
        {
            // Check if all columns are null
            if ($mtColumn === null && $ftColumn === null && $fgColumn === null) {
                $_SESSION['message'] = "No columns to update for student $studentNumber.";
                $_SESSION['message'] = " $tableName.";

                return;
            }


            $updateQuery = "UPDATE $tableName SET ";
            $updateValues = array();

            if ($mtColumn !== null) {
                $updateQuery .= "$mtColumn = ?, ";
                $updateValues[] = $midterm;
            }

            if ($ftColumn !== null) {
                $updateQuery .= "$ftColumn = ?, ";
                $updateValues[] = $finalterm;
            }

            if ($fgColumn !== null) {
                $updateQuery .= "$fgColumn = ?, ";
                $updateValues[] = $finalgrades;
            }

            // Remove the trailing comma and space
            $updateQuery = rtrim($updateQuery, ', ');

            // Add the WHERE clause
            $updateQuery .= " WHERE sno = ?";

            // Prepare the statement
            $stmt = mysqli_prepare($con, $updateQuery);

            // Check if the statement is prepared successfully
            if ($stmt) {
                // Create an array of references for binding
                $params = array();
                $types = '';

                foreach ($updateValues as &$value) {
                    $params[] = &$value;
                    $types .= 's';
                }

                $params[] = &$studentNumber;
                $types .= 's';

                // Bind parameters
                mysqli_stmt_bind_param($stmt, $types, ...$params);

                // Execute the query
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    $_SESSION['message'] = "Data updated successfully.";
                } else {
                    $_SESSION['message'] = "Data update failed for student $studentNumber: " . mysqli_error($con);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['message'] = "Statement preparation error: " . mysqli_error($con);
            }
        }
        if (isset($_POST['action']) && $_POST['action'] === 'save_data') {
            // Check if course details are available in the session
            if (!isset($_SESSION['courseDetails'])) {
                echo "Course details not available. Please import an Excel file first.";
            } else {
                // Check if student data is set and is an array
                if (isset($_POST['studentData']) && is_array($_POST['studentData'])) {
                    // Loop through each student's data
                    foreach ($_POST['studentData'] as $studentNumber => $subjectData) {
                        // Get course details from the session
                        $excelYear = $_SESSION['courseDetails']['year'];
                        $excelSemester = $_SESSION['courseDetails']['semester'];
                        $subjectCode = $_SESSION['courseDetails']['subjectCode'];

                        // Query to retrieve table names
                        $query = "SELECT table_name FROM information_schema.columns 
                                  WHERE table_schema = 'uccevaluation' 
                                  AND (column_name = 'sy1' OR column_name = 'semester')";
                        $result = mysqli_query($con, $query);

                        if ($result) {
                            // Loop through the result to find the matching table
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tableName = $row['table_name'];

                                // Check if the table for the given year and semester exists
                                $checkQuery = "SELECT * FROM $tableName WHERE sy1 = '$excelYear' AND semester = '$excelSemester'";
                                $checkResult = mysqli_query($con, $checkQuery);

                                if ($checkResult && mysqli_num_rows($checkResult) > 0) {


                                    break;
                                }
                            }

                            // If no matching table is found
                            if (empty($tableName)) {
                                echo "No matching table found";
                            } else {
                                // Loop through each subject data for the student
                                foreach ($subjectData as $subjectCodeKey => $data) {
                                    $mtColumn = $ftColumn = $fgColumn = null;

                                    // Query to retrieve column names for the given table
                                    $query = "SELECT column_name FROM information_schema.columns 
                                                WHERE table_schema = 'uccevaluation' AND table_name = '$tableName'";
                                    $result = mysqli_query($con, $query);

                                    if ($result) {
                                        // Loop through the result to find the matching column for the subject code
                                        $foundColumn = false;

                                        $foundColumn = false;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $columnName = $row['column_name'];

                                            // Check if the column for the given subjectCode exists in the table for the specific studentNumber
                                            $checkQuery = "SELECT $columnName FROM $tableName WHERE sy1 = '$excelYear' AND semester = '$excelSemester' AND $columnName = '$subjectCode' AND sno = '$studentNumber'";
                                            $checkResult = mysqli_query($con, $checkQuery);

                                            if ($checkResult && mysqli_num_rows($checkResult) > 0) {


                                                // Set columns based on the found column
                                                $mtColumn = 'mt' . substr($columnName, -1);
                                                $ftColumn = 'ft' . substr($columnName, -1);
                                                $fgColumn = 'fg' . substr($columnName, -1);

                                                $foundColumn = true;
                                                break;
                                            }
                                        }

                                        // Check if no matching column is found
                                        if (!$foundColumn) {
                                            echo "No matching column found for Subject Code $subjectCode and Student Number $studentNumber";
                                            // You can handle this situation accordingly, e.g., set default values or skip the current subjectCode for the current student
                                        }
                                        // Get midterm, final term, and final grades from the data
                                        $midterm = isset($data['midterm'][0]) ? $data['midterm'][0] : null;
                                        $finalterm = isset($data['finalterm'][0]) ? $data['finalterm'][0] : null;
                                        $finalgrades = isset($data['finalgrades'][0]) ? $data['finalgrades'][0] : null;

                                        // Check if all required values are present
                                        if (!empty($midterm) && !empty($finalterm) && !empty($finalgrades)) {
                                            // Update the database with the student's data
                                            updateDatabase($con, $tableName, $mtColumn, $ftColumn, $fgColumn, $midterm, $finalterm, $finalgrades, $studentNumber);
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "Query failed: " . mysqli_error($con);
                        }
                    }
                }
            }
        }



        // Your existing code for closing the database connection and displaying the HTML footer
        mysqli_close($con);
        ?>
        <!--Script-->
        <script src="../../js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../../s/bootstrap.min.js"></script>
        <script src="../../js/wow.min.js"></script>
        <script src="../../js/jquery-price-slider.js"></script>
        <script src="../../js/owl.carousel.min.js"></script>
        <script src="../../js/jquery.scrollUp.min.js"></script>
        <script src="../../js/meanmenu/jquery.meanmenu.js"></script>
        <script src="../../js/counterup/jquery.counterup.min.js"></script>
        <script src="../../js/counterup/waypoints.min.js"></script>
        <script src="../../js/counterup/counterup-active.js"></script>
        <script src="../../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../../js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../../js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../../js/jvectormap/jvectormap-active.js"></script>
        <script src="../../js/sparkline/jquery.sparkline.min.js"></script>
        <script src="../../js/sparkline/sparkline-active.js"></script>
        <script src="../../js/flot/jquery.flot.js"></script>
        <script src="../../js/flot/jquery.flot.resize.js"></script>
        <script src="../../s/flot/jquery.flot.pie.js"></script>
        <script src="../../js/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../../js/flot/jquery.flot.orderBars.js"></script>
        <script src="../../js/flot/curvedLines.js"></script>
        <script src="../../js/flot/flot-active.js"></script>
        <script src="../../js/knob/jquery.knob.js"></script>
        <script src="../../js/knob/jquery.appear.js"></script>
        <script src="../../js/knob/knob-active.js"></script>
        <script src="../../s/wave/waves.min.js"></script>
        <script src="../../js/wave/wave-active.js"></script>
        <script src="../../js/todo/jquery.todo.js"></script>
        <script src="../../js/plugins.js"></script>
        <script src="../../js/main.js"></script>
</body>

</html>