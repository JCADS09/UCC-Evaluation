<!DOCTYPE html>
<html lang="en">
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

mysqli_free_result($result);

mysqli_close($con);
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <title>Candidates</title>
    <link rel="shortcut icon" type="image/x-icon" href="../system-img/check.png">

        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/owl.carousel.css">
        <link rel="stylesheet" href="../css/owl.transitions.css">
        <link rel="stylesheet" href="../css/animate.css">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/scrollbar/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="../css/jvectormap/jquery-jvectormap-2.0.3.css">
        <link rel="stylesheet" href="../css/notika-custom-icon.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/wave/waves.min.css">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../css/responsive.css">
        <link rel="stylesheet" href="../topbarcss/topbar.css">
        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
    <!--End Links--> 
   <style>
        .panel-container {
            width: 70%;
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

        table th, table td {
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


    </style>
</head>
<body>
    <!-- Start Header Top Area -->

    <div class="header-top-area" style="background-color: rgb(17, 112, 22);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="logo-area" style="display: flex; align-items: center;">
                                <img src="../system-img/check.png" width="45" height="45"> 
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
                    <li>
                        <a href="../registrarnav.php">
                            <img src="../system-img/home.png" width="28" height="27"> Dashboard
                        </a>
                    </li>

                    <li class="tab">
                        <a href="importing/code.php">
                            <img src="../system-img/import.png" width="22" height="22"> Import Grades
                        </a>
                    </li>

                    <li class="tab">
                        <a href="evaluator-page/scholastic/students.php">
                            <img src="../system-img/pencil.png" width="25" height="25"> Evaluate Students
                        </a>
                    </li>

                    <!-- <li class="tab">
                        <a href="registrar-page/evaluate/gradingsheet.php">
                            <img src="system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                        </a>
                    </li> -->

                    <li class="tab">
                        <a href="candidates.php"  style="background-color:#ff8e1c;color:white;">
                            <img src="../system-img/trophy.png" width="25" height="25"> Candidates
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

    


<?php
include 'importing/db.php';
$query = "SELECT sno, CONCAT(sname, ', ', fname, ' ', mname) AS Name, course, year1 AS year, section AS section, status1 AS status FROM 202220231stsemcongress	 WHERE year1 = 4";
$result = mysqli_query($con, $query);
?>
    <div class="panel-container">
    <center><h1> UNIVERSITY OF CALOOCAN CITY CANDIDATES </h1> </center>
        <div class="dropdown">
            <label for="department">College Department:</label>
                <select id="branch" name="branch" onchange="populateCourses()">
                <option value="department" selected disabled>Select College Department</option>
                    <?php echo $options; ?>
                </select>
        </div>

        <div class="dropdown">
            <label for="course">Course:</label>
                <select name="course" id="courseDropdown" onchange="displayStudents()">
                <option value="course" selected disabled>Please select College Department first</option>
                </select>
            </div>
                
        <div style="display: inline-block;">
            <label for="display">Select here what do you want to display:&nbsp&nbsp&nbsp</label>
            <select id="display" name="display" style="width: 150px;">
            <option value="" selected disabled>---- Select Here ----</option>
                <option value="latin">Latin Honor</option>
                <option value="dean">Dean Lister</option>
                <option value="def">Deficiency</option>
            </select>
        </div>

        <div style="display: inline-block; margin-left: 20px;">
            <label for="year">Year:&nbsp&nbsp&nbsp</label>
            <select id="year" name="year" style="width: 80px;">
            <option value="" selected disabled>Year</option>
                <option value="1">1ST</option>
                <option value="2">2ND</option>
                <option value="3">3RD</option>
                <option value="4">4TH</option>
            </select>
        </div>

        <div style="display: inline-block; margin-left: 20px;">
            <label for="sec">Section:&nbsp&nbsp&nbsp</label>
            <select id="sec" name="sec" style="width: 69px;">
            <option value="" selected disabled>Sec</option>
                <option value="">A</option>
                <option value="">B</option>
                <option value="">C</option>
                <option value="">D</option>
            </select>
        </div>


            <div>
                
            </div>
    <br>

        <table id="students" class="display">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Student No</th>
                    <th>Name of the Student</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Section</th>
                    <th>Rank</th>
                    <th>GWA</th>
                </tr>
            </thead>
            <tbody id="studentsBody">
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
                    echo '<td>' . "Cum Laude" . '</td>';
                    echo '<td>' . "1.35" . '</td>';
                    echo '</tr>';
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!--Script-->
    <script src="../js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery-price-slider.js"></script>
    <script src="../js/jquery.scrollUp.min.js"></script>
    <script src="../js/meanmenu/jquery.meanmenu.js"></script>
    <script src="../js/counterup/jquery.counterup.min.js"></script>
    <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../js/sparkline/jquery.sparkline.min.js"></script>
    <script src="../js/flot/jquery.flot.js"></script>
    <script src="../js/flot/jquery.flot.resize.js"></script>
    <script src="../js/flot/jquery.flot.pie.js"></script>
    <script src="../js/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/flot/jquery.flot.orderBars.js"></script>
    <script src="../js/knob/jquery.knob.js"></script>
    <script src="../js/knob/jquery.appear.js"></script>
    <script src="../js/todo/jquery.todo.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/counterup/waypoints.min.js"></script>
    <script src="../js/counterup/counterup-active.js"></script>
    <script src="../js/jvectormap/jvectormap-active.js"></script> 
    <script src="../js/sparkline/sparkline-active.js"></script>
    <script src="../js/flot/curvedLines.js"></script>
    <script src="../js/flot/flot-active.js"></script>
    <script src="../js/knob/knob-active.js"></script>
    <script src="../js/wave/waves.min.js"></script>
    <script src="../js/wave/wave-active.js"></script>
    <script src="../js/plugins.js"></script>
    <script src="../js/main.js"></script>

      <script>
        function populateCourses() {
    var selectedDepartment = document.getElementById("branch").value;

    // Fetch courses based on the selected department
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var courses = JSON.parse(this.responseText);

                var courseDropdown = document.getElementById("courseDropdown");
                courseDropdown.innerHTML = "<option value='' selected disabled>Please select Course</option>"; // Add a default option

                for (var i = 0; i < courses.length; i++) {
                    var option = document.createElement("option");
                    option.value = courses[i].course;
                    option.text = courses[i].course + ' (' + courses[i].acronym + ')';
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
// function displayStudents() {
//         var selectedDepartment = document.getElementById("branch").value;
//         var selectedCourse = document.getElementById("courseDropdown").value;
//         var selectedDisplay = document.getElementById("display").value;
//         var selectedYear = document.getElementById("year").value;
//         var selectedSection = document.getElementById("sec").value;

//         // You can modify this URL according to your server-side script handling the filtering
//         var url = "get_students.php?department=" + selectedDepartment + "&course=" + selectedCourse;

//         // Use AJAX to fetch filtered student data
//         var xhttp = new XMLHttpRequest();
//         xhttp.onreadystatechange = function () {
//             if (this.readyState == 4 && this.status == 200) {
//                 var studentsBody = document.getElementById("studentsBody");
//                 studentsBody.innerHTML = this.responseText;
//             }
//         };
//         xhttp.open("GET", url, true);
//         xhttp.send();
//     }
</script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {
    var table = $('#students').DataTable({
        "lengthMenu": [20,50,100],
        "paging": true,
        "info": true,
        "searching": true,
        responsive: true,
    });
});

</script>

</body>
</html>


