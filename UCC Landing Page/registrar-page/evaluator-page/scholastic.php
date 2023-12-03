<?php
require_once('db.php');
$query = "SELECT * from student2ndsem20212022";
$result = mysqli_query($con, $query);
?>
<?php 
include 'db.php';
session_start();

	$id = $_GET['id'];

	$query = mysqli_query($con,"SELECT * FROM student2ndsem20212022 where sno = '$id' ");
	$row = mysqli_fetch_assoc($query);
	$student = $row['fname'].' '. $row['sname'];

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Summary of Grades</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../system-img/check.png">
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="MIS_StudentData/css/bootstrap.min.css">
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
                            <a href="../../evaluatornav.php">
                                <img src="../../system-img/home.png" width="28" height="27"> Dashboard
                            </a>
                        </li>

                        <li class="tab">
                            <a href="Student.php">
                                <img src="../../system-img/student.png" width="25" height="25"> Students
                            </a>
                        </li>

                        <li class="tab">
                            <a href="scholastic/students.php" style="background-color:#ff8e1c;color:white;">
                                <img src="../../system-img/pencil.png" width="25" height="25"> Evaluate Student
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
<img src="../../images/ucclogo.png"width="50"height="50"style="position:absolute;left: 0;">
<i><h6 style="position:absolute;left: 6%;top:2%;font-family:Poppins;">University of Caloocan City - Evaluation Form</h6></i>
<div style="margin-left:.5in;margin-right:.5in;margin-top:.1in;margin-bottom:.1in;line-height:1mm;">
<div style="margin-top:10%;font-family:arial;">
		<h2><center><b>University of Caloocan City</b></center></h2>
</div>
        <p><center><i>Biglang Awa St., Avenue East, Caloocan City</i></center></p>
            
		  </div>
		  <div class="row">
		  <div class="col-md-12">
		  <center><p><b><h4>SCHOLASTIC</h4></b></p></center><br>
		  </div>
          </div>
          <div class="row">
		  <div class="col-md-12">

            <table style="line-height:5mm">
                <?php 
                include 'db.php';
                $id = $_GET['id'];
                $sql = mysqli_query($con,"SELECT * from student2ndsem20212022 where sno = '$id'");
                while($row = mysqli_fetch_assoc($sql)){
                    $mid = $row['mname'];
                ?>
                    <tr>
                        <td style="width:600px;font-size:15px;font-family:arial;">
                        
                            <b><label for="" style="margin-left:71%;">A.Y.:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                            <u><h style="font-size:15px"><?php echo $row['sy1']. ' - ' .$row['sy2'] ?></u></h>
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

                <?php } ?>
                     
            
            </table>

            <!-- Scholastic -->

            <center>
        <div id='print'>
           
                <div class="col-md-12">
                    <table style="line-height:5mm">
                    <!-- Table -->

                    <!--Header of the table yung school year-->

                        <table > 
                                <tr>
                                <th style="width:3500px;border:1px solid black;font-size:12px;"><center><b>FIRST YEAR | S.Y.:<!--year--></b></center></th>
                                </tr>
                        
                        <table  style="width:90%;">

                    <!--end header-->

                     <!---------------------------FIRST YEAR START------------------------->

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

                    <div style="text-align: left; display: inline-block;">
                       

                           
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
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>

                                
                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                               
                                </tr>
                            </table>
                            <!---------------------------FIRST YEAR END------------------------->

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
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>


                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                            </table>

                            <!---------------------------SECOND YEAR END------------------------->

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
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>


                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                            </table>

                              <!---------------------------THIRD YEAR END------------------------->

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
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 2-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 3-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem-->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>

                                <!-- subject 4-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 5-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 6-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 7-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 8-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 9-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                <!-- subject 10-->
                                <!-- first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!-- second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:176px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>


                                <!-- total first sem -->
                                <tr>
                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                <!--total second sem -->

                                <td style="width:70px;border:1px solid black;font-size:12px;"><center><b></b></center></td>
                                <td style="width:176px; border:1px solid black; font-size:12px; text-align: right; color: red;"><b>TOTAL</b></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>
                                <td style="width:50px;border:1px solid black;font-size:12px;"><center><b>0</b></center></td>

                                </tr>
                                </table>
                            <!---------------------------THIRD YEAR END------------------------->

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