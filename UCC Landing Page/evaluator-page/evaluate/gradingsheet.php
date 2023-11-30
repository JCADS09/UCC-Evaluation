

<?php
require_once('db.php');
$query = "SELECT * from students";
$result = mysqli_query($con, $query);
?>

&nbsp<!DOCTYPE html>


<head>
    <link rel="icon" href="images/logo.jpg">

    <title>Grading Sheet</title>

     <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/styles.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="asset/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="asset/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
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
    <link rel="stylesheet" href="../../css/jvectormap/jquery-jvectormap-2.0.3.css">
    <link rel="stylesheet" href="../../css/notika-custom-icon.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/wave/waves.min.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/responsive.css">
    <link rel="stylesheet" href="../../topbarcss/topbar.css">
    <script src="../../js/vendor/modernizr-2.8.3.min.js"></script>
<!--End Links--> 
    <script src="datatables/jquery.dataTables.js"></script>
    <script src="datatables/dataTables.bootstrap.js"></script>
        <link href="datatables/dataTables.bootstrap.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js"></script>
    <script src="asset/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/js/jq.js"></script>
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
/** form-box 
.form-box{
    width: 816px;
    height: 1344px;
    position: relative;
    margin: 2% auto;
    background: white;
    padding: 5px;
    overflow: hidden;
    box-shadow: 0 8px 16px 0 rgb(0, 0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, 0, .19);
}
*/
	</style>

</head> 

<html>

<?php 
include 'db.php';
session_start();

	$id = $_GET['id'];

	$query = mysqli_query($con,"SELECT * FROM students where sno = '$id' ");
	$row = mysqli_fetch_assoc($query);
	$student = $row['fname'].' '. $row['sname'];

?>

