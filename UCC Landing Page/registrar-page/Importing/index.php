
<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
require_once('config/db.php');
$query = "select * from students";
$result = mysqli_query($con, $query);
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$con = mysqli_connect('localhost', 'root', '', 'evaluation');

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
$num = 1;

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
        echo "Course Name: " . $_SESSION['courseDetails']['courseName'] . "<br>";
        echo "Year: " . $_SESSION['courseDetails']['year'] . "<br>";
        echo "Semester: " . $_SESSION['courseDetails']['semester'] . "<br>";
        echo "Subject Code: " . $_SESSION['courseDetails']['subjectCode'] . "<br>";
        echo "Subject Description: " . $_SESSION['courseDetails']['subjectDescription'] . "<br>";
        echo "Units: " . $_SESSION['courseDetails']['units'] . "<br>";

        $startRow = 13;
        $endRow = $worksheet->getHighestRow();

        echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>No.</th>';
        echo '<th>Name of Student (Alphabetical Order)</th>';
        echo '<th>Student No.</th>';
        echo '<th>Midterm</th>';
        echo '<th>Final Term</th>';
        echo '<th>Final Grade/Remarks</th>';
        echo '</tr>';
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

            // Generate a dynamic subject code key (e.g., 'subjectCode1', 'subjectCode2', etc.)
            $subjectCodeKey = 'subjectCode' . $num;

            echo "<td><input type='text' name='studentData[$studentNumber][$subjectCodeKey][midterm][]' value='$midterm'></td>";
            echo "<td><input type='text' name='studentData[$studentNumber][$subjectCodeKey][finalterm][]' value='$finalterm'></td>";
            echo "<td><input type='text' name='studentData[$studentNumber][$subjectCodeKey][finalgrades][]' value='$finalgrades'></td>";
            echo '</tr>';
            $num++;
        }
        echo '</table>';
        echo '<button type="submit" name="action" value="save_data">Save</button>';
        echo '</form>';
    }
}
// Initialize $resultColumn before the loop
$resultColumn = '';
$i=0;
if (isset($_POST['action']) && $_POST['action'] === 'save_data') {
    if (!isset($_SESSION['courseDetails'])) {
        echo "Course details not available. Please import an Excel file first.";
    } else {
        // Check if studentData is set in the POST data
        if (isset($_POST['studentData']) && is_array($_POST['studentData'])) {
            // Prepare and execute the UPDATE queries for each student
            foreach ($_POST['studentData'] as $studentNumber => $subjectData) {
                foreach ($subjectData as $subjectCodeKey => $data) {
                    // Initialize $i before the loop
                    $foundMatch = false; // Flag to track if a match is found

                    for ($i = 1; $i <= 11; $i++) {
                        // Only proceed if a match hasn't been found yet
                        if (!$foundMatch) {
                            $mtColumn = 0;
                            $ftColumn = 0;
                            $fgColumn = 0;

                            if (isset($_SESSION['courseDetails']['subjectCode'])) {
                                $subjectCode = $_SESSION['courseDetails']['subjectCode'];

                                // Sample value to match against scode1 to scode11
                                $sampleValue = $subjectCode;

                                // Initialize $resultColumn
                                $resultColumn = '';

                                // Loop through scode1 to scode11
                                $scodeColumn = "scode$i";

                                // Query to check if the sample value matches the value in the current scode column
                                $query = "SELECT COUNT(*) FROM students WHERE $scodeColumn = ?";

                                $stmt = mysqli_prepare($con, $query);

                                if ($stmt) {
                                    mysqli_stmt_bind_param($stmt, 's', $sampleValue);
                                    mysqli_stmt_execute($stmt);

                                    // Bind the result variable (COUNT(*) result)
                                    mysqli_stmt_bind_result($stmt, $count);

                                    // Fetch the result
                                    mysqli_stmt_fetch($stmt);

                                    // Check if a match is found in the current scode column
                                    if ($count > 0) {
                                        $resultColumn = $scodeColumn;
                                        $foundMatch = true; // Set the flag to true since we found a match
                                    }

                                    mysqli_stmt_close($stmt); // Close and free the result
                                } else {
                                    echo "Query preparation error: " . mysqli_error($con);
                                }

                                // Now, $resultColumn should contain the name of the matching column (e.g., scode1, scode2, etc.)
                                if (!empty($resultColumn)) {
                                    switch ($resultColumn) {
                                        case 'scode1':
                                            $mtColumn = 1;
                                            $ftColumn = 1;
                                            $fgColumn = 1;
                                            break;
                                        case 'scode2':
                                            $mtColumn = 2;
                                            $ftColumn = 2;
                                            $fgColumn = 2;
                                            break;
                                        case 'scode3':
                                            $mtColumn = 3;
                                            $ftColumn = 3;
                                            $fgColumn = 3;
                                            break;
                                        case 'scode4':
                                            $mtColumn = 4;
                                            $ftColumn = 4;
                                            $fgColumn = 4;
                                            break;
                                        case 'scode5':
                                            $mtColumn = 5;
                                            $ftColumn = 5;
                                            $fgColumn = 5;
                                            break;
                                        case 'scode6':
                                            $mtColumn = 6;
                                            $ftColumn = 6;
                                            $fgColumn = 6;
                                            break;    
                                        case 'scode7':
                                            $mtColumn = 7;
                                            $ftColumn = 7;
                                            $fgColumn = 7;
                                            break;
                                        case 'scode8':
                                            $mtColumn = 8;
                                            $ftColumn = 8;
                                            $fgColumn = 8;
                                            break;
                                        case 'scode9':
                                            $mtColumn = 9;
                                            $ftColumn = 9;
                                            $fgColumn = 9;
                                            break;
                                        case 'scode10':
                                            $mtColumn = 10;
                                            $ftColumn = 10;
                                            $fgColumn = 10;
                                            break;
                                        case 'scode11':
                                            $mtColumn = 11;
                                            $ftColumn = 11;
                                            $fgColumn = 11;
                                            break;

                                        default:
                                            // Handle the default case here
                                            break;
                                    }
                                } else {
                                    echo "No matching column found for the sample value.";
                                }

                                $midterm = isset($_POST['studentData'][$studentNumber][$subjectCodeKey]['midterm'][$i-$mtColumn]) ? $_POST['studentData'][$studentNumber][$subjectCodeKey]['midterm'][$i- $mtColumn] : null;
                                $finalterm = isset($_POST['studentData'][$studentNumber][$subjectCodeKey]['finalterm'][$i-$ftColumn]) ? $_POST['studentData'][$studentNumber][$subjectCodeKey]['finalterm'][$i-$ftColumn] : null;
                                $finalgrades = isset($_POST['studentData'][$studentNumber][$subjectCodeKey]['finalgrades'][$i-$fgColumn]) ? $_POST['studentData'][$studentNumber][$subjectCodeKey]['finalgrades'][$i-$fgColumn] : null;
                                   // Debugging 
                                echo "i result: $i <br>";
                                echo "sno: $studentNumber <br>";
                                echo "Matching Column: $resultColumn <br>";
                                echo "Extracted Subject Code: $subjectCode <br>";
                                echo "Midterm: $midterm <br>";
                                echo "Final Term: $finalterm <br>";
                                echo "Final Grades: $finalgrades <br>";
                                echo "Midterm Column: $mtColumn <br>";
                                echo "Final Term Column: $ftColumn <br>";
                                echo "Final Grades Column: $fgColumn <br>";
                                // Check if the values are not empty before executing the update query
                                if (!empty($midterm) && !empty($finalterm) && !empty($finalgrades)) {
                                // ...

$updateQuery = "UPDATE students SET ";
$updateValues = array();

if ($mtColumn > 0) {
    $updateQuery .= "mt" . $mtColumn . " = ?, ";
    $updateValues[] = $midterm;
}

if ($ftColumn > 0) {
    $updateQuery .= "ft" . $ftColumn . " = ?, ";
    $updateValues[] = $finalterm;
}

if ($fgColumn > 0) {
    $updateQuery .= "fg" . $fgColumn . " = ?, ";
    $updateValues[] = $finalgrades;
}

// Remove the trailing comma and space
$updateQuery = rtrim($updateQuery, ', ');

// Add the WHERE clause
$updateQuery .= " WHERE sno = ?";

// Prepare the statement
$stmt = mysqli_prepare($con, $updateQuery);

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

    mysqli_stmt_close($stmt);
} else {
    $_SESSION['message'] = "Query preparation error: " . mysqli_error($con);
}

                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Students</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--Links-->
    <link rel="shortcut icon" type="image/x-icon" href="../../img/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
   
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/owl.carousel.css">
    <link rel="stylesheet" href="../../css/owl.transitions.css">
    <link rel="stylesheet" href="../../css/animate.css">
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="../../css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../../css/jvectormap/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="../../css/notika-custom-icon.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/wave/waves.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="stylesheet" href="../../topbarcss/topbar.css">
    <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
<!--End Links--> 

</head>
<body>
             <!-- Start Header Top Area -->

             <div class="header-top-area" style="background-color: rgb(17, 112, 22);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="logo-area" style="display: flex; align-items: center;">
                                <img src="../../system-img/check.png" width="45" height="45"> 
                                <span style="color: white; font-weight: bold; font-size: 24px; margin-left: 10px;">UCC EVALUATION</span>
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

        <!-- End Header Top Area -->

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
                        <a href="index.php">
                            <img src="../../system-img/import.png" width="22" height="22"> Import Grades
                        </a>
                    </li>

                    <li class="tab">
                        <a href="evaluatestudent.php">
                            <img src="../../system-img/pencil.png" width="25" height="25"> Evaluate Students
                        </a>
                    </li>

                    <li class="tab">
                        <a href="gradingsheet.php">
                            <img src="../../system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                        </a>
                    </li>

                    <li class="tab">
                        <a href="candidates.php">
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
    <!-- Main Menu area End-->

    <center><h1> importgrade page</h1> </center>
 <form>  
<div class = "container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <?php
                if (isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                ?>
                    <div class="card-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="input-file">
                            <label for="import_file"></label>
                                <input type="file" name="import_file" class="form-control" id="import_file" accept=".xls, .xlsx, .csv" />
                            </div>
                            
                            <div class="btn-import">
                                <button type="submit" name="submit_excel" class="btn btn-primary">Import</button>
                            </div>
                      
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search data">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                     <div>     
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="display-6 text-center"> List of Students </h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                        <tr class="bg-warning text-black">
                                <td> No. </td>
                                <td> Name </td>
                                <td> Student No. </td>
                                <td> Sex </td>
                                <td> Course </td>
                                <td> Year  </td>
                                <td> Section </td>
                                <td> Status </td>
                                <td> Semester </td>
                                <td> From </td>
                                <td> To </td>
                                <td> Action </td>
                            </tr>
                            <tr>
                            <?php
                                $i=1;
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                ?>
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row['sname']. ', '.$row['fname']. ' '.$row['mname']; ?></td>
                                <td><?php echo $row['sno']; ?></td>
                                <td><?php echo $row['sex']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['year1']; ?></td>
                                <td><?php echo $row['section']; ?></td>
                                <td><?php echo $row['status1']; ?></td>
                                <td><?php echo $row['semester']; ?></td>
                                <td><?php echo $row['sy1']; ?></td>
                                <td><?php echo $row['sy2']; ?></td>
                                <td><center><a class="btn btn-secondary" href="../Evaluation_Trial/evaluator.php?id=<?php echo $row['sno'] ?>"> View Records </a></center></td>
                            </tr>
                            <?php
                                    }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div></form>
    </div>  
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
    <!--End Script-->
</body>
</html>