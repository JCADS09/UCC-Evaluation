&nbsp<!DOCTYPE html>
<html>
<?php 
include 'db.php';
session_start();
//$user = $_SESSION['ID'];
	$id = $_GET['id'];

	$query = mysqli_query($con,"SELECT * FROM student2ndsem20212022 where sno = '$id' ");
	$row = mysqli_fetch_assoc($query);
	//$student = $row['fname'].' '. $row['sname'];

	//($con, "INSERT into history_log (transaction,user_id,date_added) 
		//VALUES ('printed $student permanent record','$user',NOW() )");



?>
<head>
    <title>Scholastic</title>


    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/styles.css" rel="stylesheet">

    <link href="asset/css/sb-admin.css" rel="stylesheet">


    <link href="asset/css/plugins/morris.css" rel="stylesheet">


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
		margin-left:50px;
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

.foo{
	font-family: Arial;
	font-size: 24px;
	font-variant: normal;
	font-weight: bold;
	line-height: 24px;
	}
	.p {
	font-family: Arial;
	font-size: 14px;
	font-variant: normal;
	font-weight: 550;
	line-height: 20px;
	 letter-spacing: 2px;
}
	</style>

</head> 

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

                        <li class="active">
                            <a href="students.php">
                                <img src="../../system-img/pencil.png" width="25" height="25"> Evaluate Student
                            </a>
                        </li>

                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu area End-->

<center><h1> UNIVERSITY OF CALOOCAN CITY</h1> </center>

<span id='returncode'></span>
<div class="col-md-2" id="head">
	<button class="btn btn-info" onclick="print()"><i class="glyphicon glyphicon-print"></i>PRINT</button>
	<a class="btn btn-info" onclick="window.close()">Cancel</a>
	
