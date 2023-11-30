
<?php
require_once('db.php');
$query = "SELECT * from students";
$result = mysqli_query($con, $query);
?>

&nbsp<!DOCTYPE html>
<html>
<?php 
include 'db.php';
session_start();

	$id = $_GET['id'];

	$query = mysqli_query($con,"SELECT * FROM students where sno = '$id'");
	$row = mysqli_fetch_assoc($query);
	$student = $row['fname'].' '. $row['sname'];

?>



<head>
    <link rel="icon" href="images/logo.jpg" type="image/x-icon">

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

    <script src="assets/js/jquery.min.js"></script>
    <script src="asset/js/bootstrap.min.js" type="text/javascript"></script>

    <script src="assets/js/ie-emulation-modes-warning.js"></script>
    <script src="assets/js/jq.js"></script>
	<style>
	
		input 
        {

    background: transparent;
    font-size: 15px;
    }
label{
    font-size: 15px;

}

</style>

</head> 
<body style="background-color:white"> 
<span id='returncode'></span>
<div style="position:absolute;margin-left:68.5%;margin-top:73%;" id="head">
	<button class="btn btn-info" onclick="print()"><i class="glyphicon glyphicon-print"></i>&nbsp&nbsp&nbspPRINT</button>

<br><br><br><br>
</div>
<div id='print'>
<div id='print'>
        <?php
        require_once('db.php');
        session_start();
        $id = $_GET['id'];

        $query = mysqli_query($con, "SELECT * FROM students where sno = '$id'");
        $row = mysqli_fetch_assoc($query);
        $student = $row['fname'] . ' ' . $row['sname'];

        ?>
            <div style="position:absolute;margin-left:20%;">
                <label>Semester:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="semester" value="<?php echo $row['semester']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:39.8%;">
                <label>School Year:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sy" value="<?php echo $row['sy1']. ' - ' .$row['sy2']; ?>" readonly>
            </div>
            <br>

            <div style="position:absolute;margin-left:20%;margin-top:1%;">
                <label>Student No.:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['sno']; ?>" readonly>
            </div>

            <div style="position:absolute;margin-left:39.8%;margin-top:1%;">
                <label>Course:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="course" value="<?php echo $row['course']; ?>" readonly>
            </div>

            <div style="position:absolute;margin-left:20%;margin-top:2.2%;">
                <label>Surname:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['sname']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:39.8%;margin-top:2.2%;">
                <label>Year:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['year1']; ?>" readonly>
            </div>

            <div style="position:absolute;margin-left:20%;margin-top:3.4%;">
                <label>First Name:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['fname']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:39.8%;margin-top:3.4%;">
                <label>Section:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['section']; ?>" readonly>
            </div>

            <div style="position:absolute;margin-left:20%;margin-top:4.6%;">
                <label>Middle Name:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['mname']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:39.8%;margin-top:4.6%;">
                <label>Status:&nbsp&nbsp</label>
                <input style="border:0;" type="text" name="sno" value="<?php echo $row['status1']; ?>" readonly>
            </div>

            <div style="position:absolute;margin-left:20%;margin-top:7%;">
                <label style="font-size:18px;">Subject Code&nbsp&nbsp</label>
            </div>
            <div style="position:absolute;margin-left:40%;margin-top:7%;">
                <label style="font-size:18px;">Description&nbsp&nbsp</label>            
            </div>
            <div style="position:absolute;margin-left:58%;margin-top:7%;">
                <label style="font-size:18px;">Units&nbsp&nbsp</label>            
            </div>
            <div style="position:absolute;margin-left:63%;margin-top:7%;">
                <label style="font-size:18px;">Final Grade&nbsp&nbsp</label>            
            </div>
            <div style="position:absolute;margin-left:71.2%;margin-top:7%;">
                <label style="font-size:18px;">FG x Units&nbsp&nbsp</label>            
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:9%;">
                <input type="text" size="10" name="scode1" value="<?php echo $row['scode1']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:9%;">
                <input type="text" size="50" name="desc1" value="<?php echo $row['desc1']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:9%;">
                <input type="text" size="2" name="unit1" id="unit1" value="<?php echo $row['unit1']; ?>" oninput="updateResult()" readonly>
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:9%;">
                <input type="text" size="2" name="fg1" id="fg1" value="<?php echo $row['fg1']; ?>" oninput="updateResult()">
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:9%;">
    <input style="border:0;" type="text" size="2" name="ans1" id="ans1" value="<?php 
        $FG1 = $row['fg1']; 
        $unit1 = $row['unit1'];

        // Check if $FG1 is null, empty, or not set
        if (empty($FG1)) {
            echo '0.00';
        } else {
            $ans1 = $FG1 * $unit1;
            echo number_format($ans1, 2);
        }
    ?>" readonly>          
