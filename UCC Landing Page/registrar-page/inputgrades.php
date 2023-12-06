<!doctype html>
<html class="no-js" lang="">
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if(!$con) {
    die("Connection Error: ".mysqli_connect_error());
}

$result = mysqli_query($con, "SELECT DISTINCT campus_name FROM campus");
if(!$result) {
    die("Query Error: ".mysqli_error($con));
}


$options = "";
while($row = mysqli_fetch_assoc($result)) {
    $campus = $row['campus_name'];
    $options .= "<option value='$campus'>$campus</option>";
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Input Grades</title>
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

    <script>
        function numOnly(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode;
            if (keyCode < 48 || keyCode > 57) {
                evt.preventDefault();
            }
        }
        function student(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode;
            var inputValue = evt.target.value;

            // Allow numeric digits 0-9
            if (keyCode < 48 || keyCode > 57) {
                evt.preventDefault();
            }

            // Allow a maximum of 8 digits
            if (inputValue.length >= 8) {
                evt.preventDefault();
            }
        }


        function grades(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode;
            var inputValue = evt.target.value;

            if ((keyCode !== 46 && keyCode < 48) || (keyCode > 57)) {
                evt.preventDefault();
            }


            if (keyCode === 46 && inputValue.indexOf('.') !== -1) {
                evt.preventDefault();
            }

            if (inputValue.indexOf('.') !== -1 && inputValue.split('.')[1].length >= 2) {
                evt.preventDefault();
            }
        }

        function lettersOnly(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode;

            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 122) && keyCode !== 32) {
                evt.preventDefault();
            }
        }
        function upperCase(input) {
            input.value = input.value.toUpperCase();
        }
        function year(inputField) {
            inputField.value = inputField.value.substring(0, 4);
        }
        function oneDigit(input) {
            input.value = input.value.replace(/\D/g, '');

            if (input.value.length > 1) {
                input.value = input.value.charAt(0);
            }
        }
    </script>
</head>

