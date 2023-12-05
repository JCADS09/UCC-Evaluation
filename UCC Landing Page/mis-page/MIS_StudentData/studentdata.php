<?php
require_once('db.php');
session_start();
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}
$result = mysqli_query($con, "SELECT DISTINCT campus_name FROM campus");
if (!$result) {
    die("Query Error: " . mysqli_error($con));
}


$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $campus = $row['campus_name'];
    $options .= "<option value='$campus'>$campus</option>";
}

// // Check if the form is submitted
// if (isset($_POST['displayTable'])) {
//     $selected_table = $_POST['tableSelect'];
//     $_SESSION['table_name'] = $selected_table;
// }

// $result = null;

// if (isset($_SESSION['table_name'])) {
//     $table_name = $_SESSION['table_name'];

//     $table_name = preg_replace('/[^a-zA-Z0-9_]/', '_', $table_name, -1);
//     $table_name = substr($table_name, 0, 64);

//     $table_exists_query = "SHOW TABLES LIKE '$table_name'";
//     $table_exists_result = mysqli_query($con, $table_exists_query);

//     if (mysqli_num_rows($table_exists_result) == 1) {

//         $exclude_tables = ['campus', 'campuslist', 'courses', 'courselist', 'cdept', 'login'];
//         $show_tables_query = "SHOW TABLES FROM `uccevaluation`";

//         try {
//             $show_tables_result = mysqli_query($con, $show_tables_query);

//             if (!$show_tables_result) {
//                 throw new Exception("Query failed: " . mysqli_error($con));
//             }

//             // echo '<form method="post" action="">';
//             // echo '<select name="tableSelect">';
//             // while ($row = mysqli_fetch_row($show_tables_result)) {
//             //     $table = $row[0];
//             //     if (!in_array($table, $exclude_tables)) {
//             //         $selected = ($table === $table_name) ? 'selected' : '';
//             //         echo '<option value="' . $table . '" ' . $selected . '>' . $table . '</option>';
//             //     }
//             // }
//             // echo '</select>';
//             // echo '<input type="submit" name="displayTable" value="Display Table">';
//             // echo '</form>';

