
<!doctype html>
<html class="no-js" lang="">
    <?php
session_start();
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}

$result = mysqli_query($con, "SELECT DISTINCT campus_name FROM campus");
if (!$result) {
    die("Query Error: " . mysqli_error($con));
}


$options = "";
while ($row = mysqli_fetch_assoc($result)) {
    $campus = $row['campus_name'];
    $options .= "<option value='$campus'>$campus</option>";
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Student</title>
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
        <link rel="stylesheet" href="style.css">
    <!--End Links-->

</head>

<style>
    .modal {
        text-align: center;
        padding: 0!important;
    }

    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px; 
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }


button {
    background-color: #4caf50;
    color: white;
    padding: 7px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    
}

button:hover {
    background-color: #45a049;
}

</style>
<style>
    .modal-body {
        padding: 20px;
    }

    #courseForm {
        max-width: 500%;
        margin: 0 auto;
    }

    #courseModalLabel {
        color: #333;
    }

    .input-file {
        margin-bottom: 10px;
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

    button[type="button"]:hover, button[type="submit"]:hover {
        background-color: darkgreen;
    }

    .panel-container {
            width: 75%;
            margin: 0 auto;
            padding: 10px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); 
            border-radius: 5px; 
            background-color: #fff; 
        }
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

    .cancel{
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        border: none;
        margin-left:1%;
        width:7%;
        background-color:red;
    }
</style>

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
                        <li class="tab"><a href="../misnav.php"><img src="../system-img/home.png" width="28" height="27"></i> Home</a>
                        </li>
                        <li class="tab">
                        <a href="MIS_StudentData/studentdata.php" style="background-color:#ff8e1c;color:white;">
                        <img src="../system-img/student.png" width="25" height="25"> Students
                        </a>
                        </li>
                        <li><a data-toggle="tab" href="#M-Accounts"><img src="../system-img/settings.png" width="22" height="22"> Accounts</a>
                        </li> 
                        <li><a data-toggle="tab" href="#M-campus"><img src="../system-img/campus.png" width="34" height="25"></i>Campus</a>
                        </li>  
                        <li class="tab">
                        <a href="../schedule/index.php">
                            <img src="../system-img/calendar-335.png" width="19" height="19"> Calendar of Events
                        </a>
                        </li>                                                        
                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="M-Accounts" class="tab-pane notika-tab-menu-bg animated flipInX">
                                <ul class="notika-main-menu-dropdown">
                                    <li><a href="request.php">Request</a>
                                    </li>
                                    <li><a href="users.php">Users</a>
                                    </li>                                  
                                </ul>
                        </div>
                        <div id="M-campus" class="tab-pane in notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="addcampus.php">Add Campus</a>
                                </li>
                                <li><a href="managecampus.php">Manage Campus</a>
                                </li>
                            </ul>
                         </div>  
                    </div>
                </div>
            </div>
        </div>
        <br><br>
