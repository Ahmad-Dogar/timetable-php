<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inteligence TimeTable Management System</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body >
    <div  id="sideb" class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures hide">
        <div class="nano" style="height: 100%;">
            <div class="nano-content" style="height: 100%;" >
                <ul>
                    <div class="logo"><a href="index.php">
                            <!-- <img src="assets/images/logo.png" alt="" /> --><span>MNS UET</span>
                        </a></div>
                    <li class="label">Main</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-home"></i>Dashboard<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li><a href="index.php"> Morning</a></li>
                                    <li><a href="index2.php"> Evening</a></li>
                                </ul>
                    </li>

                    <li class="label">Pages</li>
                    <li><a href="department.php"><i class="ti-server"></i> Department</a></li>
                    <li><a href="program.php"><i class="ti-bookmark-alt"></i> Program</a></li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-user"></i>Faculty<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li><a href="professor.php"> Add Or Upload</a></li>
                                    <li><a href="rem_professor.php">Un Scheduled</a></li>
                                    <li><a href="professor_assigned.php">Scheduled</a></li>
                                </ul>
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-package"></i>Rooms & Labs<span
                                class="sidebar-collapse-icon ti-angle-down"></span></a>
                                <ul>
                                    <li><a href="room_lab.php"> Add Or Upload</a></li>
                                    <li><a href="rem_roomlab.php">Un Scheduled</a></li>
                                </ul>
                    </li>
                    <li><a href="course.php"><i class="ti-book"></i> Course</a></li>

                    <li class="label">TimeTable</li>
                    <li><a href="timetable.php"><i class="ti-layout-grid3"></i> Timetables</a></li>

                    <!-- <li><a href="create_timetable.php"><i class="ti-new-window"></i> Create New</a></li> -->
<!-- 
                    <li class="label">User</li>
                    <li><a href="app-profile"><i class="ti-user"></i> Profile</a></li>
                    <li><a><i class="ti-power-off"></i> Logout</a></li> -->
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <!-- <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div> -->
                    </div>
                    <div class="float-right">
                        <div class="header-icon" data-toggle="">
                            <span class="user-avatar">Intelligent Class Scheduling System
                                <!-- <i class="ti-angle-down f-s-10"></i> -->
                            </span>
                            <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                <!--                                     <div class="dropdown-content-heading">
                                        <span class="text-left">Upgrade Now</span>
                                        <p class="trial-day">30 Days Trail</p>
                                    </div> -->
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="ti-settings"></i>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ti-power-off"></i>
                                                <span>Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>