<?php
require_once('db.php');
$query = "SELECT * from 202220232ndsemcongress ";
$result = mysqli_query($con, $query);
?>
<?php
include 'db.php';
session_start();

$id = $_GET['id'];

$query = mysqli_query($con, "SELECT * FROM 202220232ndsemcongress where sno = '$id' ");
$row = mysqli_fetch_assoc($query);
$student = $row['fname'].' '.$row['sname'];

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Deficiency</title>
    <link rel="shortcut icon" type="image/x-icon" href="../system-img/check.png">

        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
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
    height: 1200px;
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
          <center><p><b><h4>DEFICIENCY</h4></b></p></center><br>
          </div>
          </div>
          <div class="row">
          <div class="col-md-12">

          <table style="line-height:5mm">
        <?php
        include 'db.php';
        $id = $_GET['id'];
        $sql = mysqli_query($con, "SELECT * from 202220232ndsemcongress where sno = '$id'");
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
                    </table>
            <?php } ?>
<br>
            <table class="table table-bordered text-center" style="border: 1px solid black;border-collapse:collapse;width:90%;">
                <tr>
                    <thead style="background-color:#393b39;color:white;font-family:arial;">
                    <td style="width:10px;border:1px solid black;font-size:13px;"><center><b>No.</b></center></td>
                    <td style="width:60px;border:1px solid black;font-size:13px;"><center><b>Subj. Code</b></center></td>
                    <td style="width:150px;border:1px solid black;font-size:13px;"><center><b>Description</b></center></td>
                    <td style="width:10px;border:1px solid black;font-size:13px;"><center><b>Unit</b></center></td>
                    <td style="width:10px;border:1px solid black;font-size:13px;"><center><b>Midterm</b></center></td>
                    <td style="width:10px;border:1px solid black;font-size:13px;"><center><b>Final Term</b></center></td>
                    <td style="width:10px;border:1px solid black;font-size:13px;"><center><b>Final Grade</b></center></td>

                </tr>
                </thead>
        
        <tr>
        <?php
        include 'db.php';
        $id = $_GET['id'];
        $sql = mysqli_query($con, "SELECT scode1, desc1, unit1, MT1, FT1, FG1, scode2, desc2, unit2, MT2, FT2, FG2, scode3, desc3, unit3, MT3, FT3, FG3, scode4, desc4, unit4, MT4, FT4, FG4, scode5, desc5, unit5, MT5, FT5, FG5, scode6, desc6, unit6, MT6, FT6, FG6, scode7, desc7, unit7, MT7, FT7, FG7, scode8, desc8, unit8, MT8, FT8, FG8, scode9, desc9, unit9, MT9, FT9, FG9, scode10, desc10, unit10, MT10, FT10, FG10 FROM 202220232ndsemcongress  where sno = '$id' ");

        while($row = mysqli_fetch_assoc($sql)) {
            ?>
                        <tr>
                    
                            <?php
                            $i = 1;
                            for($j = 1; $j <= 10; $j++) {
                                $scodeKey = 'scode'.$j;
                                $descKey = 'desc'.$j;
                                $MTKey = 'MT'.$j;
                                $FTKey = 'FT'.$j;
                                $FGKey = 'FG'.$j;
                                $unitKey = 'unit'.$j;

                                $highlight = ($row[$MTKey] == '3.00' || $row[$FTKey] == '3.00' || $row[$FGKey] == '3.00' || $row[$MTKey] == '0.00' || $row[$FTKey] == '0.00' || $row[$FGKey] == '0.00');

                                if(!empty($row[$scodeKey])) {
                                    echo '<tr>';
                                    echo '<td><center>'.$i++.'</td>';
                                    echo '<td><center>'.$row[$scodeKey].'</td>';
                                    echo '<td>'.$row[$descKey].'</td>';
                                    echo '<td><center>'.$row[$unitKey].'</center></td>';
                                    echo '<td'.($highlight ? ' style="background-color: red;color:white;"' : '').'><center>'.$row[$MTKey].'</td>';
                                    echo '<td'.($highlight ? ' style="background-color: red;color:white;"' : '').'><center>'.$row[$FTKey].'</center></td>';
                                    echo '<td'.($highlight ? ' style="background-color: red;color:white;"' : '').'><center>'.$row[$FGKey].'</center></td>';
                                    echo '</tr>';
                                }
                            }
        }
        ?>
                </tr>
                </table>
                <br>
                
        </div>
        
        </div>

        </div>

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



    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

</body>

</html>