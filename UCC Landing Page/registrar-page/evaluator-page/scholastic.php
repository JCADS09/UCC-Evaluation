<?php
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if(!$con) {
    die("Connection Error: ".mysqli_connect_error());
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$tableName = isset($_GET['table']) ? $_GET['table'] : null;
$studentNumber = $id;
if($id === null || $tableName === null) {
    die("Invalid parameters in the URL");
}

$query = "SELECT sno, CONCAT(sname, ', ', fname, ' ', mname) AS Name, course, year1 AS year, section AS section, status1 AS status 
          FROM $tableName
          WHERE sno = '$id'";

$result = mysqli_query($con, $query);

if(!$result) {
    die("Error in SQL query: ".mysqli_error($con));
}

$studentNumber = $id;

// Define an array mapping scenarios to year and semester
$scenarioMap = array(
    '1ST1ST' => array('year' => '1ST', 'semester' => '1ST'),
    '1ST2ND' => array('year' => '1ST', 'semester' => '2ND'),
    '2ND1ST' => array('year' => '2ND', 'semester' => '1ST'),
    '2ND2ND' => array('year' => '2ND', 'semester' => '2ND'),
    '3RD1ST' => array('year' => '3RD', 'semester' => '1ST'),
    '3RD2ND' => array('year' => '3RD', 'semester' => '2ND'),
    '4TH1ST' => array('year' => '4TH', 'semester' => '1ST'),
    '4TH2ND' => array('year' => '4TH', 'semester' => '2ND')
);

$resultTables = array();

foreach($scenarioMap as $scenario => $values) {
    $query = "SELECT DISTINCT table_name FROM information_schema.columns 
              WHERE table_schema = 'uccevaluation' 
              AND (column_name = 'sy1' OR column_name = 'semester')";

    $result = mysqli_query($con, $query);

    if($result) {
        // Loop through the result to find the matching table
        while($row = mysqli_fetch_assoc($result)) {
            $tableName = $row['table_name'];

            // Check if the table for the given year and semester exists
            $checkQuery = "SELECT * FROM `$tableName` WHERE year1 = '{$values['year']}' AND semester = '{$values['semester']}' AND sno = '$studentNumber'";
            $checkResult = mysqli_query($con, $checkQuery);

            if($checkResult && mysqli_num_rows($checkResult) > 0) {
                $resultTables[] = array(
                    'tableName' => $tableName,
                    'year' => $values['year'],
                    'semester' => $values['semester']
                );
            }
        }
    }
}

// Output the result
foreach($resultTables as $result) {
    echo "Table Name: ".$result['tableName']." - Year: ".$result['year']." - Semester: ".$result['semester']."<br>";
}
// fetch table name for 1st year 1st sem
$query = "SELECT table_name FROM information_schema.columns 
                                  WHERE table_schema = 'uccevaluation' 
                                  AND (column_name = 'sy1' OR column_name = 'semester')";
$result = mysqli_query($con, $query);

if($result) {
    // Loop through the result to find the matching table
    while($row = mysqli_fetch_assoc($result)) {
        $tableName = $row['table_name'];

        // Check if the table for the given year and semester exists
        $checkQuery = "SELECT * FROM $tableName WHERE year1 = '1ST' AND semester = '1ST' AND sno = '$studentNumber'";
        $checkResult = mysqli_query($con, $checkQuery);

        if($checkResult && mysqli_num_rows($checkResult) > 0) {

   
            break;
        }
    }
}
?>


<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Summary of Grades</title>
    <link rel="shortcut icon" type="image/x-icon" href="../system-img/check.png">

        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="MIS_StudentData/css/bootstrap.min.css">
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
                        <li class="tab">
                            <a href="../evaluatornav.php">
                                <img src="../system-img/home.png" width="28" height="27"> Dashboard
                            </a>
                        </li>

                        <li class="tab">
                            <a href="Student.php">
                                <img src="../system-img/student.png" width="25" height="25"> Students
                            </a>
                        </li>

                        <li class="tab">
                            <a href="scholastic/students.php" style="background-color:#ff8e1c;color:white;">
                                <img src="../system-img/pencil.png" width="25" height="25"> Evaluate Student
                            </a>
                        </li>

                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu area End-->
    <style>
    @media print {  
        @page {
            size:8.5in 13in;
        }
        head{
            height:0px;
            display: none;
        }
        #head{
            display: none;
            height:0px;
        }
        #print{
        position:fixed;
        top:0px;
        margin-top:20px;
        margin-bottom:30px;
        margin-right:50px;
        margin-left:0px;
        }
        }
        #print{
        width:7.5in;
        }
        input {
    border: 0;
    outline: 0;
    background: transparent;
    border-bottom: 1px solid black;
}