</div>
<center>
<div id='print'>
<div style="margin-left:.5in;margin-right:.5in;margin-top:.1in;margin-bottom:.1in;line-height:1mm;">

		<p><center><b>Biglang Awa St. East Grace Park, Caloocan City</b></center></p>

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
			<tr style="font-family:Arial;">
				<td style="width:600px;font-size:12px">
					<label for="" style=""><b>Name:</b>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<a style="font-size:13px;text-transform: uppercase;"><?php echo $row['sname'].", " .  $row['fname']. " " .  substr("$mid",0,1) . "."; ?></a>
					<br>
					<label for=""><b>Address:</b>&nbsp&nbsp&nbsp</label>
					<h style="font-size:12px"><?php echo "Temporary Address" ?></h>
					
				</td>
				<td style="width:600px;font-size:12px">
				<label for=""><b>Course/Yr/Sec:</b>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:12px"><?php echo $row['course']." " .  $row['year1']. " " .  $row['section']; ?></h>
					<br>
                    <label for=""><b>Student Number:</b>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:12px;text-transform: capitalize"><?php echo $row['sno'] ?></h>
				</td>
				
			</tr>

			</table> 
			<table>
			<tr style="font-family:Arial;">
			<td style="width:1000px;font-size:12px;align:left">
				
					<label for=""><b>Birthday:</b>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:12px;text-transform: capitalize"><?php echo "October 02, 1999" ?></h>
                    
				</td>
				<td style="width:1080px;font-size:12px;align:left">
				<label for=""><b>Birth Place:</b>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:12px;text-transform: capitalize"><?php echo "Sample City" ?></h>
					
				</td>
			</tr>

			</table>
			<table>
			
			<tr style="font-family:Arial;">
			<td style="width:1000px;font-size:12px;align:left">

				
					<label for=""><b>Elementary School:</b>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:12px;text-transform: capitalize"><?php echo "Sample Elementary School" ?></h>
				
			</td>
            <td style="width:1040px;font-size:12px">
				<label for=""><b>Year Graduated:</b>&nbsp</label>
					<h style="text-transform: capitalize"><?php echo "2005" ?></h>
			</td>
			</tr>
			
			</table> 
			<table>
			<tr style="font-family:Arial;">

			<td style="width:800px;font-size:12px">

				
					<label for=""><b>Junior High School:</b>&nbsp</label>
					<h style="text-transform: capitalize"><?php echo "Sample High School" ?></h>
				
			</td>
			<td style="width:800px;font-size:12px">
				<label for=""><b>Year Graduated:</b>&nbsp</label>
					<h style="text-transform: capitalize"><?php echo "2013" ?></h>
			</td>
			</tr>
		</table>
        <table>
			<tr style="font-family:Arial;">

			<td style="width:800px;font-size:12px">

				
					<label for=""><b>Senior High School:</b>&nbsp</label>
					<h style="text-transform: capitalize"><?php echo "Sample Senior High School" ?></h>
				
			</td>
			<td style="width:800px;font-size:12px">
				<label for=""><b>Year Graduated:</b>&nbsp</label>
					<h style="text-transform: capitalize"><?php echo "2019" ?></h>
			</td>
			</tr>
		</table>
        
		<?php } ?>
		  </div>
          </div>
          <div class="row">
          <div class="col-md-12">
          <hr style="border-color:black;border:1px solid black"></hr>
          </div>
          
          </div>

          <p style="">
          <?php
		$sql1 = mysqli_query($con, "SELECT sy1, sy2 FROM student2ndsem20212022
        WHERE sno = '$id'");
$num1 = mysqli_num_rows($sql1);
		
		while($row1 = mysqli_fetch_assoc($sql1)){
		?>

		<table style="float:left;margin-left:5px;margin-bottom:20px;">
		<tr>
		<td>  
		<table>
			<tr style="width:100%">
			<td>
         
			<label style="font-size:12px">FIRST YEAR S.Y.:&nbsp&nbsp</label>
			</td>
			<td style="tetx-align:center;border-bottom:1px solid black;">
		<label style="font-size:12px"><?php echo $row1['sy1'].'-'.$row1['sy2']; ?> </label>
		</td>
		</tr>
		</table>
		
		<table style="border-collapse:collapse">
		<tr>
		<td style="width:10px;border:1px solid black;font-size:12px;"><center><b>Subj. Code</b></center></td>
		<td style="width:250px;border:1px solid black;font-size:12px;"><center><b>Subject Description</b></center></td>
		<td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>
		<td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
		</tr>
        <br><br>
		<?php
		
		for($p = 0 ; $p < 7 ; $p++){
		 ?>
		
		<tr>
		<td style="width:10px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:60px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:60px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:83px;border:1px solid black;font-size:12px;height:15px"></td>
		</tr>
		<?php 
	}
		?>
		<tr>
		
		</tr>
        <?php
		
		for($p = 0 ; $p < 7 ; $p++){
		 ?>
		
		<tr>
		<td style="width:50px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:40px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:10px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:83px;border:1px solid black;font-size:12px;height:15px"></td>
		</tr>
		<?php 
	}
		?>
		<tr>
		
		</tr>


		

		
		
		<table style="border-collapse:collapse">
		<tr>
		<td style="width:70px;border:1px solid black;font-size:12px;"><center><b>Subj. Code</b></center></td>
		<td style="width:250px;border:1px solid black;font-size:12px;"><center><b>Subject Description</b></center></td>
		<td style="width:50px;border:1px solid black;font-size:12px;"><center><b>GRADE</b></center></td>
		<td style="width:50px;border:1px solid black;font-size:12px;"><center><b>UNIT</b></center></td>
		</tr>
        <br><br>
		<?php
		
		for($p = 0 ; $p < 7 ; $p++){
		 ?>
		
		<tr>
		<td style="width:10px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:60px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:60px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:83px;border:1px solid black;font-size:12px;height:15px"></td>
		</tr>
		<?php 
	}
		?>
		<tr>
		
		</tr>

		<?php
		for($s = 0 ; $s < 7 ; $s++){
		 ?>
		
		<tr>
		<td style="width:10px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:40px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:60px;border:1px solid black;font-size:12px;height:15px"></td>
		<td style="width:83px;border:1px solid black;font-size:12px;height:15px"></td>
		</tr>
		<?php 
		}
		?>	
		<?php 	
		}
		?>
      	<p>


<p style="float:left;margin-left:15px;margin-bottom:20px;">
<div class="col-md-12">
          <hr style="border-color:black;border:1px solid black"></hr>


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
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;

	$.ajax({
		url:'print_log.php?act=form137&id=<?php echo $_GET['id'] ?>',
		success:function(html){
			$('#returncode').html(html);
		}
	});
}
</script>
</html>
