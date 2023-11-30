<?php require_once('db-connect.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>

    <!--page-->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
        <script src="./js/jquery-3.6.0.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./fullcalendar/lib/main.min.js"></script>
    <!--end-->

    <!--Links-->
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
<div>
<style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }
        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style>
</div>
    
</head>

<body class="bg-light">

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
                        <li class="tab"><a data-toggle="tab" href="#Home"><img src="../system-img/home.png" width="28" height="27"></i> Home</a>
                        </li>
                        <li class="tab">
                        <a href="../mis-page/MIS_StudentData/studentdata.php">
                        <img src="../system-img/student.png" width="25" height="25"> Students
                        </a>
                        </li>
                        <li><a data-toggle="tab" href="#M-Accounts"><img src="../system-img/settings.png" width="22" height="22"> Manage Accounts</a>
                        </li> 
                        <li><a data-toggle="tab" href="#M-campus"><img src="../system-img/campus.png" width="34" height="25"></i> Manage Campus</a>
                        </li>  
                        <li class="active">
                        <a href="index.php">
                            <img src="../system-img/calendar-335.png" width="19" height="19"> Calendar of Events
                        </a>
                        </li>                                                        
                    </ul>
                    <div class="tab-content custom-menu-content">

                        <div id="Home" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../misnav.php">Dashboard</a>
                                </li>                         
                            </ul>
                        </div>                   
                         <div id="M-Accounts" class="tab-pane notika-tab-menu-bg animated flipInX">
                                <ul class="notika-main-menu-dropdown">
                                    <li><a href="../mis-page/request.php">Request</a>
                                    </li>
                                    <li><a href="../mis-page/users.php">Users</a>
                                    </li>                                  
                                </ul>
                        </div>
                        <div id="M-campus" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="../mis-page/addcampus.php">Add Campus</a>
                                </li>
                                <li><a href="../mis-page/managecampus.php">Manage Campus</a>
                                </li>
                            </ul>
                         </div>  
                    </div>
                </div>
            </div>
        </div>
     </div>
        <!-- Main Menu area End-->

    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

<?php 
$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_datetime']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>

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
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script src="./js/script.js"></script>

</html>