.form-box{
    width: 816px;
    height: 1700px;
    position: relative;
    margin: 2% auto;
    background: white;
    padding: 5px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

    button{
        height:35px;
        text-align:center;
    }
    </style>


<!-- history log inserted in php   
$user = $_SESSION['id'];
    mysqli_query($conn, "INSERT into history_log (transaction,user_id,date_added) 
        VALUES ('printed $student permanent record','$user',NOW() )");

-->

<body style="background-color:white"> 
<span id='returncode'></span>
<div class="col-md-10" id="head" style="margin-left:73%;">
    <button class="btn btn-success" style="font-size:15px;" onclick="print()"><i class="glyphicon glyphicon-print"></i>Print</button>
    <button class="btn btn-danger" style="color:white;font-size:15px;" onclick="window.close()">Cancel</button>
    
</div>
<center>
<div id='print'>
<div class="form-box">
<img src="../images/ucclogo.png"width="50"height="50"style="position:absolute;left: 0;">
<i><h6 style="position:absolute;left: 6%;top:2%;font-family:Poppins;">University of Caloocan City - Evaluation Form</h6></i>
<div style="margin-left:.5in;margin-right:.5in;margin-top:.1in;margin-bottom:.1in;line-height:1mm;">
<div style="margin-top:10%;font-family:arial;">
        <h2><center><b>University of Caloocan City</b></center></h2>
</div>
        <p><center><i>Biglang Awa St., Avenue East, Caloocan City</i></center></p>
            
          </div>
          <div class="row">
          <div class="col-md-12">
          <center><p><b><h4>SUMMARY OF GRADES </h4></b></p></center><br>
          </div>
          </div>
          <div class="row">
          <div class="col-md-12">

            <table style="line-height:5mm">
                <?php
                include 'db.php';
                $id = $_GET['id'];
                
                $sql = mysqli_query($con, "SELECT * from $tableName where sno = '$id'");
                while($row = mysqli_fetch_assoc($sql)) {
                    $mid = $row['mname'];
                    ?>
                            <tr>
                                <td style="width:600px;font-size:15px;font-family:arial;">
                                <u><h style="font-size:15px"><?php echo $row['semester'] ?></h></u>
                                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbspSemester&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                                    <u><h style="font-size:15px"><?php echo $row['sy1'].' - '.$row['sy2'] ?></u></h>
                                    <br>
                                    <br>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                        <b><label for="">Student No.::&nbsp&nbsp</label></b>
                                    <h style="font-size:15px"><?php echo $row['sno'] ?>
                                    </div>

                                    <div style="margin-left:20%;">
                                        <b><label for="">Course:&nbsp&nbsp</label></b>
                                    <h style="font-size:15px"><?php echo $row['course'] ?></h>
                                    </div>
                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <b><label for="">Surname:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                                        <h style="font-size:15px"><?php echo $row['sname'] ?></h>
                                            </div>

                                        <div style="margin-left:20%;">   
                                            <b><label for="">Year:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                                            <h style="font-size:15px"><?php echo $row['year1'] ?></h>
                                            </div>
                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <b><label for="">First Name:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                                            <h style="font-size:15px"><?php echo $row['fname'] ?></h>
                                        </div>

                                        <div style="margin-left:20%;">
                                            <b><label for="">Section:&nbsp&nbsp</label></b>
                                            <h style="font-size:15px"><?php echo $row['section'] ?></h>
                                        </div>
                                    </div>

                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <b><label for="">Middle Name:&nbsp</label></b>
                                            <h style="font-size:15px"><?php echo $row['mname'] ?></h>
                                        </div>

                                        <div style="margin-left:20%;">
                                            <b><label for="">Status:&nbsp&nbsp&nbsp&nbsp</label></b>
                                            <h style="font-size:15px"><?php echo $row['status1'] ?></h>
                                        </div>
                                    </div>

                            </tr>

                  

                        <?php $section = $row['section'];
                } ?>
                     
            
            </table>

            <!-- Scholastic -->

           
            <center>
        <div id='print'>
           
                <div class="col-md-12">
                    <table style="line-height:5mm">
                    <!-- Table -->
                    <?php
                    include 'db.php';
                    $id = $_GET['id'];
                    $selectQuery1 = "SELECT sy1, sy2 FROM $tableName WHERE sno = '$id'";
                    $result1 = mysqli_query($con, $selectQuery1);
                    $yearInfo = mysqli_fetch_assoc($result1);

                    // Construct the table name dynamically based on the year, semester, sy1, and sy2
                    $tableName = urlencode($yearInfo['sy1'].$yearInfo['sy2']."2nd"."sem"."Congress");

                    $sql = mysqli_query($con, "SELECT * from $tableName where sno = '$id'");
                    while($row = mysqli_fetch_assoc($sql)) {
                        $mid = $row['mname'];
                        ?>
                            <!--Header of the table yung school year-->

                                <table > 
                                        <tr>
                                        <th style="width:3500px;border:1px solid black;font-size:12px;"><center><b>FIRST YEAR | S.Y.:<?php echo $row['sy1'].' - '.$row['sy2'] ?></b></center></th>
                                        </tr>
                        
                                <table  style="width:90%;">

                            <!--end header-->
                    <?php } ?>

                     <!---------------------------FIRST YEAR START------------------------->

                    <table >

                                <tr>
                                    <td style="width: 289px; border: 1px solid black; font-size: 12px;"><center><b>FIRST SEMESTER</b></center></td>
                                    <td style="width: 56px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><?php echo $section; ?></b></center></td>

                                    

                                    <td style="width: 289px; border: 1px solid black; font-size: 12px;"><center><b>SECOND SEMESTER</b></center></td>
                                    <td style="width: 55px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><?php echo $section; ?></b></center></td>

                                </tr>
                                
                    </table>

                    <div style="text-align: left; display: inline-block;">
                       

                           
                            <table style="border-collapse:collapse">

                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>SUB. CODE</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>


                                <td style="width:70px;border:1px solid black;font-size:12px;"><b>SUB. CODE</b></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>
                               
                                </tr>

                    <?php
                    $con = mysqli_connect("localhost", "root", "", "uccevaluation");

                    if(!$con) {
                        die("Connection Error");
                    }

                    $id = $_GET['id'];
                    $tableName = $_GET['table'];


                    // Initialize variables
                    
                    //Get yje data of firstyear 1st sem
                    
                    $sqlCheck1styear1sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                    if($rowCheck = mysqli_fetch_assoc($sqlCheck1styear1sem)) {
                        // If the condition is met, proceed to fetch and display the data
                        $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4,
                         unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9,
                          desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                        if($row = mysqli_fetch_assoc($sql)) {

                            $scode1_1sty1sem = $row['scode1'];
                            $desc1_1sty1sem = $row['desc1'];
                            $unit1_1sty1sem = $row['unit1'];
                            $FG1_1sty1sem = $row['FG1'];

                            $scode2_1sty1sem = $row['scode2'];
                            $desc2_1sty1sem = $row['desc2'];
                            $unit2_1sty1sem = $row['unit2'];
                            $FG2_1sty1sem = $row['FG2'];

                            $scode3_1sty1sem = $row['scode3'];
                            $desc3_1sty1sem = $row['desc3'];
                            $unit3_1sty1sem = $row['unit3'];
                            $FG3_1sty1sem = $row['FG3'];

                            $scode4_1sty1sem = $row['scode4'];
                            $desc4_1sty1sem = $row['desc4'];
                            $unit4_1sty1sem = $row['unit4'];
                            $FG4_1sty1sem = $row['FG4'];

                            $scode5_1sty1sem = $row['scode5'];
                            $desc5_1sty1sem = $row['desc5'];
                            $unit5_1sty1sem = $row['unit5'];
                            $FG5_1sty1sem = $row['FG5'];

                            $scode6_1sty1sem = $row['scode6'];
                            $desc6_1sty1sem = $row['desc6'];
                            $unit6_1sty1sem = $row['unit6'];
                            $FG6_1sty1sem = $row['FG6'];

                            $scode7_1sty1sem = $row['scode7'];
                            $desc7_1sty1sem = $row['desc7'];
                            $unit7_1sty1sem = $row['unit7'];
                            $FG7_1sty1sem = $row['FG7'];

                            $scode8_1sty1sem = $row['scode8'];
                            $desc8_1sty1sem = $row['desc8'];
                            $unit8_1sty1sem = $row['unit8'];
                            $FG8_1sty1sem = $row['FG8'];

                            $scode9_1sty1sem = $row['scode9'];
                            $desc9_1sty1sem = $row['desc9'];
                            $unit9_1sty1sem = $row['unit9'];
                            $FG9_1sty1sem = $row['FG9'];

                            $scode10_1sty1sem = $row['scode10'];
                            $desc10_1sty1sem = $row['desc10'];
                            $unit10_1sty1sem = $row['unit10'];
                            $FG10_1sty1sem = $row['FG10'];

                            $total1styear1sem_units = 0;
                            $total1styear1sem_units += is_numeric($unit1_1sty1sem) ? $unit1_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit2_1sty1sem) ? $unit2_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit3_1sty1sem) ? $unit3_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit4_1sty1sem) ? $unit4_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit5_1sty1sem) ? $unit5_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit6_1sty1sem) ? $unit6_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit7_1sty1sem) ? $unit7_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit8_1sty1sem) ? $unit8_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit9_1sty1sem) ? $unit9_1sty1sem : 0;
                            $total1styear1sem_units += is_numeric($unit10_1sty1sem) ? $unit10_1sty1sem : 0;

                        }
                    } else {
                        // If the condition is not met, set variables to null
                        $scode1_1sty1sem = $desc1_1sty1sem = $unit1_1sty1sem = $FG1_1sty1sem = 0;
                        $scode2_1sty1sem = $desc2_1sty1sem = $unit2_1sty1sem = $FG2_1sty1sem = 0;
                        $scode3_1sty1sem = $desc3_1sty1sem = $unit3_1sty1sem = $FG3_1sty1sem = 0;
                        $scode4_1sty1sem = $desc4_1sty1sem = $unit4_1sty1sem = $FG4_1sty1sem = 0;
                        $scode5_1sty1sem = $desc5_1sty1sem = $unit5_1sty1sem = $FG5_1sty1sem = 0;
                        $scode6_1sty1sem = $desc6_1sty1sem = $unit6_1sty1sem = $FG6_1sty1sem = 0;
                        $scode7_1sty1sem = $desc7_1sty1sem = $unit7_1sty1sem = $FG7_1sty1sem = 0;
                        $scode8_1sty1sem = $desc8_1sty1sem = $unit8_1sty1sem = $FG8_1sty1sem = 0;
                        $scode9_1sty1sem = $desc9_1sty1sem = $unit9_1sty1sem = $FG9_1sty1sem = 0;
                        $scode10_1sty1sem = $desc10_1sty1sem = $unit10_1sty1sem = $FG10_1sty1sem = 0;
                        $total1styear1sem_units = 0;

                    }

                    //Get the data of first year 2ndsem
                    
                    // Check if the year is '1ST' and the semester is '2ND'
                    $sqlCheck = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                    if($rowCheck = mysqli_fetch_assoc($sqlCheck)) {
                        // If the condition is met, proceed to fetch and display the data
                        $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                        if($row = mysqli_fetch_assoc($sql)) {
                            // Your existing code to assign values to variables goes here
                            $scode1_1sty2sem = $row['scode1'];
                            $desc1_1sty2sem = $row['desc1'];
                            $unit1_1sty2sem = $row['unit1'];
                            $FG1_1sty2sem = $row['FG1'];

                            $scode2_1sty2sem = $row['scode2'];
                            $desc2_1sty2sem = $row['desc2'];
                            $unit2_1sty2sem = $row['unit2'];
                            $FG2_1sty2sem = $row['FG2'];

                            $scode3_1sty2sem = $row['scode3'];
                            $desc3_1sty2sem = $row['desc3'];
                            $unit3_1sty2sem = $row['unit3'];
                            $FG3_1sty2sem = $row['FG3'];

                            $scode4_1sty2sem = $row['scode4'];
                            $desc4_1sty2sem = $row['desc4'];
                            $unit4_1sty2sem = $row['unit4'];
                            $FG4_1sty2sem = $row['FG4'];

                            $scode5_1sty2sem = $row['scode5'];
                            $desc5_1sty2sem = $row['desc5'];
                            $unit5_1sty2sem = $row['unit5'];
                            $FG5_1sty2sem = $row['FG5'];

                            $scode6_1sty2sem = $row['scode6'];
                            $desc6_1sty2sem = $row['desc6'];
                            $unit6_1sty2sem = $row['unit6'];
                            $FG6_1sty2sem = $row['FG6'];

                            $scode7_1sty2sem = $row['scode7'];
                            $desc7_1sty2sem = $row['desc7'];
                            $unit7_1sty2sem = $row['unit7'];
                            $FG7_1sty2sem = $row['FG7'];

                            $scode8_1sty2sem = $row['scode8'];
                            $desc8_1sty2sem = $row['desc8'];
                            $unit8_1sty2sem = $row['unit8'];
                            $FG8_1sty2sem = $row['FG8'];

                            $scode9_1sty2sem = $row['scode9'];
                            $desc9_1sty2sem = $row['desc9'];
                            $unit9_1sty2sem = $row['unit9'];
                            $FG9_1sty2sem = $row['FG9'];

                            $scode10_1sty2sem = $row['scode10'];
                            $desc10_1sty2sem = $row['desc10'];
                            $unit10_1sty2sem = $row['unit10'];
                            $FG10_1sty2sem = $row['FG10'];

                            $total_units = 0;
                            $total_units += is_numeric($unit1_1sty2sem) ? $unit1_1sty2sem : 0;
                            $total_units += is_numeric($unit2_1sty2sem) ? $unit2_1sty2sem : 0;
                            $total_units += is_numeric($unit3_1sty2sem) ? $unit3_1sty2sem : 0;
                            $total_units += is_numeric($unit4_1sty2sem) ? $unit4_1sty2sem : 0;
                            $total_units += is_numeric($unit5_1sty2sem) ? $unit5_1sty2sem : 0;
                            $total_units += is_numeric($unit6_1sty2sem) ? $unit6_1sty2sem : 0;
                            $total_units += is_numeric($unit7_1sty2sem) ? $unit7_1sty2sem : 0;
                            $total_units += is_numeric($unit8_1sty2sem) ? $unit8_1sty2sem : 0;
                            $total_units += is_numeric($unit9_1sty2sem) ? $unit9_1sty2sem : 0;
                            $total_units += is_numeric($unit10_1sty2sem) ? $unit10_1sty2sem : 0;

                        }
                    } else {
                        // If the condition is not met, set variables to null
                        $scode1_1sty2sem = $desc1_1sty2sem = $unit1_1sty2sem = $FG1_1sty2sem = 0;
                        $scode2_1sty2sem = $desc2_1sty2sem = $unit2_1sty2sem = $FG2_1sty2sem = 0;
                        $scode3_1sty2sem = $desc3_1sty2sem = $unit3_1sty2sem = $FG3_1sty2sem = 0;
                        $scode4_1sty2sem = $desc4_1sty2sem = $unit4_1sty2sem = $FG4_1sty2sem = 0;
                        $scode5_1sty2sem = $desc5_1sty2sem = $unit5_1sty2sem = $FG5_1sty2sem = 0;
                        $scode6_1sty2sem = $desc6_1sty2sem = $unit6_1sty2sem = $FG6_1sty2sem = 0;
                        $scode7_1sty2sem = $desc7_1sty2sem = $unit7_1sty2sem = $FG7_1sty2sem = 0;
                        $scode8_1sty2sem = $desc8_1sty2sem = $unit8_1sty2sem = $FG8_1sty2sem = 0;
                        $scode9_1sty2sem = $desc9_1sty2sem = $unit9_1sty2sem = $FG9_1sty2sem = 0;
                        $scode10_1sty2sem = $desc10_1sty2sem = $unit10_1sty2sem = $FG10_1sty2sem = 0;
                        $total_units = 0;

                    }


                    ?>

                                <!-- subject 1-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px; border:1px solid black; font-size:12px;"><center><b><?php echo $scode1_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px; border:1px solid black; font-size:12px;"><center><b><?php echo $scode1_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_1sty2sem; ?></b></center></td>
                               
                                </tr>


                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_1sty1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_1sty2sem; ?></b></center></td>
                               
                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_1sty1sem; ?></b></center></td>
                               

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_1sty2sem; ?></b></center></td>
                               
                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_1sty1sem ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_1sty1sem ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_1sty2sem ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_1sty2sem ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_1sty2sem; ?></b></center></td>
                               
                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_1sty2sem; ?></b></center></td>
                               
                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_1sty2sem; ?></b></center></td>
                               
                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_1sty2sem; ?></b></center></td>
                               
                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_1sty2sem; ?></b></center></td>
                               
                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_1sty2sem; ?></b></center></td>
                               
                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_1sty1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_1sty1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_1sty1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_1sty2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_1sty2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_1sty2sem; ?></b></center></td>
                               
                                </tr>

                                
                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total1styear1sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                            </table>
                            <!---------------------------FIRST YEAR END------------------------->
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "uccevaluation");

                    if(!$con) {
                        die("Connection Error");
                    }

                    $id = $_GET['id'];
                    // Initialize variables
                    
                    //Get yje data of firstyear 1st sem
                    
                    $sqlCheck2ndyear1sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                    if($rowCheck = mysqli_fetch_assoc($sqlCheck2ndyear1sem)) {
                        // If the condition is met, proceed to fetch and display the data
                        $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                        if($row = mysqli_fetch_assoc($sql)) {

                            $scode1_2ndy1sem = $row['scode1'];
                            $desc1_2ndy1sem = $row['desc1'];
                            $unit1_2ndy1sem = $row['unit1'];
                            $FG1_2ndy1sem = $row['FG1'];

                            $scode2_2ndy1sem = $row['scode2'];
                            $desc2_2ndy1sem = $row['desc2'];
                            $unit2_2ndy1sem = $row['unit2'];
                            $FG2_2ndy1sem = $row['FG2'];

                            $scode3_2ndy1sem = $row['scode3'];
                            $desc3_2ndy1sem = $row['desc3'];
                            $unit3_2ndy1sem = $row['unit3'];
                            $FG3_2ndy1sem = $row['FG3'];

                            $scode4_2ndy1sem = $row['scode4'];
                            $desc4_2ndy1sem = $row['desc4'];
                            $unit4_2ndy1sem = $row['unit4'];
                            $FG4_2ndy1sem = $row['FG4'];

                            $scode5_2ndy1sem = $row['scode5'];
                            $desc5_2ndy1sem = $row['desc5'];
                            $unit5_2ndy1sem = $row['unit5'];
                            $FG5_2ndy1sem = $row['FG5'];

                            $scode6_2ndy1sem = $row['scode6'];
                            $desc6_2ndy1sem = $row['desc6'];
                            $unit6_2ndy1sem = $row['unit6'];
                            $FG6_2ndy1sem = $row['FG6'];

                            $scode7_2ndy1sem = $row['scode7'];
                            $desc7_2ndy1sem = $row['desc7'];
                            $unit7_2ndy1sem = $row['unit7'];
                            $FG7_2ndy1sem = $row['FG7'];

                            $scode8_2ndy1sem = $row['scode8'];
                            $desc8_2ndy1sem = $row['desc8'];
                            $unit8_2ndy1sem = $row['unit8'];
                            $FG8_2ndy1sem = $row['FG8'];

                            $scode9_2ndy1sem = $row['scode9'];
                            $desc9_2ndy1sem = $row['desc9'];
                            $unit9_2ndy1sem = $row['unit9'];
                            $FG9_2ndy1sem = $row['FG9'];

                            $scode10_2ndy1sem = $row['scode10'];
                            $desc10_2ndy1sem = $row['desc10'];
                            $unit10_2ndy1sem = $row['unit10'];
                            $FG10_2ndy1sem = $row['FG10'];

                            $total2ndyear1sem_units = 0;
                            $total2ndyear1sem_units += is_numeric($unit1_2ndy1sem) ? $unit1_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit2_2ndy1sem) ? $unit2_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit3_2ndy1sem) ? $unit3_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit4_2ndy1sem) ? $unit4_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit5_2ndy1sem) ? $unit5_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit6_2ndy1sem) ? $unit6_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit7_2ndy1sem) ? $unit7_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit8_2ndy1sem) ? $unit8_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit9_2ndy1sem) ? $unit9_2ndy1sem : 0;
                            $total2ndyear1sem_units += is_numeric($unit10_2ndy1sem) ? $unit10_2ndy1sem : 0;

                        }
                    } else {
                        // If the condition is not met, set variables to null
                        $scode1_2ndy1sem = $desc1_2ndy1sem = $unit1_2ndy1sem = $FG1_2ndy1sem = 0;
                        $scode2_2ndy1sem = $desc2_2ndy1sem = $unit2_2ndy1sem = $FG2_2ndy1sem = 0;
                        $scode3_2ndy1sem = $desc3_2ndy1sem = $unit3_2ndy1sem = $FG3_2ndy1sem = 0;
                        $scode4_2ndy1sem = $desc4_2ndy1sem = $unit4_2ndy1sem = $FG4_2ndy1sem = 0;
                        $scode5_2ndy1sem = $desc5_2ndy1sem = $unit5_2ndy1sem = $FG5_2ndy1sem = 0;
                        $scode6_2ndy1sem = $desc6_2ndy1sem = $unit6_2ndy1sem = $FG6_2ndy1sem = 0;
                        $scode7_2ndy1sem = $desc7_2ndy1sem = $unit7_2ndy1sem = $FG7_2ndy1sem = 0;
                        $scode8_2ndy1sem = $desc8_2ndy1sem = $unit8_2ndy1sem = $FG8_2ndy1sem = 0;
                        $scode9_2ndy1sem = $desc9_2ndy1sem = $unit9_2ndy1sem = $FG9_2ndy1sem = 0;
                        $scode10_2ndy1sem = $desc10_2ndy1sem = $unit10_2ndy1sem = $FG10_2ndy1sem = 0;
                        $total2ndy1sem_units = 0;

                    }

                    //Get the data of first year 2ndsem
                    
                    // Check if the year is '1ST' and the semester is '2ND'
                    $sqlCheck2ndyear2sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                    if($rowCheck = mysqli_fetch_assoc($sqlCheck2ndyear2sem)) {
                        // If the condition is met, proceed to fetch and display the data
                        $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                        if($row = mysqli_fetch_assoc($sql)) {
                            // Your existing code to assign values to variables goes here
                            $scode1_2ndy2sem = $row['scode1'];
                            $desc1_2ndy2sem = $row['desc1'];
                            $unit1_2ndy2sem = $row['unit1'];
                            $FG1_2ndy2sem = $row['FG1'];

                            $scode2_2ndy2sem = $row['scode2'];
                            $desc2_2ndy2sem = $row['desc2'];
                            $unit2_2ndy2sem = $row['unit2'];
                            $FG2_2ndy2sem = $row['FG2'];

                            $scode3_2ndy2sem = $row['scode3'];
                            $desc3_2ndy2sem = $row['desc3'];
                            $unit3_2ndy2sem = $row['unit3'];
                            $FG3_2ndy2sem = $row['FG3'];

                            $scode4_2ndy2sem = $row['scode4'];
                            $desc4_2ndy2sem = $row['desc4'];
                            $unit4_2ndy2sem = $row['unit4'];
                            $FG4_2ndy2sem = $row['FG4'];

                            $scode5_2ndy2sem = $row['scode5'];
                            $desc5_2ndy2sem = $row['desc5'];
                            $unit5_2ndy2sem = $row['unit5'];
                            $FG5_2ndy2sem = $row['FG5'];

                            $scode6_2ndy2sem = $row['scode6'];
                            $desc6_2ndy2sem = $row['desc6'];
                            $unit6_2ndy2sem = $row['unit6'];
                            $FG6_2ndy2sem = $row['FG6'];

                            $scode7_2ndy2sem = $row['scode7'];
                            $desc7_2ndy2sem = $row['desc7'];
                            $unit7_2ndy2sem = $row['unit7'];
                            $FG7_2ndy2sem = $row['FG7'];

                            $scode8_2ndy2sem = $row['scode8'];
                            $desc8_2ndy2sem = $row['desc8'];
                            $unit8_2ndy2sem = $row['unit8'];
                            $FG8_2ndy2sem = $row['FG8'];

                            $scode9_2ndy2sem = $row['scode9'];
                            $desc9_2ndy2sem = $row['desc9'];
                            $unit9_2ndy2sem = $row['unit9'];
                            $FG9_2ndy2sem = $row['FG9'];

                            $scode10_2ndy2sem = $row['scode10'];
                            $desc10_2ndy2sem = $row['desc10'];
                            $unit10_2ndy2sem = $row['unit10'];
                            $FG10_2ndy2sem = $row['FG10'];

                            $total2ndyear2sem_units = 0;
                            $total2ndyear2sem_units += is_numeric($unit1_2ndy2sem) ? $unit1_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit2_2ndy2sem) ? $unit2_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit3_2ndy2sem) ? $unit3_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit4_2ndy2sem) ? $unit4_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit5_2ndy2sem) ? $unit5_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit6_2ndy2sem) ? $unit6_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit7_2ndy2sem) ? $unit7_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit8_2ndy2sem) ? $unit8_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit9_2ndy2sem) ? $unit9_2ndy2sem : 0;
                            $total2ndyear2sem_units += is_numeric($unit10_2ndy2sem) ? $unit10_2ndy2sem : 0;

                        }
                    } else {
                        // If the condition is not met, set variables to null
                        $scode1_2ndy2sem = $desc1_2ndy2sem = $unit1_2ndy2sem = $FG1_2ndy2sem = 0;
                        $scode2_2ndy2sem = $desc2_2ndy2sem = $unit2_2ndy2sem = $FG2_2ndy2sem = 0;
                        $scode3_2ndy2sem = $desc3_2ndy2sem = $unit3_2ndy2sem = $FG3_2ndy2sem = 0;
                        $scode4_2ndy2sem = $desc4_2ndy2sem = $unit4_2ndy2sem = $FG4_2ndy2sem = 0;
                        $scode5_2ndy2sem = $desc5_2ndy2sem = $unit5_2ndy2sem = $FG5_2ndy2sem = 0;
                        $scode6_2ndy2sem = $desc6_2ndy2sem = $unit6_2ndy2sem = $FG6_2ndy2sem = 0;
                        $scode7_2ndy2sem = $desc7_2ndy2sem = $unit7_2ndy2sem = $FG7_2ndy2sem = 0;
                        $scode8_2ndy2sem = $desc8_2ndy2sem = $unit8_2ndy2sem = $FG8_2ndy2sem = 0;
                        $scode9_2ndy2sem = $desc9_2ndy2sem = $unit9_2ndy2sem = $FG9_2ndy2sem = 0;
                        $scode10_2ndy2sem = $desc10_2ndy2sem = $unit10_2ndy2sem = $FG10_2ndy2sem = 0;
                        $total2ndyear2sem_units = 0;

                    }


                    ?>

                            <!---------------------------SECOND YEAR START------------------------->
                            

                            <table > 
                                <tr>
                                <th style="width:3500px;border:1px solid black;font-size:12px;"><center><b>SECOND YEAR | S.Y.:<!--year--></b></center></th>
                                </tr>
                        
                            <table  style="width:90%;">

                            <table >

                                <tr>
                                    <td style="width: 287px; border: 1px solid black; font-size: 12px;"><center><b>FIRST SEMESTER</b></center></td>
                                    <td style="width: 56px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><!--ssection--></b></center></td>

                                    

                                    <td style="width: 289px; border: 1px solid black; font-size: 12px;"><center><b>SECOND SEMESTER</b></center></td>
                                    <td style="width: 55px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><!--ssection--></b></center></td>

                                </tr>

                            </table>

                            <table style="border-collapse:collapse">

                                <tr>
                   
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>SUB. CODE</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>


                                <td style="width:70px;border:1px solid black;font-size:12px;"><b>SUB. CODE</b></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>

                                </tr>

                                <!-- subject 1-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode1_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode1_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_2ndy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_2ndy1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_2ndy2sem ?></b></center></td>

                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_2ndy1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_2ndy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_2ndy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_2ndy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_2ndy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_2ndy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_2ndy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_2ndy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_2ndy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_2ndy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_2ndy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_2ndy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_2ndy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_2ndy2sem; ?></b></center></td>

                                </tr>


                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total2ndyear1sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php ?></b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total2ndyear2sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php ?></b></center></td>

                                </tr>
                            </table>

                            <!---------------------------SECOND YEAR END------------------------->
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "uccevaluation");

                        if(!$con) {
                            die("Connection Error");
                        }

                        $id = $_GET['id'];
                        // Initialize variables
                        
                        //Get yje data of firstyear 1st sem
                        
                        $sqlCheck3rdyear1sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                        if($rowCheck = mysqli_fetch_assoc($sqlCheck3rdyear1sem)) {
                            // If the condition is met, proceed to fetch and display the data
                            $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                            if($row = mysqli_fetch_assoc($sql)) {

                                $scode1_3rdy1sem = $row['scode1'];
                                $desc1_3rdy1sem = $row['desc1'];
                                $unit1_3rdy1sem = $row['unit1'];
                                $FG1_3rdy1sem = $row['FG1'];

                                $scode2_3rdy1sem = $row['scode2'];
                                $desc2_3rdy1sem = $row['desc2'];
                                $unit2_3rdy1sem = $row['unit2'];
                                $FG2_3rdy1sem = $row['FG2'];

                                $scode3_3rdy1sem = $row['scode3'];
                                $desc3_3rdy1sem = $row['desc3'];
                                $unit3_3rdy1sem = $row['unit3'];
                                $FG3_3rdy1sem = $row['FG3'];

                                $scode4_3rdy1sem = $row['scode4'];
                                $desc4_3rdy1sem = $row['desc4'];
                                $unit4_3rdy1sem = $row['unit4'];
                                $FG4_3rdy1sem = $row['FG4'];

                                $scode5_3rdy1sem = $row['scode5'];
                                $desc5_3rdy1sem = $row['desc5'];
                                $unit5_3rdy1sem = $row['unit5'];
                                $FG5_3rdy1sem = $row['FG5'];

                                $scode6_3rdy1sem = $row['scode6'];
                                $desc6_3rdy1sem = $row['desc6'];
                                $unit6_3rdy1sem = $row['unit6'];
                                $FG6_3rdy1sem = $row['FG6'];

                                $scode7_3rdy1sem = $row['scode7'];
                                $desc7_3rdy1sem = $row['desc7'];
                                $unit7_3rdy1sem = $row['unit7'];
                                $FG7_3rdy1sem = $row['FG7'];

                                $scode8_3rdy1sem = $row['scode8'];
                                $desc8_3rdy1sem = $row['desc8'];
                                $unit8_3rdy1sem = $row['unit8'];
                                $FG8_3rdy1sem = $row['FG8'];

                                $scode9_3rdy1sem = $row['scode9'];
                                $desc9_3rdy1sem = $row['desc9'];
                                $unit9_3rdy1sem = $row['unit9'];
                                $FG9_3rdy1sem = $row['FG9'];

                                $scode10_3rdy1sem = $row['scode10'];
                                $desc10_3rdy1sem = $row['desc10'];
                                $unit10_3rdy1sem = $row['unit10'];
                                $FG10_3rdy1sem = $row['FG10'];

                                $total3rdy1sem_units = 0;
                                $total3rdy1sem_units += is_numeric($unit1_3rdy1sem) ? $unit1_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit2_3rdy1sem) ? $unit2_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit3_3rdy1sem) ? $unit3_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit4_3rdy1sem) ? $unit4_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit5_3rdy1sem) ? $unit5_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit6_3rdy1sem) ? $unit6_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit7_3rdy1sem) ? $unit7_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit8_3rdy1sem) ? $unit8_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit9_3rdy1sem) ? $unit9_3rdy1sem : 0;
                                $total3rdy1sem_units += is_numeric($unit10_3rdy1sem) ? $unit10_3rdy1sem : 0;

                            }
                        } else {
                            // If the condition is not met, set variables to null
                            $scode1_3rdy1sem = $desc1_3rdy1sem = $unit1_3rdy1sem = $FG1_3rdy1sem = 0;
                            $scode2_3rdy1sem = $desc2_3rdy1sem = $unit2_3rdy1sem = $FG2_3rdy1sem = 0;
                            $scode3_3rdy1sem = $desc3_3rdy1sem = $unit3_3rdy1sem = $FG3_3rdy1sem = 0;
                            $scode4_3rdy1sem = $desc4_3rdy1sem = $unit4_3rdy1sem = $FG4_3rdy1sem = 0;
                            $scode5_3rdy1sem = $desc5_3rdy1sem = $unit5_3rdy1sem = $FG5_3rdy1sem = 0;
                            $scode6_3rdy1sem = $desc6_3rdy1sem = $unit6_3rdy1sem = $FG6_3rdy1sem = 0;
                            $scode7_3rdy1sem = $desc7_3rdy1sem = $unit7_3rdy1sem = $FG7_3rdy1sem = 0;
                            $scode8_3rdy1sem = $desc8_3rdy1sem = $unit8_3rdy1sem = $FG8_3rdy1sem = 0;
                            $scode9_3rdy1sem = $desc9_3rdy1sem = $unit9_3rdy1sem = $FG9_3rdy1sem = 0;
                            $scode10_3rdy1sem = $desc10_3rdy1sem = $unit10_3rdy1sem = $FG10_3rdy1sem = 0;
                            $total3rdy1sem_units = 0;

                        }

                        //Get the data of first year 2ndsem
                        
                        // Check if the year is '1ST' and the semester is '2ND'
                        $sqlCheck3rdyear2sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                        if($rowCheck = mysqli_fetch_assoc($sqlCheck3rdyear2sem)) {
                            // If the condition is met, proceed to fetch and display the data
                            $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                            if($row = mysqli_fetch_assoc($sql)) {
                                // Your existing code to assign values to variables goes here
                                $scode1_3rdy2sem = $row['scode1'];
                                $desc1_3rdy2sem = $row['desc1'];
                                $unit1_3rdy2sem = $row['unit1'];
                                $FG1_3rdy2sem = $row['FG1'];

                                $scode2_3rdy2sem = $row['scode2'];
                                $desc2_3rdy2sem = $row['desc2'];
                                $unit2_3rdy2sem = $row['unit2'];
                                $FG2_3rdy2sem = $row['FG2'];

                                $scode3_3rdy2sem = $row['scode3'];
                                $desc3_3rdy2sem = $row['desc3'];
                                $unit3_3rdy2sem = $row['unit3'];
                                $FG3_3rdy2sem = $row['FG3'];

                                $scode4_3rdy2sem = $row['scode4'];
                                $desc4_3rdy2sem = $row['desc4'];
                                $unit4_3rdy2sem = $row['unit4'];
                                $FG4_3rdy2sem = $row['FG4'];

                                $scode5_3rdy2sem = $row['scode5'];
                                $desc5_3rdy2sem = $row['desc5'];
                                $unit5_3rdy2sem = $row['unit5'];
                                $FG5_3rdy2sem = $row['FG5'];

                                $scode6_3rdy2sem = $row['scode6'];
                                $desc6_3rdy2sem = $row['desc6'];
                                $unit6_3rdy2sem = $row['unit6'];
                                $FG6_3rdy2sem = $row['FG6'];

                                $scode7_3rdy2sem = $row['scode7'];
                                $desc7_3rdy2sem = $row['desc7'];
                                $unit7_3rdy2sem = $row['unit7'];
                                $FG7_3rdy2sem = $row['FG7'];

                                $scode8_3rdy2sem = $row['scode8'];
                                $desc8_3rdy2sem = $row['desc8'];
                                $unit8_3rdy2sem = $row['unit8'];
                                $FG8_3rdy2sem = $row['FG8'];

                                $scode9_3rdy2sem = $row['scode9'];
                                $desc9_3rdy2sem = $row['desc9'];
                                $unit9_3rdy2sem = $row['unit9'];
                                $FG9_3rdy2sem = $row['FG9'];

                                $scode10_3rdy2sem = $row['scode10'];
                                $desc10_3rdy2sem = $row['desc10'];
                                $unit10_3rdy2sem = $row['unit10'];
                                $FG10_3rdy2sem = $row['FG10'];

                                $total3rdy2sem_units = 0;
                                $total3rdy2sem_units += is_numeric($unit1_3rdy2sem) ? $unit1_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit2_3rdy2sem) ? $unit2_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit3_3rdy2sem) ? $unit3_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit4_3rdy2sem) ? $unit4_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit5_3rdy2sem) ? $unit5_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit6_3rdy2sem) ? $unit6_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit7_3rdy2sem) ? $unit7_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit8_3rdy2sem) ? $unit8_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit9_3rdy2sem) ? $unit9_3rdy2sem : 0;
                                $total3rdy2sem_units += is_numeric($unit10_3rdy2sem) ? $unit10_3rdy2sem : 0;

                            }
                        } else {
                            // If the condition is not met, set variables to null
                            $scode1_3rdy2sem = $desc1_3rdy2sem = $unit1_3rdy2sem = $FG1_3rdy2sem = 0;
                            $scode2_3rdy2sem = $desc2_3rdy2sem = $unit2_3rdy2sem = $FG2_3rdy2sem = 0;
                            $scode3_3rdy2sem = $desc3_3rdy2sem = $unit3_3rdy2sem = $FG3_3rdy2sem = 0;
                            $scode4_3rdy2sem = $desc4_3rdy2sem = $unit4_3rdy2sem = $FG4_3rdy2sem = 0;
                            $scode5_3rdy2sem = $desc5_3rdy2sem = $unit5_3rdy2sem = $FG5_3rdy2sem = 0;
                            $scode6_3rdy2sem = $desc6_3rdy2sem = $unit6_3rdy2sem = $FG6_3rdy2sem = 0;
                            $scode7_3rdy2sem = $desc7_3rdy2sem = $unit7_3rdy2sem = $FG7_3rdy2sem = 0;
                            $scode8_3rdy2sem = $desc8_3rdy2sem = $unit8_3rdy2sem = $FG8_3rdy2sem = 0;
                            $scode9_3rdy2sem = $desc9_3rdy2sem = $unit9_3rdy2sem = $FG9_3rdy2sem = 0;
                            $scode10_3rdy2sem = $desc10_3rdy2sem = $unit10_3rdy2sem = $FG10_3rdy2sem = 0;
                            $total3rdy2sem_units = 0;

                        }


                        ?>

                            <!---------------------------THIRD YEAR START------------------------->

                            <table > 
                                <tr>
                                <th style="width:3500px;border:1px solid black;font-size:12px;"><center><b>THIRD YEAR | S.Y.:<!--year--></b></center></th>
                                </tr>
                        
                            <table  style="width:90%;">

                            <table >

                                <tr>
                                    <td style="width: 287px; border: 1px solid black; font-size: 12px;"><center><b>FIRST SEMESTER</b></center></td>
                                    <td style="width: 56px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><!--ssection--></b></center></td>

                                    

                                    <td style="width: 289px; border: 1px solid black; font-size: 12px;"><center><b>SECOND SEMESTER</b></center></td>
                                    <td style="width: 55px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><!--ssection--></b></center></td>

                                </tr>

                            </table>

                            <table style="border-collapse:collapse">

                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>SUB. CODE</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><b>SUB. CODE</b></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>

                                </tr>

                                <!-- subject 1-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode1_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode1_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_3rdy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_3rdy1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_3rdy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_3rdy1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_3rdy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><<?php echo $unit4_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_3rdy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_3rdy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_3rdy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_3rdy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_3rdy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_3rdy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_3rdy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_3rdy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_3rdy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_3rdy1sem; ?></b></center></td>
                                

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_3rdy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_3rdy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_3rdy2sem; ?></b></center></td>

                                </tr>


                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total3rdy1sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php ?></b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total3rdy2sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><? php ?></b></center></td>

                                </tr>
                            </table>

                              <!---------------------------THIRD YEAR END------------------------->


                              <?php
                              $con = mysqli_connect("localhost", "root", "", "uccevaluation");

                              if(!$con) {
                                  die("Connection Error");
                              }

                              $id = $_GET['id'];
                              // Initialize variables
                              
                              //Get yje data of firstyear 1st sem
                              
                              $sqlCheck4thyear1sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                              if($rowCheck = mysqli_fetch_assoc($sqlCheck4thyear1sem)) {
                                  // If the condition is met, proceed to fetch and display the data
                                  $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                                  if($row = mysqli_fetch_assoc($sql)) {

                                      $scode1_4thy1sem = $row['scode1'];
                                      $desc1_4thy1sem = $row['desc1'];
                                      $unit1_4thy1sem = $row['unit1'];
                                      $FG1_4thy1sem = $row['FG1'];

                                      $scode2_4thy1sem = $row['scode2'];
                                      $desc2_4thy1sem = $row['desc2'];
                                      $unit2_4thy1sem = $row['unit2'];
                                      $FG2_4thy1sem = $row['FG2'];

                                      $scode3_4thy1sem = $row['scode3'];
                                      $desc3_4thy1sem = $row['desc3'];
                                      $unit3_4thy1sem = $row['unit3'];
                                      $FG3_4thy1sem = $row['FG3'];

                                      $scode4_4thy1sem = $row['scode4'];
                                      $desc4_4thy1sem = $row['desc4'];
                                      $unit4_4thy1sem = $row['unit4'];
                                      $FG4_4thy1sem = $row['FG4'];

                                      $scode5_4thy1sem = $row['scode5'];
                                      $desc5_4thy1sem = $row['desc5'];
                                      $unit5_4thy1sem = $row['unit5'];
                                      $FG5_4thy1sem = $row['FG5'];

                                      $scode6_4thy1sem = $row['scode6'];
                                      $desc6_4thy1sem = $row['desc6'];
                                      $unit6_4thy1sem = $row['unit6'];
                                      $FG6_4thy1sem = $row['FG6'];

                                      $scode7_4thy1sem = $row['scode7'];
                                      $desc7_4thy1sem = $row['desc7'];
                                      $unit7_4thy1sem = $row['unit7'];
                                      $FG7_4thy1sem = $row['FG7'];

                                      $scode8_4thy1sem = $row['scode8'];
                                      $desc8_4thy1sem = $row['desc8'];
                                      $unit8_4thy1sem = $row['unit8'];
                                      $FG8_4thy1sem = $row['FG8'];

                                      $scode9_4thy1semm = $row['scode9'];
                                      $desc9_4thy1sem = $row['desc9'];
                                      $unit9_4thy1sem = $row['unit9'];
                                      $FG9_4thy1sem = $row['FG9'];

                                      $scode10_4thy1sem = $row['scode10'];
                                      $desc10_4thy1sem = $row['desc10'];
                                      $unit10_4thy1sem = $row['unit10'];
                                      $FG10_4thy1sem = $row['FG10'];

                                      $total4thy1sem_units = 0;
                                      $total4thy1sem_units += is_numeric($unit1_4thy1sem) ? $unit1_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit2_4thy1sem) ? $unit2_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit3_4thy1sem) ? $unit3_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit4_4thy1sem) ? $unit4_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit5_4thy1sem) ? $unit5_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit6_4thy1sem) ? $unit6_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit7_4thy1sem) ? $unit7_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit8_4thy1sem) ? $unit8_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit9_4thy1sem) ? $unit9_4thy1sem : 0;
                                      $total4thy1sem_units += is_numeric($unit10_4thy1sem) ? $unit10_4thy1sem : 0;

                                  }
                              } else {
                                  // If the condition is not met, set variables to null
                                  $scode1_4thy1sem = $desc1_4thy1sem = $unit1_4thy1sem = $FG1_4thy1sem = 0;
                                  $scode2_4thy1sem = $desc2_4thy1sem = $unit2_4thy1sem = $FG2_4thy1sem = 0;
                                  $scode3_4thy1sem = $desc3_4thy1sem = $unit3_4thy1sem = $FG3_4thy1sem = 0;
                                  $scode4_4thy1sem = $desc4_4thy1sem = $unit4_4thy1sem = $FG4_4thy1sem = 0;
                                  $scode5_4thy1sem = $desc5_4thy1sem = $unit5_4thy1sem = $FG5_4thy1sem = 0;
                                  $scode6_4thy1sem = $desc6_4thy1sem = $unit6_4thy1sem = $FG6_4thy1sem = 0;
                                  $scode7_4thy1sem = $desc7_4thy1sem = $unit7_4thy1sem = $FG7_4thy1sem = 0;
                                  $scode8_4thy1sem = $desc8_4thy1sem = $unit8_4thy1sem = $FG8_4thy1sem = 0;
                                  $scode9_4thy1sem = $desc9_4thy1sem = $unit9_4thy1sem = $FG9_4thy1sem = 0;
                                  $scode10_4thy1sem = $desc10_4thy1sem = $unit10_4thy1sem = $FG10_4thy1sem = 0;
                                  $total4thy1sem_units = 0;

                              }

                              //Get the data of first year 2ndsem
                              
                              // Check if the year is '1ST' and the semester is '2ND'
                              $sqlCheck4thyear2sem = mysqli_query($con, "SELECT * FROM $tableName WHERE sno = '$id' AND year1='1ST' AND semester='2ND'");
                              if($rowCheck = mysqli_fetch_assoc($sqlCheck4thyear2sem)) {
                                  // If the condition is met, proceed to fetch and display the data
                                  $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5, scode6, desc6, unit6, FG6, scode7, desc7, unit7, FG7, scode8, desc8, unit8, FG8, scode9, desc9, unit9, FG9, scode10, desc10, unit10, FG10 FROM $tableName WHERE sno = '$id'");

                                  if($row = mysqli_fetch_assoc($sql)) {
                                      // Your existing code to assign values to variables goes here
                                      $scode1_4thy2sem = $row['scode1'];
                                      $desc1_4thy2sem = $row['desc1'];
                                      $unit1_4thy2sem = $row['unit1'];
                                      $FG1_4thy2sem = $row['FG1'];

                                      $scode2_4thy2sem = $row['scode2'];
                                      $desc2_4thy2sem = $row['desc2'];
                                      $unit2_4thy2sem = $row['unit2'];
                                      $FG2_4thy2sem = $row['FG2'];

                                      $scode3_4thy2sem = $row['scode3'];
                                      $desc3_4thy2sem = $row['desc3'];
                                      $unit3_4thy2sem = $row['unit3'];
                                      $FG3_4thy2sem = $row['FG3'];

                                      $scode4_4thy2sem = $row['scode4'];
                                      $desc4_4thy2sem = $row['desc4'];
                                      $unit4_4thy2sem = $row['unit4'];
                                      $FG4_4thy2sem = $row['FG4'];

                                      $scode5_4thy2sem = $row['scode5'];
                                      $desc5_4thy2sem = $row['desc5'];
                                      $unit5_4thy2sem = $row['unit5'];
                                      $FG5_4thy2sem = $row['FG5'];

                                      $scode6_4thy2sem = $row['scode6'];
                                      $desc6_4thy2sem = $row['desc6'];
                                      $unit6_4thy2sem = $row['unit6'];
                                      $FG6_4thy2sem = $row['FG6'];

                                      $scode7_4thy2sem = $row['scode7'];
                                      $desc7_4thy2sem = $row['desc7'];
                                      $unit7_4thy2sem = $row['unit7'];
                                      $FG7_4thy2sem = $row['FG7'];

                                      $scode8_4thy2sem = $row['scode8'];
                                      $desc8_4thy2sem = $row['desc8'];
                                      $unit8_4thy2sem = $row['unit8'];
                                      $FG8_4thy2sem = $row['FG8'];

                                      $scode9_4thy2sem = $row['scode9'];
                                      $desc9_4thy2sem = $row['desc9'];
                                      $unit9_4thy2sem = $row['unit9'];
                                      $FG9_4thy2sem = $row['FG9'];

                                      $scode10_4thy2sem = $row['scode10'];
                                      $desc10_4thy2sem = $row['desc10'];
                                      $unit10_4thy2sem = $row['unit10'];
                                      $FG10_4thy2sem = $row['FG10'];

                                      $total4thy2sem_units = 0;
                                      $total4thy2sem_units += is_numeric($unit1_4thy2sem) ? $unit1_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit2_4thy2sem) ? $unit2_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit3_4thy2sem) ? $unit3_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit4_4thy2sem) ? $unit4_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit5_4thy2sem) ? $unit5_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit6_4thy2sem) ? $unit6_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit7_4thy2sem) ? $unit7_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit8_4thy2sem) ? $unit8_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit9_4thy2sem) ? $unit9_4thy2sem : 0;
                                      $total4thy2sem_units += is_numeric($unit10_4thy2sem) ? $unit10_4thy2sem : 0;

                                  }
                              } else {
                                  // If the condition is not met, set variables to null
                                  $scode1_4thy2sem = $desc1_4thy2sem = $unit1_4thy2sem = $FG1_4thy2sem = 0;
                                  $scode2_4thy2sem = $desc2_4thy2sem = $unit2_4thy2sem = $FG2_4thy2sem = 0;
                                  $scode3_4thy2sem = $desc3_4thy2sem = $unit3_4thy2sem = $FG3_4thy2sem = 0;
                                  $scode4_4thy2sem = $desc4_4thy2sem = $unit4_4thy2sem = $FG4_4thy2sem = 0;
                                  $scode5_4thy2sem = $desc5_4thy2sem = $unit5_4thy2sem = $FG5_4thy2sem = 0;
                                  $scode6_4thy2sem = $desc6_4thy2sem = $unit6_4thy2sem = $FG6_4thy2sem = 0;
                                  $scode7_4thy2sem = $desc7_4thy2sem = $unit7_4thy2sem = $FG7_4thy2sem = 0;
                                  $scode8_4thy2sem = $desc8_4thy2sem = $unit8_4thy2sem = $FG8_4thy2sem = 0;
                                  $scode9_4thy2sem = $desc9_4thy2sem = $unit9_4thy2sem = $FG9_4thy2sem = 0;
                                  $scode10_4thy2sem = $desc10_4thy2sem = $unit10_4thy2sem = $FG10_4thy2sem = 0;
                                  $total4thy2sem_units = 0;

                              }


                              ?>

                              <!---------------------------FOURTH YEAR START------------------------->

                            <table > 
                                <tr>
                                <th style="width:3500px;border:1px solid black;font-size:12px;"><center><b>FOURTH YEAR | S.Y.:<!--year--></b></center></th>
                                </tr>
                        
                            <table  style="width:90%;">

                            <table >

                                <tr>
                                    <td style="width: 287px; border: 1px solid black; font-size: 12px;"><center><b>FIRST SEMESTER</b></center></td>
                                    <td style="width: 56px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><!--ssection--></b></center></td>

                                    

                                    <td style="width: 289px; border: 1px solid black; font-size: 12px;"><center><b>SECOND SEMESTER</b></center></td>
                                    <td style="width: 55px; border: 1px solid black; font-size: 12px;"><center><b>Sec.:</b></center></td>
                                    <td style="width: 60px; border: 1px solid black; font-size: 12px;"><center><b><!--ssection--></b></center></td>

                                </tr>

                            </table>

                            <table style="border-collapse:collapse">

                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>SUB. CODE</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>


                                <td style="width:70px;border:1px solid black;font-size:12px;"><b>SUB. CODE</b></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>SUBJECT DESCRIPTION</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>

                                </tr>

                                <!-- subject 1-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode1_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode1_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc1_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit1_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG1_4thy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_4thy1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode2_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc2_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit2_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG2_4thy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_4thy1sem; ?></b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode3_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc3_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit3_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG3_4thy2sem; ?></b></center></td>

                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode4_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc4_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit4_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG4_4thy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode5_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc5_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit5_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG5_4thy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode6_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc6_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit6_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG6_4thy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode7_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc7_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit7_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG7_4thy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode8_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc8_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit8_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG8_4thy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_4thy1semm; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode9_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc9_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit9_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG9_4thy2sem; ?></b></center></td>

                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_4thy1sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_4thy1sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_4thy1sem; ?></b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b><?php echo $scode10_4thy2sem; ?></b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b><?php echo $desc10_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $unit10_4thy2sem; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $FG10_4thy2sem; ?></b></center></td>

                                </tr>


                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total4thy1sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php ?></b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php echo $total4thy2sem_units; ?></b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b><?php ?></b></center></td>

                                </tr>
                                </table>
                            <!---------------------------FOURTH YEAR END------------------------->

                        </div>

                </table>
            </div>
        </div>
    </center>

        </div>

        </div>

        

        <!--Script-->
        <script src="../js/vendor/jquery-1.12.4.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/wow.min.js"></script>
        <script src="../js/jquery-price-slider.js"></script>
        <script src="../js/owl.carousel.min.js"></script>
        <script src="../js/jquery.scrollUp.min.js"></script>
        <script src="../js/meanmenu/jquery.meanmenu.js"></script>
        <script src="../js/counterup/jquery.counterup.min.js"></script>
        <script src="../js/counterup/waypoints.min.js"></script>
        <script src="../js/counterup/counterup-active.js"></script>
        <script src="../js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="../js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="../js/jvectormap/jvectormap-active.js"></script>
        <script src="../js/sparkline/jquery.sparkline.min.js"></script>
        <script src="../js/sparkline/sparkline-active.js"></script>
        <script src="../js/flot/jquery.flot.js"></script>
        <script src="../js/flot/jquery.flot.resize.js"></script>
        <script src="../js/flot/jquery.flot.pie.js"></script>
        <script src="../js/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../js/flot/jquery.flot.orderBars.js"></script>
        <script src="../js/flot/curvedLines.js"></script>
        <script src="../js/flot/flot-active.js"></script>
        <script src="../js/knob/jquery.knob.js"></script>
        <script src="../js/knob/jquery.appear.js"></script>
        <script src="../js/knob/knob-active.js"></script>
        <script src="../js/wave/waves.min.js"></script>
        <script src="../js/wave/wave-active.js"></script>
        <script src="../js/todo/jquery.todo.js"></script>
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
    <!--End Script-->

</body>

</html>