//         } catch (Exception $e) {
//             echo "Error: " . $e->getMessage();
//             // Handle the exception gracefully, for example, redirect or display an error message.
//         }
//     }
// }
?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Enrolled Students</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../system-img/check.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/owl.carousel.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <script>
        function numOnly(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode;
            if (keyCode < 48 || keyCode > 57) {
                evt.preventDefault();
            }
        }
        function lettersOnly(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode;

            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && keyCode !== 32) {
                evt.preventDefault();
            }
        }
        function upperCase(input) {
            input.value = input.value.toUpperCase();
        }
        function year(inputField) {
            inputField.value = inputField.value.substring(0, 4);
        }
        function oneDigit(input) {
            input.value = input.value.replace(/\D/g, '');

            if (input.value.length > 1) {
                input.value = input.value.charAt(0);
            }
        }
    </script>

    <style>
        .panel-container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            background-color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial;
            font-size: 13px;
            padding:10
        
        }

        table th,
        table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        table thead {
            background-color: #f2f2f2;
        }

        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tbody tr:hover {
            background-color: #ddd;
        }

        .dropdown {
            margin-bottom: 10px;
        }

        .label {
            display: block;
            margin-bottom: 5px;
            font-size: 20px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .cancel {
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            border: none;
            margin-left: 8.5%;
            width: 13%;
            background-color: green;
        }

        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <!-- Start Header Top Area -->

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

    <!-- End Header Top Area -->

    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li><a href="../../misnav.php"><img src="../../system-img/home.png" width="28" height="27"></i>
                                Dashboard</a>
                        </li>
                        <li>
                            <a href="studentdata.php" style="background-color:#ff8e1c;color:white;"><img
                                    src="../../system-img/student.png" width="25" height="25"> Students</a>
                        </li>
                        <li><a data-toggle="tab" href="#M-Accounts"><img src="../../system-img/settings.png" width="22"
                                    height="22"></i> Accounts</a>
                        </li>
                        <li><a data-toggle="tab" href="#M-campus"><img src="../../system-img/campus.png" width="34"
                                    height="25"></i> Campus</a>
                        </li>
                        <!-- <li>
                            <a href="../../schedule/index.php">
                                <img src="../../system-img/calendar-335.png" width="19" height="19"> Calendar of Events
                            </a>
                        </li> -->
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="M-Accounts" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="request.php">Request</a>
                                </li>
                                <li><a href="users.php">Users</a>
                                </li>
                            </ul>
                        </div>
                        <div id="M-campus" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="mis-page/addcampus.php">Add Campus</a>
                                </li>
                                <li><a href="mis-page/managecampus.php">Manage Campus</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Main Menu area End-->

    <div class="panel-container">

        <br>
        <center>
            <h1> UCC STUDENTS' DATA </h1>
        </center>
        <div class="row">
            <div class="col-md-12 mt-4">
                <?php
                if (isset($_SESSION['message'])) {
                    echo "<h4>" . $_SESSION['message'] . "</h4>";
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row p-t-20" style="margin-left:5%;">
                            <div class="col-md-10">
                                <div class="input-file">
                                    <input type="file" name="import_file" class="form-control" />
                                </div>
                            </div>
                            <div style="margin-top:3px;">
                                <div class="btn-import">
                                    <button type="submit" name="save_excel_data" class="btn btn-primary"
                                        style="background-color:#077504;border:none;">Import</button>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
                <div>
                    <a href="../addstudent.php"><label class="cancel">Add New Student</label></a>
                </div>

                <!-- TO DISPLAY TABLE -->

                <form method="POST" action="" class="table-select-form">
                    <div class="dropdown">
                        <div class="row p-t-20" style="margin-left:7%;">
                            <div class="col-md-3">
                                <label><b>A.Y.:&nbsp</b></label>
                                <input type="text" style="width:30%;" name="sy1" placeholder="From" autocomplete="off"
                                    oninput="year(this)" onkeypress="numOnly(event)">
                                <label><b>&nbsp&nbsp&nbsp- &nbsp&nbsp&nbsp</b></label>
                                <input type="text" style="width:30%;" name="sy2" placeholder="To" autocomplete="off"
                                    oninput="year(this)" onkeypress="numOnly(event)">
                            </div>

                            <div class="col-md-3">
                                <label><b>Semester:&nbsp</b></label>
                                <select id="semester" name="semester" style="width:40%;">
                                    <option value="" selected disabled>-Select-</option>
                                    <option value="1ST">1ST</option>
                                    <option value="2ND">2ND</option>
                                </select>
                            </div>
                            <div>
                                <b><label> Campus:&nbsp</label></b>
                                <select name="campus_name" style="width:73%;"
                                    onchange="updateSelectedCampus(this.value)">
                                    <option value="" selected disabled>- Please select campus-</option>
                                    <?php
                                    // Fetch campus names from the database
                                    $campus_query = "SELECT campus_name FROM campus";
                                    $campus_result = mysqli_query($con, $campus_query);

                                    while ($row = mysqli_fetch_assoc($campus_result)) {
                                        $campus = $row['campus_name'];
                                        echo "<option value='$campus'>$campus</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div style="margin-left:3%;">
                                <button type="submit" name="displayTable" class="btn btn-success" style="background-color:#6e6e6e;border-color:#6e6e6e;">Show Data</button>
                            </div>
                        </div>
                </form>
            </div>


            <br>
            <?php
            include 'db.php';

            // Check if the form is submitted
            if (isset($_POST['displayTable'])) {
                // Check if the required keys are set in $_POST
                if (
                    isset($_POST['semester']) &&
                    isset($_POST['sy1']) &&
                    isset($_POST['sy2']) &&
                    isset($_POST['campus_name'])
                ) {
                    $semester = $_POST['semester'];
                    $sy1 = $_POST['sy1'];
                    $sy2 = $_POST['sy2'];

                    // Sanitize and validate the input to prevent SQL injection
                    $selectedCampus = mysqli_real_escape_string($con, $_POST['campus_name']);

                    // Build the dynamic table name
                    $tableName1 = $sy1 . $sy2 . $semester . "sem" . $selectedCampus;

                    // Build the SQL query with dynamic table name
                    $query = "SELECT sno, CONCAT(sname, ', ', fname, ' ', mname) AS Name, course, year1 AS year, section AS section, status1 AS status 
              FROM $tableName1";

                    // Execute the query
                    $result = mysqli_query($con, $query);

                    // Check for errors
                    if (!$result) {
                        die("Error in SQL query: " . mysqli_error($con));
                    }
                } else {
                    // Handle the case when form data is incomplete or not set
                    echo "<center><h4>Data not found.<h4></center>";
                }
            }
            ?>
            <table id="students" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Student No</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Section</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        $count = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['sno'] . '</td>';
                            echo '<td>' . $row['Name'] . '</td>';
                            echo '<td>' . $row['course'] . '</td>';
                            echo '<td>' . $row['year'] . '</td>';
                            echo '<td>' . $row['section'] . '</td>';
                            echo '<td>' . $row['status'] . '</td>';
                            echo '</tr>';
                            $count++;
                        }
                    }
                    ?>
                </tbody>
            </table>
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


        <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#students').DataTable({
                    "lengthMenu": [20, 50, 100],
                    "paging": true,
                    "info": true,
                    "searching": true,
                    responsive: true,
                });
            });
        </script>

</body>

</html>