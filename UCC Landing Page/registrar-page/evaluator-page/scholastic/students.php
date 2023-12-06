<!DOCTYPE html>
<html lang="EN">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Assuming you have established a database connection
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

// Fetch cdepartment values from the cdept table
$result = mysqli_query($con, "SELECT DISTINCT cdepartment FROM cdept");
if (!$result) {
    die("Query Error: " . mysqli_error($con));
}

$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $cdepartment = $row['cdepartment'];
    $options .= "<option value='$cdepartment'>$cdepartment</option>";
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Evaluate</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../system-img/check.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="../../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../css/owl.carousel.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/owl.transitions.css">
    <link rel="stylesheet" href="../../../css/animate.css">
    <link rel="stylesheet" href="../../../css/normalize.css">
    <link rel="stylesheet" href="../../../css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../../../css/jvectormap/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="../../../css/notika-custom-icon.css">
    <link rel="stylesheet" href="../../../css/main.css">
    <link rel="stylesheet" href="../../../css/wave/waves.min.css">
    <link rel="stylesheet" href="../../../style.css">
    <link rel="stylesheet" href="../../../css/responsive.css">
    <link rel="stylesheet" href="../../../topbarcss/topbar.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>

    
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


    <!--End Links-->
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

        .btnView {
            display: inline-block;
            padding: 10px 20px;
            background-color: #099c02;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btnView:hover {
            background-color: #0f9136;
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

        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
        padding: 10px;
        background-color: green;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="button"] {
        padding: 8px;
        background-color: green;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
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
                        <img src="../../../system-img/check.png" width="45" height="45">
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
                        <li>
                            <a href="../../../registrarnav.php">
                                <img src="../../../system-img/home.png" width="28" height="27"> Dashboard
                            </a>
                        </li>

                        <li class="tab">
                            <a href="../../importing/code.php">
                                <img src="../../../system-img/import.png" width="22" height="22"> Import Grades
                            </a>
                        </li>

                        <li class="tab">
                            <a href="students.php" style="background-color:#ff8e1c;color:white;">
                                <img src="../../../system-img/pencil.png" width="25" height="25"> Evaluate Students
                            </a>
                        </li>

                        <!-- <li class="tab">
                        <a href="registrar-page/evaluate/gradingsheet.php">
                            <img src="system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                        </a>
                    </li> -->

                        <li class="tab">
                            <a href="../../candidates.php">
                                <img src="../../../system-img/trophy.png" width="25" height="25"> Candidates
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu area End-->

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
    <div class="panel-container">
        <center>
            <h1> UCC STUDENT LIST</h1>
        </center>
        <label style="margin-left:8.2%">To display enrolled students:</label>
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
                                <select name="campus_name" style="width:20%;"
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


                                <button type="submit" name="displayTable" class="btn btn-success"
                                    style="background-color:#6e6e6e;border-color:#6e6e6e;">Show Data</button>
                            </div>
                        </div>
                </form>
                <hr style="border: 1px solid #ccc;"><br>
        <div class="dropdown">
            <label for="department">College Department:</label>
            <select id="branch" name="branch" onchange="populateCourses()">
                <option value="" selected disabled>Select College Department</option>
                <?php echo $options; ?>
            </select>
        </div>

        <div class="dropdown">
            <label for="course">Course:</label>
            <select name="course" id="courseDropdown" onchange="displayStudents()">
                <option value="" selected disabled>Please select College Department first</option>
            </select>
        </div>

        <div style="display: inline-block; margin-left: 0;">
            <label for="year">Year:&nbsp&nbsp&nbsp</label>
            <select id="year" name="year" style="width: 80px;" onchange="filterTable()">
                <option value="" selected disabled>Year</option>
                <option value="1ST">1ST</option>
                <option value="2ND">2ND</option>
                <option value="3RD">3RD</option>
                <option value="4TH">4TH</option>
            </select>
        </div>

        <div style="display: inline-block; margin-left: 20px;">
            <label>Section:&nbsp&nbsp&nbsp</label>
            <select id="sec" name="sec" style="width: 69px;" onchange="filterTable()">
                <option value="" selected disabled>Sec</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
        </div>


        <div>
                            
            <br>
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
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
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
                        $tableName1 = urlencode($sy1.$sy2.$semester."sem".$selectedCampus);
                        echo '<td><center><a class="btnView" href="../gradingsheet.php?id='.$row['sno'].'&table='.$tableName1.'"> Summary</a></center></td>';
                        echo '<td><center><a class="btnView" href="../scholastic.php?id='.$row['sno'].'&table='.$tableName1.'"> Scholastic</a></center></td>';

                        echo '</tr>';
                        $count++;
                    }
                    // </a>&nbsp&nbsp&nbsp&nbsp<a class="btnView" href="scholastic.php?id=' . $row['sno'] . '"> Scholastic 
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



        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


        <script>
            var table;

            $(document).ready(function () {
                table = $('#students').DataTable({
                    "lengthMenu": [20, 50, 100],
                    "paging": true,
                    "info": true,
                    responsive: true,
                });
            });

            function populateCourses() {
                var selectedDepartment = document.getElementById("branch").value;

                // Fetch courses based on the selected department
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            var courses = JSON.parse(this.responseText);

                            var courseDropdown = document.getElementById("courseDropdown");
                            courseDropdown.innerHTML = "<option value='' selected disabled>Please select Course</option>";

                            for (var i = 0; i < courses.length; i++) {
                                var option = document.createElement("option");
                                option.value = courses[i].course; // Use the course code as the value
                                option.text = courses[i].course + ' (' + courses[i].acronym + ')'; // Display the course code and acronym
                                option.setAttribute('data-acronym', courses[i].acronym); // Store the acronym in a data attribute
                                courseDropdown.appendChild(option);
                            }

                        } else {
                            console.error("Error fetching courses:", this.status, this.statusText);
                        }
                    }
                };

                xhttp.open("GET", "get_courses.php?department=" + selectedDepartment, true);
                xhttp.send();
            }

            function displayStudents() {
                // Get selected values from dropdowns
                var selectedCourse = $("#courseDropdown option:selected").text();

                // Get the DataTable instance
                var table = $('#students').DataTable();

                // Clear existing filters including global search
                table.search('').columns().search('').draw();

                // Extract text inside parentheses
                var courseInParentheses = selectedCourse.match(/\(([^)]+)\)/);

                if (courseInParentheses) {
                    courseInParentheses = courseInParentheses[1];

                    // Apply new filters for course
                    if (courseInParentheses !== null && courseInParentheses !== "") {
                        // Use the DataTable API for global search
                        table.search(courseInParentheses).draw();

                        // Log table data after applying course filter
                        var tableData = table.data().toArray();
                        console.log("Table Data After Course Filter:");
                        tableData.forEach(function (row, index) {
                            console.log("Row " + (index + 1) + ":", row);
                        });
                    }
                } else {
                    console.log("Table has no data.");
                }
            }
            function filterTable() {
                var yearFilter = document.getElementById("year").value;
                var secFilter = document.getElementById("sec").value;
                var table = document.getElementById("students");
                var rows = table.getElementsByTagName("tr");

                for (var i = 1; i < rows.length; i++) {
                    var cells = rows[i].getElementsByTagName("td");
                    var year = cells[4].innerText;
                    var sec = cells[5].innerText;

                    if ((yearFilter === "" || year === yearFilter) &&
                        (secFilter === "" || sec === secFilter)) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
        </script>
</body>

</html>