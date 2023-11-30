
<!doctype html>
<html class="no-js" lang="">
<?php 
session_start();
$con = mysqli_connect("localhost", "root", "", "uccevaluation");
if (!$con) {
    die("Connection Error: " . mysqli_connect_error());
}
    ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus</title>
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
                        <li class="tab"><a href="../misnav.php"><img src="../system-img/home.png" width="28" height="27"></i> Dashboard</a>
                        </li>
                        <li class="tab">
                        <a href="MIS_StudentData/studentdata.php">
                        <img src="../system-img/student.png" width="25" height="25"> Students
                        </a>
                        </li>
                        <li><a data-toggle="tab" href="#M-Accounts"><img src="../system-img/settings.png" width="22" height="22"> Accounts</a>
                        </li> 
                        <li><a data-toggle="tab" href="#M-campus"  style="background-color:#ff8e1c;color:white;"><img src="../system-img/campus.png" width="34" height="25"></i>Campus</a>
                        </li>  
                        <!-- <li class="tab">
                        <a href="../schedule/index.php">
                            <img src="../system-img/calendar-335.png" width="19" height="19"> Calendar of Events
                        </a>
                        </li>                                                         -->
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
                        <div id="M-campus" class="tab-pane in active notika-tab-menu-bg animated flipInX">
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
    </div>
    <div class="flip-card-container">
    <?php
    $result = mysqli_query($con, "SELECT * FROM campus");
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <input type="hidden" name="uniqueId" value="<?php echo $row['uniqueid']; ?>">
        <div class="flip-card" data-uniqueid="<?php echo $row['uniqueid']; ?>">
            <div class="flip-card-inner" style="cursor:pointer;">
                <div class="flip-card-front">
                    <p class="title"><h3><?php echo $row['campus_name']; ?></h3></p>
                </div>
                <div class="flip-card-back">
                    <p class="title"><p><?php echo $row['campus_location']; ?></p></p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<div class="wrapper">
    <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true" style="max-height: 400px; overflow-y: auto;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button style="margin-left:95%;" type="button" class="close" data-dismiss="modal" aria-label="Close" style="overflow: auto">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">              
                    <form id="courseForm" method="post" action="savecourse.php">
                    <center> <h4 id="courseModalLabel">label</h4> </center>
                        <br>
                    
                        <input type="hidden" id="modalUniqueId" name="uniqueId" value="">                       
                            College Department:
                            <input type="text" style="width:75%;" name="collegeDepartment" placeholder="College Department" autocomplete="off">
                        
                        <div>
                            <b>Course</b>
                        </div>
                        <div>
                            Full Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" style="width:75%;" name="courseDescription[]" placeholder="e.g. Bachelor of Science in Information System"  autocomplete="off">
                        
                            
                            Acronym: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" style="width:200px;" name="acronym[]" placeholder="e.g. BSIS"  autocomplete="off">
                            &nbsp;<button type="button" style="cursor:pointer; color:white; background: green;" onclick="addField()"> + </button>
                        </div>

                        <div>
                            <button type="submit" style="margin-left:91%;"> Save </button>
                        </div>        
                    </div>
                </form>
            </div>
        </div>
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
    
<script>
   document.addEventListener('DOMContentLoaded', function () {
    // Add an event listener for card clicks
    const flipCards = document.querySelectorAll('.flip-card');
    flipCards.forEach(function (card) {
        card.addEventListener('click', function () {
            // Show the modal when a card is clicked
            $('#courseModal').modal('show');

            var wrapper = document.querySelector('.wrapper');
            wrapper.style.display = 'block'; // Show the wrapper

            var modalTitle = document.querySelector('#courseModalLabel');
            modalTitle.textContent = "Add courses in " + card.querySelector('h3').textContent + " Campus";

            // Use either jQuery or plain JavaScript to get the uniqueId
            var uniqueId = card.getAttribute('data-uniqueid');
            // Or use jQuery: var uniqueId = $(card).data('uniqueid');

            $('#modalUniqueId').val(uniqueId);

            // Call the openModal function with campusName parameter
            openModal(card.querySelector('h3').textContent);
        });
    });

    // Add an event listener for modal close
    $('#courseModal').on('hidden.bs.modal', function () {
        var wrapper = document.querySelector('.wrapper');
        wrapper.style.display = 'none'; // Hide the wrapper
    });
});
</script>
<script>
function openModal(campusName) {
    // Set the campus name in the heading
    var heading = document.querySelector('#manageHeading');
    heading.textContent = "Manage " + campusName + " Campus";
}
function addField() {
    // Find the index of the last set of inputs
    var lastIndex = document.querySelectorAll('input[name^="courseDescription"]').length - 1;

    // Create a new div element
    var newDiv = document.createElement('div');

    // Set the HTML content of the new div
    newDiv.innerHTML = `
        <div>
            Full Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" style="width:75%;" name="courseDescription[${lastIndex + 1}]" placeholder="e.g. Bachelor of Science in Information System" autocomplete="off">                
            Acronym: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" style="width:200px;" name="acronym[${lastIndex + 1}]" placeholder="e.g. BSIS" autocomplete="off">
            &nbsp;&nbsp;<button type="button" style="cursor:pointer; color:white; background: red;" onclick="removeField(this)"> - </button>
        </div>
    `;

    // Append the new div to the form
    var saveButton = document.querySelector('form button[type="submit"]');

    // Insert the new div before the "Save" button
    if (saveButton) {
        saveButton.parentNode.insertBefore(newDiv, saveButton);
    } else {
        // If "Save" button is not found, append the new div to the form
        document.querySelector('form').appendChild(newDiv);
    }
}
        function removeField(element) {
            // Remove the parent div when "-" button is clicked
            element.parentNode.parentNode.removeChild(element.parentNode);
        }

    </script>
    <!--End Script-->
    </body>
</html>