</div>



<script>
    function updateResult() {
        var FG1 = parseFloat(document.getElementById('fg1').value);
        var unit1 = parseFloat(document.getElementById('unit1').value);

        var ans1 = FG1 * unit1;
        document.getElementById('ans1').value = ans1;
    }
</script>
            <div style="position:absolute;margin-left:20.3%;margin-top:11%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode2']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:11%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc2']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:11%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit2']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:11%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg2']; ?>">          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:11%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG2 = $row['fg2']; 
                            $unit2 = $row['unit2'];
                            $ans2 = $FG2 * $unit2;

                            echo $ans2;
                        ?> " readonly>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:13%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode3']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:13%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc3']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:13%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit3']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:13%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg3']; ?>">          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:13%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG3 = $row['fg3']; 
                            $unit3 = $row['unit3'];
                            $ans3 = $FG3 * $unit3;

                            echo $ans3;
                        ?> " disabled>           
            </div>

            
            <div style="position:absolute;margin-left:20.3%;margin-top:15%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode4']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:15%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc4']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:15%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit4']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:15%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg4']; ?>">          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:15%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG4 = $row['fg4']; 
                            $unit4 = $row['unit4'];
                            $ans4 = $FG4 * $unit4;

                            echo $ans4;
                        ?> " disabled>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:17%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode5']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:17%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc5']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:17%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit5']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:17%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg5']; ?>">          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:17%;">
          <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                     $FG5 = $row['fg5']; 
                            $unit5 = $row['unit5'];
                            $ans5 = $FG3 * $unit5;

                            echo $ans5;
                        ?> " disabled>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:19%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode6']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:19%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc6']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:19%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit6']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:19%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg6']; ?>" 
                <?php if ($row['fg6'] == 0.00) { echo 'disabled'; } ?>readonly>          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:19%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG6 = $row['fg6']; 
                            $unit6 = $row['unit6'];
                            $ans6 = $FG6 * $unit6;

                            echo $ans6;
                        ?> " readonly>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:21%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode7']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:21%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc7']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit7']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg7']; ?>"
                <?php if ($row['fg7'] == 0.00) { echo 'disabled'; } ?>readonly>          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:21%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG7 = $row['fg7']; 
                            $unit7 = $row['unit7'];
                            $ans7 = $FG7 * $unit7;

                            echo $ans7;
                        ?> " readonly>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:21%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode8']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:21%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc8']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit8']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg8']; ?>"
                <?php if ($row['fg8'] == 0.00) { echo 'disabled'; } ?>readonly>          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:21%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG8 = $row['fg8']; 
                            $unit8 = $row['unit8'];
                            $ans8 = $FG8 * $unit8;

                            echo $ans8;
                        ?> " readonly>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:21%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode9']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:21%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc9']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit9']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg9']; ?>"
                <?php if ($row['fg9'] == 0.00) { echo 'disabled'; } ?>readonly>          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:21%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG9 = $row['fg9']; 
                            $unit9 = $row['unit9'];
                            $ans9 = $FG9 * $unit9;

                            echo $ans9;
                        ?> " readonly>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:21%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode10']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:21%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc10']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit10']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg10']; ?>"
                <?php if ($row['fg10'] == 0.00) { echo 'disabled'; } ?>readonly>          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:21%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG10 = $row['fg10']; 
                            $unit10 = $row['unit10'];
                            $ans10 = $FG10 * $unit10;

                            echo $ans10;
                        ?> " readonly>           
            </div>

            <div style="position:absolute;margin-left:20.3%;margin-top:21%;">
                <input type="text" size="10" name="sno" value="<?php echo $row['scode11']; ?>" readonly>
            </div>
            <div style="position:absolute;margin-left:30%;margin-top:21%;">
                <input type="text" size="50"  name="sno" value="<?php echo $row['desc11']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:58.2%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['unit11']; ?>" readonly>          
            </div>
            <div style="position:absolute;margin-left:68%;margin-top:21%;">
                <input type="text" size="2" name="sno" value="<?php echo $row['fg11']; ?>"
                <?php if ($row['fg11'] == 0.00) { echo 'disabled'; } ?>readonly>          
            </div>
            <div style="position:absolute;margin-left:73%;margin-top:21%;">
            <input style="border:0;" type="text" size="2" name="sno" value="<?php 
                            $FG11 = $row['fg11']; 
                            $unit11 = $row['unit11'];
                            $ans11 = $FG11 * $unit11;

                            echo $ans11;
                        ?> " readonly>           
            </div>

        <?php
        ?>
</body>
</html>

