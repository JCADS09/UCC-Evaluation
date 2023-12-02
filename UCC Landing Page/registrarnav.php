<!--connection-->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uccevaluation";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$name = $_SESSION["name"];

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!--links-->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="css/jvectormap/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="css/notika-custom-icon.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/wave/waves.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="topbarcss/topbar.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    <!--End links-->  

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['', 'Total Student', 'Regular', 'Irregular'],
                <?php

                // Total count College of Liberal Arts and Sciences
                $totalQueryCLAS = "SELECT COUNT(course) AS total_bsclas FROM `202220232ndsemcongress` WHERE course IN ('BS-PSYCH', 'BS MATH', 'BSCS', 'BSIS', 'BSIT', 'BSEMC', 'BPA', 'BACOMM', 'AB-POLSCI')";
                $totalResultCLAS = mysqli_query($conn, $totalQueryCLAS);
                $totalDataCLAS = mysqli_fetch_array($totalResultCLAS);
                $total_bsclas = $totalDataCLAS['total_bsclas'];


                // Count where status1 = 'REGULAR'
                $regularQuery = "SELECT COUNT(*) AS total_regular FROM `202220232ndsemcongress` WHERE course IN  ('BS-PSYCH', 'BS MATH', 'BSCS', 'BSIS', 'BSIT', 'BSEMC', 'BPA', 'BACOMM', 'AB-POLSCI') AND status1 = 'REGULAR'";
                $regularResult = mysqli_query($conn, $regularQuery);
                $regularData = mysqli_fetch_array($regularResult);
                $total_regular = $regularData['total_regular'];

                // Count where status1 = 'IRREGULAR'
                $irregularQuery = "SELECT COUNT(*) AS total_irregular FROM `202220232ndsemcongress` WHERE course IN ('BS-PSYCH', 'BS MATH', 'BSCS', 'BSIS', 'BSIT', 'BSEMC', 'BPA', 'BACOMM', 'AB-POLSCI') AND status1 = 'IRREGULAR'";
                $irregularResult = mysqli_query($conn, $irregularQuery);
                $irregularData = mysqli_fetch_array($irregularResult);
                $total_irregular = $irregularData['total_irregular'];

                // COLLEGE OF BUSINESS AND ACCOUNTANCY
                $totalQueryBA = "SELECT COUNT(course) AS total_ba FROM `202220232ndsemcongress` WHERE course IN ('BSHM', 'BSTM')";
                $totalResultBA = mysqli_query($conn, $totalQueryBA);
                $totalDataBA = mysqli_fetch_array($totalResultBA);
                $total_ba = $totalDataBA['total_ba'];


                // Count where status1 = 'REGULAR'
                $regularQueryBA = "SELECT COUNT(*) AS total_regularba FROM `202220232ndsemcongress` WHERE course IN  ('BSHM', 'BSTM') AND status1 = 'REGULAR'";
                $regularResultBA = mysqli_query($conn, $regularQueryBA);
                $regularDataBA = mysqli_fetch_array($regularResultBA);
                $total_regularba = $regularDataBA['total_regularba'];

                // Count where status1 = 'IRREGULAR'
                $irregularQueryBA = "SELECT COUNT(*) AS total_irregularba FROM `202220232ndsemcongress` WHERE course IN ('BSHM', 'BSTM') AND status1 = 'IRREGULAR'";
                $irregularResultBA = mysqli_query($conn, $irregularQueryBA);
                $irregularDataBA = mysqli_fetch_array($irregularResultBA);
                $total_irregularba = $irregularDataBA['total_irregularba'];


               
                ?>

                ['College of Liberal Arts and Sciences', <?php echo $total_bsclas; ?>, <?php echo $total_regular; ?>, <?php echo $total_irregular ?>],
                ['College of Business and Accountancy', <?php echo $total_ba; ?>, <?php echo $total_regularba; ?>, <?php echo $total_irregularba ?>],

             

            ]);

            var options = {
                chart: {
                    //title: 'Bachelor of Science in Information System',
                   // subtitle: 'up to 2023',
                },
                bars: 'vertical', // Required for Material Bar Charts.
                colors: ['#3366cc', '#109618', '#ff9900'] // Set custom colors: blue, green, yellow
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

</head>
<style>/* Style The Dropdown Button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
  left: 90%;
}
/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}</style>
<body>
    

   <!-- Start Header Top Area -->

             <div class="header-top-area" style="background-color: rgb(17, 112, 22);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <div class="logo-area" style="display: flex; align-items: center;">
                                <img src="system-img/check.png" width="45" height="45"> 
                                <span style="color: white; font-weight: bold; font-size: 24px; margin-left: 10px;">UCC EVALUATION</span>
                            </div>
                        </div>
                        <div class="dropdown">
                        <button class="dropbtn">
                            <?php echo $name; ?> &nbsp; ▼
                        </button>
                        <div class="dropdown-content">
                            <a href="">Notification</a>
                            <a id="top" href="#">Activity Log</a>
                            <a id="middle" href="#">Account Settings</a>
                            <a href="index.php" class="btn btn-primary">Logout</a>
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
                        <a href="registrarnav.php" style="background-color:#ff8e1c;color:white;">
                            <img src="system-img/home.png" width="28" height="27"> Dashboard
                        </a>
                    </li>

                    <li class="tab">
                        <a href="registrar-page/importing/code.php">
                            <img src="system-img/import.png" width="22" height="22"> Import Grades
                        </a>
                    </li>

                    <li class="tab">
                        <a href="registrar-page/evaluator-page/scholastic/students.php">
                            <img src="system-img/pencil.png" width="25" height="25"> Evaluate Students
                        </a>
                    </li>

                    <!-- <li class="tab">
                        <a href="registrar-page/evaluate/gradingsheet.php">
                            <img src="system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                        </a>
                    </li> -->

                    <li class="tab">
                        <a href="registrar-page/candidates.php">
                            <img src="system-img/trophy.png" width="25" height="25"> Candidates
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


   <!-- Start Status area -->
   <div class="notika-status-area">
        <div class="container">
            <div class="row">

            <?php
                function getTotalRowCount($conn, $table) {
                    $sql = "SELECT COUNT(*) as count FROM $table";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        return $row['count'];
                    } else {
                        return 0;
                    }
                }

                // Call the function to get the total row count
                $totalRows = getTotalRowCount($conn, "202220232ndsemcongress");
                ?>
                
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter"><?php echo $totalRows; ?></span></h2>
                            <p>Students</p>
                        </div>
                        <div class="sparkline-bar-stats1">9,4,8,6,5,6,4,8,3,5,9,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">0</span></h2>
                            <p>Dean's Lister</p>
                        </div>
                        <div class="sparkline-bar-stats2">1,4,8,3,5,6,4,8,3,3,9,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">0</span></h2>
                            <p>Defficiencies</p>
                        </div>
                        <div class="sparkline-bar-stats3">4,2,8,2,5,6,3,8,3,5,9,5</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">2</span></h2>
                            <p>Departments</p>
                        </div>
                        <div class="sparkline-bar-stats4">2,4,8,4,5,7,4,7,3,5,7,5</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Status area-->


   <!-- Start Sale Statistic area-->
   <div class="sale-statistic-area">
        <div class="container">
            <div class="row">

            <?php
                    function getRegularCount($conn, $table, $statusColumn, $statusValue) {
                        $sql = "SELECT COUNT(*) as count FROM $table WHERE $statusColumn = '$statusValue'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            return $row['count'];
                        } else {
                            return 0;
                        }
                    }

                    // Call the function to get the regular count
                    $regularCount = getIRRegularCount($conn, "202220232ndsemcongress", "status1", "REGULAR");
                    
                                        
                    function getIRRegularCount($conn, $table, $statusColumn, $statusValue) {
                    $sql = "SELECT COUNT(*) as count FROM $table WHERE $statusColumn = '$statusValue'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        return $row['count'];
                    } else {
                        return 0;
                    }
                }

                // Call the function to get the regular count
                $irregularCount = getIRRegularCount($conn, "202220232ndsemcongress", "status1", "IRREGULAR");

                ?>

                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                    <div class="sale-statistic-inner notika-shadow mg-tb-30">
                        <div class="curved-inner-pro">
                            <div class="curved-ctn">
                                <h2>Enrolled Students</h2>
                            </div>
                        </div>
                        <!--CHART-->
                        <div id="barchart_material" style="width: 800px; height: 400px;"></div> 
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                    <div class="statistic-right-area notika-shadow mg-tb-30 sm-res-mg-t-0">
                        <div class="past-day-statis">
                            <h2>Students Status</h2>
                            <p>of University of Caloocal City</p>
                        </div>
						<div class="dash-widget-visits"></div>
                        <div class="past-statistic-an">
                            <div class="past-statistic-ctn">
                                <h3><span class="counter"><?php echo  $regularCount; ?></span></h3>
                                <p>Regular</p>
                            </div>
                            <div class="past-statistic-graph">
                                <div class="stats-bar"></div>
                            </div>
                        </div>
                        <div class="past-statistic-an">
                            <div class="past-statistic-ctn">
                                <h3><span class="counter"><?php echo $irregularCount; ?></span></h3>
                                <p>Irregular</p>
                            </div>
                            <div class="past-statistic-graph">
                                <div class="stats-line"></div>
                            </div>
                        </div>
                        <div class="past-statistic-an">
                            <div class="past-statistic-ctn">
                                <h3><span class="counter"></span></h3>
                                <p>Dean Lister</p>
                            </div>
                            <div class="past-statistic-graph">
                                <div class="stats-bar-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Sale Statistic area-->
    
   

 <!--script-->
 <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery-price-slider.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/meanmenu/jquery.meanmenu.js"></script>
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/jvectormap/jvectormap-active.js"></script>
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <script src="js/flot/jquery.flot.js"></script>
    <script src="js/flot/jquery.flot.resize.js"></script>
    <script src="js/flot/jquery.flot.pie.js"></script>
    <script src="js/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/flot/jquery.flot.orderBars.js"></script>
    <script src="js/flot/curvedLines.js"></script>
    <script src="js/flot/flot-active.js"></script>
    <script src="js/knob/jquery.knob.js"></script>
    <script src="js/knob/jquery.appear.js"></script>
    <script src="js/knob/knob-active.js"></script>
    <script src="js/wave/waves.min.js"></script>
    <script src="js/wave/wave-active.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <!--End script-->
</body>

</html>