<style>
    .modal {
        text-align: center;
        padding: 0 !important;
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

    button[type="button"]:hover,
    button[type="submit"]:hover {
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

    .cancel {
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        border: none;
        margin-left: 1%;
        width: 7%;
        background-color: red;
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
                        <span style="color: white; font-weight: bold; font-size: 24px; margin-left: 10px;">UCC
                            EVALUATION</span>
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
                            <a href="../registrarnav.php">
                                <img src="../system-img/home.png" width="28" height="27"> Dashboard
                            </a>
                        </li>

                        <li class="active">
                            <a href="importgrades.php" style="background-color:#ff8e1c;color:white;">
                                <img src="../system-img/import.png" width="22" height="22"> Import Grades
                            </a>
                        </li>

                        <li class="tab">
                            <a href="evaluator-page/scholastic/students.php">
                                <img src="../system-img/pencil.png" width="25" height="25"> Evaluate Students
                            </a>
                        </li>

                        <li class="tab">
                            <a href="gradingsheet.php">
                                <img src="../system-img/gradingsheet.png" width="25" height="25"> Grading Sheet
                            </a>
                        </li>

                        <li class="tab">
                            <a href="candidates.php">
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

    <br>
    <div class="panel-container">
        <div class="modal-body">
            <form method="POST" action="savegrades.php">
                <h4>Input Grades</h4>
                <?php if(isset($_SESSION['message'])): ?>
                    <div style="color: green;">
                        <?php echo "<h4>".$_SESSION['message']."</h4>"; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['message2'])): ?>
                    <div style="color: red;">
                        <?php echo "<h4>".$_SESSION['message2']."</h4>"; ?>
                    </div>
                    <?php unset($_SESSION['message2']); ?>
                <?php endif; ?>
                <hr style="border: 1px solid #ccc;"><br>
                <div style="margin-bottom:15px;">
                    <label>Please make sure that you enter an accurate grade.</label>
                </div>

                <div class="row p-t-20">
                    <div class="col-md-3">
                        <label><b>Subj. Code:&nbsp</b></label>
                        <input type="text" style="width:50%;" name="scode" placeholder="Subj. Code" autocomplete="off"
                            oninput="upperCase(this)">
                    </div>

                    <div class="col-md-3">
                        <label><b>A.Y.:&nbsp</b></label>
                        <input type="text" style="width:30%;" name="sy1" placeholder="From" autocomplete="off"
                            oninput="year(this)" onkeypress="numOnly(event)">
                        <label><b>&nbsp&nbsp&nbsp- &nbsp&nbsp&nbsp</b></label>
                        <input type="text" style="width:30%;" name="sy2" placeholder="To" autocomplete="off"
                            oninput="year(this)" onkeypress="numOnly(event)">
                    </div>

                    <div>
                        <label><b>Semester:&nbsp</b></label>
                        <select id="semester" name="semester" style="width: 10%;">
                            <option value="" selected disabled>-Select-</option>
                            <option value="1ST">1ST</option>
                            <option value="2ND">2ND</option>
                        </select>


                        <input type="hidden" name="campus" id="selectedCampus">
                        <b><label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                Campus:&nbsp</label></b>
                        <select name="campus_name" style="width:20%;" onchange="updateSelectedCampus(this.value)">
                            <option value="" selected disabled>- Please select campus-</option>
                            <?php echo $options; ?>
                        </select>
                    </div>

                </div>

                <hr style="border: 1px solid #ccc;"><br>
                <div style="margin-bottom:15px;">
                    <label>Subjects</label>
                </div>
                <div class="row p-t-20">
                    <div>
                        <label><b>&nbsp&nbsp&nbsp&nbsp&nbspStudent No.:&nbsp</b></label>
                        <input type="text" style="width:15%;" name="sno" placeholder="Student no." autocomplete="off"
                            onkeypress="student(event)">

                        <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMidterm:&nbsp</b></label>
                        <input type="text" style="width:10%;" name="MT[]" placeholder="MT" autocomplete="off"
                            onkeypress="grades(event)">
                        <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFinal Term:&nbsp</b></label>
                        <input type="text" style="width:10%;" name="FT[]" placeholder="FT" autocomplete="off"
                            onkeypress="grades(event)">
                        <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFinal Grade:&nbsp</b></label>
                        <input type="text" style="width:10%;" name="FG[]" placeholder="FG" autocomplete="off"
                            onkeypress="grades(event)">
                        &nbsp&nbsp<button type="button" style="cursor:pointer; color:white; background: green;"
                            onclick="addField()"> + </button>
                    </div>
                </div>


                <div>
                    <button type="submit" style="margin-left:85%;width:7%;"> Save</button>
                    <a href="importing/code.php"><label class="cancel"> Cancel</label></a>
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
            var lastIndex = document.querySelectorAll('input[name^="sno"]').length - 1;

            // Create a new div element
            var newDiv = document.createElement('div');

            // Set the HTML content of the new div
            newDiv.innerHTML = `
    <div class="row p-t-20">
        <div>
        <label><b>&nbsp&nbsp&nbsp&nbsp&nbspStudent No.:&nbsp</b></label>
                                <input type="text" style="width:15%;" name="sno" placeholder="Student no." autocomplete="off" onkeypress="student(event)">
                            
                                <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMidterm:&nbsp</b></label>
                                <input type="text" style="width:10%;" name="MT[${lastIndex + 1}]" placeholder="MT" autocomplete="off" onkeypress="grades(event)">
                                <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFinal Term:&nbsp</b></label>
                                <input type="text" style="width:10%;" name="FT[${lastIndex + 1}]" placeholder="FT" autocomplete="off" onkeypress="grades(event)">
                                <label><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFinal Grade:&nbsp</b></label>
                                <input type="text" style="width:10%;" name="FG[${lastIndex + 1}]" placeholder="FG" autocomplete="off" onkeypress="grades(event)">
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