<div class="panel-container">
                <div class="modal-body">
                    <form method="POST" action="submitstudent.php">
                        <h4>Add Student</h4> 
                        <hr style="border: 1px solid #ccc;"><br>
                        <div style="margin-bottom:15px;">
                            <label>Please make sure that the student you are about to input is enrolled.</label>
                        </div>
                        <div>      
                                <label><b>Date Enrolled:&nbsp</b></label>
                                <input type="text" style="width:10%;" name="date_enrol" placeholder="1/11/2000" autocomplete="off">

                                <input type="hidden" name="campus" id="selectedCampus">

                                <b><label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    Campus:&nbsp</label></b>
                                    <select name="campus_name" style="width:20%;" onchange="updateSelectedCampus(this.value)">
                                        <option value="" selected disabled>- Please select campus-</option>
                                            <?php echo $options; ?>
                                    </select>
                            </div>
                            
                        <div class="row p-t-20">
                            
                            <div class="col-md-3">      
                                <label><b>Student No.:&nbsp</b></label>
                                <input type="text" style="width:50%;" name="sno" placeholder="Student no." autocomplete="off">
                            </div>

                            <div class="col-md-3">      
                                <label><b>A.Y.:&nbsp</b></label>
                                <input type="text" style="width:30%;" name="sy1" placeholder="From" autocomplete="off">
                                <label><b>&nbsp&nbsp&nbsp- &nbsp&nbsp&nbsp</b></label>
                                <input type="text" style="width:30%;" name="sy2" placeholder="To" autocomplete="off">
                            </div>

                            <div class="col-md-3">      
                                <label><b>Semester:&nbsp</b></label>
                                <select id="semester" name="semester" style="width: 40%;">
                                    <option value="" selected disabled>-Select-</option>
                                        <option value="1ST">1ST</option>
                                        <option value="2ND">2ND</option>
                                    </select>
                            </div>

                            <div class="col-md-3">      
                                <label><b>Status:&nbsp</b></label>
                                <select id="status1" name="status1" style="width: 40%;">
                                    <option value="" selected disabled>-Select-</option>
                                        <option value="REGULAR">REGULAR</option>
                                        <option value="IRREGULAR">IRREGULAR</option>
                                    </select>
                            </div>

                        </div>

                        <hr style="border: 1px solid #ccc;"><br>
                        <div style="margin-bottom:15px;">
                            <label>Personal Information</label>
                        </div>

                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <label><b>Surname:&nbsp</b></label>
                                <input type="text" style="width:60%;" name="sname" placeholder="Surname" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label><b>First Name:&nbsp</b></label>
                                <input type="text" style="width:60%;" name="fname" placeholder="First Name" autocomplete="off">
                            </div>

                            <div class="col-md-4">
                                <label><b>Middle Name:&nbsp</b></label>
                                <input type="text" style="width:60%;" name="mname" placeholder="Middle Name" autocomplete="off">
                            </div>
                        </div>
                
                        <div class="row p-t-20">
                            <div class="col-md-4">
                                <label><b>Gender:&nbsp&nbsp&nbsp&nbsp&nbsp</b></label>
                                <select id="sex" name="sex" style="width: 30%;">
                                    <option value="" selected disabled>-Select-</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                            </div>

                            <div class="col-md-4">
                                <label><b>Course:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</b></label>
                                <input type="text" style="width:40%;" name="course" placeholder="e.g. BSIS" autocomplete="off">
                            </div>

                            <div class="">
                                <label><b>&nbsp&nbsp&nbsp&nbsp&nbspYear/Sec.:&nbsp</b></label>
                                <select id="year1" name="year1" style="width: 70px;">
                                    <option value="" selected disabled>Year</option>
                                        <option value="1ST">1ST</option>
                                        <option value="2ND">2ND</option>
                                        <option value="3RD">3RD</option>
                                        <option value="4TH">4TH</option>
                                </select>
                                <select id="section" name="section" style="width: 70px;">
                                    <option value="" selected disabled>Sec.</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                </select>
                            </div>
                        </div>

                        <hr style="border: 1px solid #ccc;"><br>
                        <div style="margin-bottom:15px;">
                            <label>Subjects</label>
                        </div>

                        <div class="row p-t-20">
                            <div>
                            <label><b>&nbsp&nbsp&nbsp&nbsp&nbspSubject Description:&nbsp</b></label>
                                <input type="text" style="width:40%;" name="desc[]" placeholder="e.g. Subject Description" autocomplete="off">
                            <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSubj. Code:&nbsp</b></label>
                                <input type="text" style="width:10%;" name="scode[]" placeholder="Subj. Code" autocomplete="off">
                                <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUnits:&nbsp</b></label>
                                <input type="text" style="width:10%;" name="unit[]" placeholder="Units" autocomplete="off">
                                &nbsp&nbsp<button type="button" style="cursor:pointer; color:white; background: green;" onclick="addField()"> + </button>
                            </div>
                        </div>
                        

                        <div>
                            <button type="submit" style="margin-left:85%;width:7%;"> Add</button>
                            <a  href="MIS_StudentData/studentdata.php"><label class="cancel"> Cancel</label></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <!--Script-->
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

<script>
    function addField() {
    // Find the index of the last set of inputs
    var lastIndex = document.querySelectorAll('input[name^="desc"]').length - 1;

    // Create a new div element
    var newDiv = document.createElement('div');

    // Set the HTML content of the new div
    newDiv.innerHTML = `
    <div class="row p-t-20">
        <div>
            <label><b>&nbsp&nbsp&nbsp&nbsp&nbspSubject Description:&nbsp</b></label>
            <input type="text" style="width:40%;" name="desc[${lastIndex + 1}]" placeholder="Subject Description" autocomplete="off">
            <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSubj. Code:&nbsp</b></label>
            <input type="text" style="width:10%;" name="scode[${lastIndex + 1}]" placeholder="Subj. Code" autocomplete="off">
            <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspUnits:&nbsp</b></label>
            <input type="text" style="width:10%;" name="unit[${lastIndex + 1}]" placeholder="Units" autocomplete="off">
            &nbsp&nbsp<button type="button" style="cursor:pointer; color:white; background: red;" onclick="removeField(this)"> - </button>
        </div>
    </div>
    `;
    
    var saveButton = document.querySelector('form button[type="submit"]');

    if (saveButton) {
        saveButton.parentNode.insertBefore(newDiv, saveButton);
    } else {

        document.querySelector('form').appendChild(newDiv);
    }
}
function removeField(element) {
        var containerDiv = element.parentNode.parentNode;
        containerDiv.parentNode.removeChild(containerDiv);
    }
    function updateSelectedCampus(campus) {
        document.getElementById('selectedCampus').value = campus;
    }
    </script>
</body>
</html>