<!-- history log inserted in php   
$user = $_SESSION['id'];
	mysqli_query($conn, "INSERT into history_log (transaction,user_id,date_added) 
		VALUES ('printed $student permanent record','$user',NOW() )");

-->

<body style="background-color:white"> 
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
                        <a href="../MIS_StudentData/studentdata.php">
                                <img src="../../system-img/student.png" width="25" height="25"> Students Records
                            </a>
                        </li>

                        <li class="tab">
                        <a href="../scholastic/students.php">
                                <img src="../../system-img/pencil.png" width="25" height="25"> Evaluate Student
                            </a>
                        </li>

                        <li class="active">
                            <a href="gradingsheet.php">
                                <img src="../../system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu area End-->

<span id='returncode'></span>
<div class="col-md-2" id="head">
	<button class="btn btn-info" onclick="print()"><i class="glyphicon glyphicon-print"></i>PRINT</button>
	<a class="btn btn-info" onclick="window.close()">Cancel</a>
	
</div>
<center>
<div id='print'>
<div style="margin-left:.5in;margin-right:.5in;margin-top:.1in;margin-bottom:.1in;line-height:1mm;">

            <img src="images/ucclogo.png"width="190"height="190"style="position:absolute;left:28%;top:5.5%;">
            <img src="images/cc.png"width="110"height="110" style="position:absolute;left:63%;top:10%">

		<h2><center><b>University of Caloocan City</b></center></h2>
        <p><center><b><i>Biglang Awa St., Avenue East, Caloocan City</i></b></center></p>
		  </div>
		  <div class="row">
		  <div class="col-md-12">
		  <center><p><b><h2>GRADING SHEET</h2></b></p></center><br>
		  </div>
          </div>
          <div class="row">
		  <div class="col-md-12">

		  <table style="line-height:5mm">
		<?php 
		include 'db.php';
		$id = $_GET['id'];
		$sql = mysqli_query($con,"SELECT * from students where sno = '$id'");
		while($row = mysqli_fetch_assoc($sql)){
			$mid = $row['mname'];
		?>
			<tr>
				<td style="width:600px;font-size:15px;font-family:Rockwell;">
                <label for="">Course:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<u><h style="font-size:15px"><?php echo $row['course'] ?></u>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h>

                    <u><h style="font-size:15px"><?php echo $row['semester'] ?></h></u>
                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbspSemester&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                    <u><h style="font-size:15px"><?php echo $row['sy1']. ' - ' .$row['sy2'] ?></u></h>
                    <br>

					<b><label for="">Subject Description:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<u><h style="font-size:15px"><?php echo $row['desc1'] ?></u></h>

                    
                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspYear and Section:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<u><h style="font-size:15px"><?php echo $row['year1'].''.$row['section']; ?></u></h>
                    <br>

                    <b><label for="">Subject Code:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<u><h style="font-size:15px"><?php echo $row['scode1'] ?></u></h>
                    
                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUnits:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<u><h style="font-size:15px"><?php echo $row['unit1'] ?></u></h>
					
                    <br>
                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        Day:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					

                    <br>
                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        Time:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
				</td>	
			</tr>		
			</table>
            <?php } ?>

            <!-- Table -->

            <table class="table table-bordered text-center" style="border-collapse:collapse">
		        <tr>
		            <th style="width:10px;border:1px solid black;font-size:12px;"><center><b>No.</b></center></th>
		            <td style="width:60px;border:1px solid black;font-size:12px;"><center><b>Subj. Code</b></center></th>
		            <td style="width:60px;border:1px solid black;font-size:12px;"><center><b>Description</b></center></th>
                    <td style="width:10px;border:1px solid black;font-size:12px;"><center><b>Final Grade</b></center></th>
                    <td style="width:10px;border:1px solid black;font-size:12px;"><center><b>Unit</b></center></th>
                    
		        </tr>
        
		<!--
		$syi = $row1['scode1'];
		$sql2 = mysqli_query($con,"SELECT * FROM students where scode1 = '$syi' order by desc1");
		$num4 = mysqli_num_rows($sql2);
		while($row2 = mysqli_fetch_assoc($sql2)){
			$sub = $row2['desc1'];
		$sql3 = mysqli_query($conn,"SELECT * FROM students where desc1 = '$sub'");
		while($row3 = mysqli_fetch_assoc($sql3)){

        -->
		<tr>
		<!--<td style="width:150px;border:1px solid black;font-size:10px;height:15px">-->
        <?php
            include 'db.php';
            $id = $_GET['id'];
            $sql=  mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5 FROM students where sno = '$id' ");
            while($row = mysqli_fetch_assoc($sql)) {
        ?>
                <tr>
                    <?php
                        $i=1;
                    ?>

                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['scode1']; ?></td>
                        <td><?php echo $row['desc1']; ?></td>
                        <td><?php echo $row['FG1']; ?></td>  
                        <td><?php echo $row['unit1']; ?></td>  
                </tr>

                <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['scode2']; ?></td>
                        <td><?php echo $row['desc2']; ?></td>
                        <td><?php echo $row['FG2']; ?></td> 
                        <td><?php echo $row['unit2']; ?></td>  
                </tr>

                <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['scode3']; ?></td>
                        <td><?php echo $row['desc3']; ?></td>
                        <td><?php echo $row['FG3']; ?></td>  
                        <td><?php echo $row['unit3']; ?></td>  
                </tr>

                <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['scode4']; ?></td>
                        <td><?php echo $row['desc4']; ?></td>
                        <td><?php echo $row['FG4']; ?></td>  
                        <td><?php echo $row['unit4']; ?></td>  
                </tr>

                <tr>
                        <td><?php echo $i++;?></td>
                        <td><?php echo $row['scode5']; ?></td>
                        <td><?php echo $row['desc5']; ?></td>
                        <td><?php echo $row['FG5']; ?></td>  
                        <td><?php echo $row['unit5']; ?></td>  
                </tr>

                
                <?php
                    } mysqli_close($con);
                ?>
		
        <!--
		<td style="width:60px;border:1px solid black;font-size:10px;height:15px;text-align:center"><?php echo $row2['FINAL_GRADES'] ?></td>
		<td style="width:60px;border:1px solid black;font-size:10px;height:15px"><?php echo $row2['UNITS'] ?></td>
		<td style="width:83px;border:1px solid black;font-size:10px;height:15px"><center><?php echo $row2['PASSED_FAILED'] ?></center></td>
		

		
		
	}		
	}	
			for($q = $num4; $q < 15 ; $q++){
		 ?>
         
	        }
		 ?>
        -->

        </div>
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

