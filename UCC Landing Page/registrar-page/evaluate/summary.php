<?php
session_start();
require_once('db.php');
// $query = "SELECT * from students";
// $result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>
<?php 
include 'db.php';
	$id = $_GET['id'];

	$query = mysqli_query($con,"SELECT * FROM students where sno = '$id' ");
	$row = mysqli_fetch_assoc($query);
	$student = $row['fname'].' '. $row['sname'];
?>


<head>
    <link rel="icon" href="images/logo.jpg" type="image/x-icon">

    <title>Summary of Grades</title>

     <!-- Bootstrap Core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/css/styles.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="asset/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="asset/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="asset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    
    <script src="datatables/jquery.dataTables.js"></script>
    <script src="datatables/dataTables.bootstrap.js"></script>
        <link href="datatables/dataTables.bootstrap.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js"></script>
    <script src="asset/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/js/jq.js"></script>
     <!--Links-->
     <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
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
	@media print {  
		@page {
			size:9.5in 13in;
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
		margin-left:70px;
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
label{
    font-size: 20px;
}
/** form-box */
.form-box{
    width: 900px;
    height: 1330px;
    position: relative;
    margin: 2% auto;
    background: white;
    padding: 5px;
    overflow: hidden;
    box-shadow: 0 8px 16px 0 rgb(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .19);
    background: white;
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
                        <a href="../../registrarnav.php">
                            <img src="../../system-img/home.png" width="28" height="27"> Dashboard
                        </a>
                    </li>

                    <li class="tab">
                        <a href="../importing/code.php">
                            <img src="../../system-img/import.png" width="22" height="22"> Import Grades
                        </a>
                    </li>

                    <li class="active">
                        <a href="summary.php">
                            <img src="../../system-img/pencil.png" width="25" height="25"> Evaluate Students
                        </a>
                    </li>

                    <li class="tab">
                        <a href="gradingsheet.php">
                            <img src="../../system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                        </a>
                    </li>

                    <li class="tab">
                        <a href="../candidates.php">
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
-->
<center><h1> Summary of Grades</h1> </center>

<span id='returncode'></span>
<div style="position:absolute;margin-left:68.5%;margin-top:73%;" id="head">
	<button class="btn btn-info" onclick="print()"><i class="glyphicon glyphicon-print"></i>&nbsp&nbsp&nbspPRINT</button>

<br><br><br><br>
</div>
<div class="form-box">
<center>
<div id='print'>
    <br><br><br><br>
<div style="margin-left:.5in;margin-right:.5in;margin-top:.1in;margin-bottom:.1in;line-height:1mm;">
     <img src="images/ucclogo.png"width="220"height="220"style="position:absolute;left:3%;top:4%;">
     <img src="images/cc.png"width="140"height="140"style="position:absolute;left:77%;top:6%;">
		<h3><center><b>UNIVERSITY OF CALOOCAN CITY</b></center></h3>
        <br><h4><center>COMPUTER STUDIES DEPARTMENT</center></h4>
		  </div>
		  <div class="row">
		  <div class="col-md-12">
		  <center><p><b><h4>Summary of Grades</h4></b></p></center><br>
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
				<td style="width:900px;font-size:15px;font-family:Arial;">
                <b><h style="font-size:20px;margin-left:66%;"><?php echo $row['semester'] ?></b></h>
                <label for="">SEMESTER&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <br>
                <label for="" style="margin-left:66%;">S.Y.&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:20px;"><?php echo $row['sy1']. ' - ' .$row['sy2']; ?></h>
                    

                <br>
                <br>
                <label for="">Student No.:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:20px"><?php echo $row['sno'] ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</h>
                    
                    <b><label for="">Course:&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                    <h style="font-size:20px;text-transform: uppercase;"><?php echo $row['course'] ?></h>
                    <br>

					<b><label for="">Surname:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<h style="font-size:20px;text-transform: uppercase;"><?php echo $row['sname'] ?></h>

                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspYear:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<h style="font-size:20px"> <?php echo $row['year1'] ?></h>
                    <br>

                    <b><label for="">First Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<h style="font-size:20px;text-transform: uppercase;"><?php echo $row['fname'] ?></h>

                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    Section:&nbsp&nbsp&nbsp&nbsp</label></b>
					<h style="font-size:20px"><?php echo $row['section'] ?></h>
                    <br>

                    <b><label for="">Middle Name:&nbsp&nbsp&nbsp&nbsp</label></b>
					<h style="font-size:20px;text-transform: uppercase;"><?php echo $row['mname'] ?></h>

                    <b><label for="">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspStatus:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
					<h style="font-size:20px"><?php echo $row['status1'] ?></h>

				</td>	
			</tr>		
			</table>
            <?php } ?>

            <!-- Table -->

            <table class="table table-bordered text-center" style="border-collapse;text-align:left;">
            
		        <tr>
		            <td style="width:60px;font-size:15px;"><center><b>SUBJ. CODE</b></center></th>
		            <td style="width:60px;;font-size:15px;"><center><b>DESCRIPTION</b></center></th>
                    <td style="width:10px;font-size:15px;"><center><b>UNITS</b></center></th>
                    <td style="width:10px;font-size:15px;"><center><b>FINAL GRADES</b></center></th>
                    <td style="width:10px;font-size:15px;"><center><b>FINAL GRADES <br>x UNITS</b></center></th>
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
        <br>
		<tr>
		<!--<td style="width:150px;border:1px solid black;font-size:10px;height:15px">-->
        <?php
            include 'db.php';
            $id = $_GET['id'];
            $sql=  mysqli_query($con, "SELECT scode1, desc1, unit1, FG1, scode2, desc2, unit2, FG2, scode3, desc3, unit3, FG3, scode4, desc4, unit4, FG4, scode5, desc5, unit5, FG5 FROM students where sno = '$id' ");
            while($row = mysqli_fetch_assoc($sql)) {
        ?>
                <tr>

                        <td><?php echo $row['scode1']; ?></td>
                        <td><?php echo $row['desc1']; ?></td>
                        <td><?php echo $row['unit1']; ?></td>
                        <td><?php echo $row['FG1']; ?></td>  
                        <td><?php 
                            $FG1 = $row['FG1']; 
                            $unit1 = $row['unit1'];
                            $ans1 = $FG1 * $unit1;

                            echo $ans1;
                        ?> 
                        </td>
                </tr>

                <tr>
                        <td><?php echo $row['scode2']; ?></td>
                        <td><?php echo $row['desc2']; ?></td>
                        <td><?php echo $row['unit2']; ?></td>
                        <td><?php echo $row['FG2']; ?></td> 
                        <td><?php 
                            $FG2 = $row['FG2']; 
                            $unit2 = $row['unit2'];
                            $ans2 = $FG2 * $unit2;

                            echo $ans2;
                        ?> 
                        </td>
                </tr>

                <tr>
                        <td><?php echo $row['scode3']; ?></td>
                        <td><?php echo $row['desc3']; ?></td>
                        <td><?php echo $row['unit3']; ?></td> 
                        <td><?php echo $row['FG3']; ?></td>  
                        <td><?php 
                            $FG3 = $row['FG3']; 
                            $unit3 = $row['unit3'];
                            $ans3 = $FG3 * $unit3;

                            echo $ans3;
                        ?> 
                        </td>
                </tr>

                <tr>
                        <td><?php echo $row['scode4']; ?></td>
                        <td><?php echo $row['desc4']; ?></td>
                        <td><?php echo $row['unit4']; ?></td>
                        <td><?php echo $row['FG4']; ?></td>                         
                        <td><?php 
                            $FG4 = $row['FG4']; 
                            $unit4 = $row['unit4'];
                            $ans4 = $FG4 * $unit4;

                            echo $ans1;
                        ?> 
                        </td>
                </tr>

                <tr>
                        <td><?php echo $row['scode5']; ?></td>
                        <td><?php echo $row['desc5']; ?></td>
                        <td><?php echo $row['unit5']; ?></td>
                        <td><?php echo $row['FG5']; ?></td>  
                        <td><?php 
                            $FG5 = $row['FG5']; 
                            $unit5 = $row['unit5'];
                            $ans5 = $FG5 * $unit5;

                            echo $ans5;
                        ?> 
                        </td> 
                </tr>

                <?php
                    } mysqli_close($con);
                ?>
                
                <table style="line-height:5mm;margin-left:68%;">
                <?php 
		            include 'db.php';
		            $id = $_GET['id'];
		            $sql = mysqli_query($con,"SELECT * from students where sno = '$id'");
		            while($row = mysqli_fetch_assoc($sql)){
			        $mid = $row['mname'];
		        ?>
                
                <tr>
				<td style="width:600px;font-size:15px;font-family:Arial;">
                    <label for="">Total Units:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
					<h style="font-size:18px">
                    <?php 
                            $u1 = $row['unit1']; 
                            $u2 = $row['unit2'];
                            $u3 = $row['unit3']; 
                            $u4 = $row['unit4'];
                            $u5 = $row['unit5']; 
                            $ans = $u1 + $u2 + $u3 + $u4 + $u5;

                            echo $ans;
                    ?> </h>

                    <br>
                    <b><label for="">GWA:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label></b>
                    <h style="font-size:18px;text-transform: uppercase;">
                    <?php 
                            $final = $ans1 + $ans2 + $ans3 + $ans4 + $ans5;
                            $gwa = $final / $ans;
                            
                            echo printf("%.1f", $gwa);
                    ?> </h>
                </tr>
                </table>
                
                <?php
                    } mysqli_close($con);
                ?>
<div class="col-xs-6">
<table style="line-height:5mm">
<tr>                         
<br><br><br>	 
        <b><label for=""  style="font-size:16px;">Verified by: _____________</label></b>
</tr>
</table>
</div>

<table style="line-height:5mm">
<div style="margin-left:70%;">
                <?php 
		            include 'db.php';
		            $id = $_GET['id'];
		            $sql = mysqli_query($con,"SELECT * from students where sno = '$id'");
		            while($row = mysqli_fetch_assoc($sql)){
			        $mid = $row['mname'];
		        ?>
                <br><br><br>	
                    <u><h style="font-size:16px;text-transform: uppercase"><?php echo $row['fname']. ' ' .$row['sname']; ?></u></h>
                    <br>
                    <b><label for=""  style="font-size:17px;">SIGNATURE</label></b>	
                    <br><br><br><br>				
                </tr>
                </table>
                </div>
                
                <?php
                    } mysqli_close($con);
                ?>
                
        </div>
        </div>
        </div>

		
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

<script type="text/javascript" language="javascript">

    $(document).ready(function(){
        var dataTable = $('#sample_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"fetch.php",
                type:"POST",
            },
            createdRow:function(row, data, rowIndex)
            {
                $.each($('td', row), function(colIndex){
                    if(colIndex == 18)
                    {
                        $(this).attr('data-name', 'FG1');
                        $(this).attr('class', 'FG1');
                        $(this).attr('data-type', 'int');
                        $(this).attr('data-pk', data[0]);
                    }
                });
            }
        });
        $('#sample_data').edittable({
            container:'body',
            selector:'td.FG1',
            url:'update.php',
            title:'FINAL GRADES',
            type:'POST',
            validate:function(value){
                if($.trim(value)== '')
                {
                    return 'This field is required';
                }
            }
        })
    });

</script>