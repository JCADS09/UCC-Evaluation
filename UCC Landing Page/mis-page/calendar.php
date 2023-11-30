
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
                        <li class="tab"><a data-toggle="tab" href="#Home"><img src="../system-img/home.png" width="28" height="27"></i> Home</a>
                        </li>
                        <li class="tab">
                        <a href="students.php">
                        <img src="../system-img/student.png" width="25" height="25"> Students
                        </a>
                        </li>
                        <li><a data-toggle="tab" href="#M-Accounts"><img src="../system-img/settings.png" width="22" height="22"> Manage Accounts</a>
                        </li> 
                        <li><a data-toggle="tab" href="#M-campus"><img src="../system-img/campus.png" width="34" height="25"></i> Manage Campus</a>
                        </li>  
                        <li class="active">
                        <a href="calendar.php">
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
                                    <li><a href="request.php">Request</a>
                                    </li>
                                    <li><a href="users.php">Users</a>
                                    </li>                                  
                                </ul>
                        </div>
                        <div id="M-campus" class="tab-pane notika-tab-menu-bg animated flipInX">
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
    <!-- Main Menu area End-->

    <center>
         <H1>Calendar  page</H1> 
    </center>


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