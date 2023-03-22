<!DOCTYPE html>

<?php
session_start();

include("database.php"); 
// header("Content-Type: application/vnd.msword");
// header("content-disposition: attachment;filename=sampleword.doc");
?>


<head>

    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style type="text/css">
    .table th,td, tr  {
        text-align: center;
    }
    </style>
</head>

<body>
    <?php include("sidebar.php"); ?>


    <div class="content-wrap hide rmv">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title hide">
                                <h1>Search Professor Data</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header hide">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Search Professor</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap hide rmv">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="card my-5" style="padding-left:0px;">

                        <div class="card-body" >


                        <ul class="nav nav-tabs" role="tablist" style="margin-top:-59px">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#all" role="tab"><span class="hidden-sm-up">All Data</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#by_session" role="tab"><span class="hidden-sm-up">By Session</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#by_program" role="tab"><span class="hidden-sm-up">By Program</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#by_semester" role="tab"><span class="hidden-sm-up">By Semester</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content ">

                                <div class="tab-pane active" id="all" role="tabpanel">
                                    <div class="p-20">

                                    <div class="basic-form">
                                <form method="POST" action="professor_assigned.php">
                                    <div class="row " style="margin-bottom: -15px;">

                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" Name='professor_name'
                                                    style="height: 42px" class="ajaxUpdate" required>
                                                    <option value="">--- Select Name ---</option>
                                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT professor_name FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                                    <option value="<?php echo $row['professor_name'];?>">
                                                        <?php echo $row['professor_name'];?></option>
                                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <button type="submit" name="search_timetable" class="btn btn-md btn-block"
                                                style="background-color: #343957;color: white;margin-bottom:-60px"><i
                                                    class=""></i>Search</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="by_semester" role="tabpanel">

                                <div class="basic-form">
                                <form method="POST" action="professor_assigned.php">
                                    <div class="row " style="margin-bottom: -15px;">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" Name='professor_name'
                                                    style="height: 42px" class="ajaxUpdate" required>
                                                    <option value="">--- Select Name ---</option>
                                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT professor_name FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                                    <option value="<?php echo $row['professor_name'];?>">
                                                        <?php echo $row['professor_name'];?></option>
                                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" Name='semester'
                                                    style="height: 42px" class="ajaxUpdate" required>
                                                    <option value="">--- Select Semester ---</option>
                                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT semester FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                                    <option value="<?php echo $row['semester'];?>">
                                                        <?php echo $row['semester'];?></option>
                                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <button type="submit" name="search_bysemester" class="btn btn-md btn-block"
                                                style="background-color: #343957;color: white;margin-bottom:-60px"><i
                                                    class=""></i>Search</button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            </div>

                            <div class="tab-pane  p-20" id="by_program" role="tabpanel">

<div class="basic-form">
<form method="POST" action="professor_assigned.php">
    <div class="row " style="margin-bottom: -15px;">

        <div class="col-lg-6">
            <div class="form-group">
                <select class="form-control form-control-md" Name='professor_name'
                    style="height: 42px" class="ajaxUpdate" required>
                    <option value="">--- Select Name ---</option>
                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT professor_name FROM timetables"); 
        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                    <option value="<?php echo $row['professor_name'];?>">
                        <?php echo $row['professor_name'];?></option>
                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <select class="form-control form-control-md" Name='program'
                    style="height: 42px" class="ajaxUpdate" required>
                    <option value="">--- Select Program ---</option>
                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT program FROM timetables"); 
        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                    <option value="<?php echo $row['program'];?>">
                        <?php echo $row['program'];?></option>
                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                </select>
            </div>
        </div>

        <div class="col-lg-2">
            <button type="submit" name="search_byprogram" class="btn btn-md btn-block"
                style="background-color: #343957;color: white;margin-bottom:-60px"><i
                    class=""></i>Search</button>
        </div>

    </div>
</form>
</div>

</div>

<div class="tab-pane  p-20" id="by_session" role="tabpanel">

<div class="basic-form">
<form method="POST" action="professor_assigned.php">
    <div class="row " style="margin-bottom: -15px;">

        <div class="col-lg-6">
            <div class="form-group">
                <select class="form-control form-control-md" Name='professor_name'
                    style="height: 42px" class="ajaxUpdate" required>
                    <option value="">--- Select Name ---</option>
                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT professor_name FROM timetables"); 
        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                    <option value="<?php echo $row['professor_name'];?>">
                        <?php echo $row['professor_name'];?></option>
                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <select class="form-control form-control-md" Name='session_from'
                    style="height: 42px" class="ajaxUpdate" required>
                    <option value="">--- Session From ---</option>
                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT session_from FROM timetables"); 
        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                    <option value="<?php echo $row['session_from'];?>">
                        <?php echo $row['session_from'];?></option>
                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <select class="form-control form-control-md" Name='session_to'
                    style="height: 42px" class="ajaxUpdate" required>
                    <option value="">--- Session To ---</option>
                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT session_to FROM timetables"); 
        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                    <option value="<?php echo $row['session_to'];?>">
                        <?php echo $row['session_to'];?></option>
                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                </select>
            </div>
        </div>

        <div class="col-lg-2">
            <button type="submit" name="search_bysession" class="btn btn-md btn-block"
                style="background-color: #343957;color: white;margin-bottom:-60px"><i
                    class=""></i>Search</button>
        </div>

    </div>
</form>
</div>

</div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="content-wrap     rmv">
        <div class="container-fluid mb-4">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="card mb-5">

    <?php
        $i = '';
        $Professor_Name = '';

if(isset($_POST['search_timetable']))
{

    $Professor_Name = $_POST['professor_name'];

    $query = "SELECT * FROM timetables WHERE professor_name = '$Professor_Name'";
    $result = mysqli_query($con, $query);
    $count = mysqli_query($con, "SELECT COUNT(*) FROM timetables WHERE professor_name = '$Professor_Name'");
    $course_count = mysqli_query($con, "SELECT COUNT(distinct course_assigned) FROM timetables WHERE professor_name = '$Professor_Name'");

    $fetchcourse = mysqli_fetch_row($course_count);
    $course_count_result = $fetchcourse['0'];
    $fetchrow = mysqli_fetch_row($count);
    $count_result = $fetchrow['0'];

if ($result && mysqli_num_rows($result) > 0) { 

?>


                        <div class="row">
    <div class="col-2 mb-1">
        <img src="logo.PNG" width="90px">
    </div>
    <div class="col-10">
    <center><h5>MNS-University of Engineering and Technology</h5>
                                <h5 class="bg-warning bg-gradient"> ( Credit Hours : <?php echo $count_result; ?> )  ( Course Assigned : <?php echo $course_count_result; ?> )</h5>
                                <h5>Assigned To  <b><?php echo $Professor_Name; ?> </b>  </h5>
                            </center>
    </div>
</div>

                            <table class="display table table-bordered table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><b>Sr</b></th>
                                        <th><b>Course</b></th>
                                        <th><b>Room</b></th>
                                        <th><b>Time</b></th>
                                        <th><b>Day</b></th>
                                        <th><b>Program</b></th>
                                        <th><b>Session</b></th>
                                        <th><b>Semester</b></th>
                                    </tr>
                                </thead>

<?php while($row = mysqli_fetch_array($result)) { $i++; ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row["course_assigned"]; ?></td>
                                    <td><?php echo $row["room_name"]; ?></td>
                                    <td><?php echo $row["room_from"]." - ".$row["room_to"]; ?></td>
                                    <td><?php echo ucwords($row["day"]); ?>
                                    <td><?php echo $row["program"]; ?></td>
                                    <td><?php echo $row["session_from"]." - ".$row["session_to"]; ?></td>
                                    <td><?php echo $row["semester"]; ?></td>
                                    </td>
                                </tr>


                                <?php }} ?>
                                </tbody>
                            </table>

                        <button class='btn btn-success mt-5   hide' style='background-color: #343957'
                            onclick="display()">Print Data</button>
                            <?php } ?>


<?php if(isset($_POST['search_bysemester']))
{

    $Professor_Name = $_POST['professor_name'];
    $semester = $_POST['semester'];

    $query = "SELECT * FROM timetables WHERE professor_name = '$Professor_Name' AND semester = '$semester'";
    $result2 = mysqli_query($con, $query);
    $count = mysqli_query($con, "SELECT COUNT(*) FROM timetables WHERE professor_name = '$Professor_Name'");
    $course_count = mysqli_query($con, "SELECT COUNT(distinct course_assigned) FROM timetables WHERE professor_name = '$Professor_Name'");

    $fetchcourse = mysqli_fetch_row($course_count);
    $course_count_result = $fetchcourse['0'];
    $fetchrow = mysqli_fetch_row($count);
    $count_result = $fetchrow['0'];

if ($result2 && mysqli_num_rows($result2) > 0) { 

?>


                        <div class="row">
    <div class="col-2 mb-1">
        <img src="logo.PNG" width="90px">
    </div>
    <div class="col-10">
    <center><h5>MNS-University of Engineering and Technology</h5>
                                <h5 class="bg-warning bg-gradient"> ( Credit Hours : <?php echo $count_result; ?> )  ( Course Assigned : <?php echo $course_count_result; ?> )</h5>
                                <h5>Time Table ( <?php echo $Professor_Name; ?> )</h5>
                            </center>
    </div>
</div>

                            <table class="display table table-bordered table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><b>Sr</b></th>
                                        <th><b>Course</b></th>
                                        <th><b>Room</b></th>
                                        <th><b>Time</b></th>
                                        <th><b>Day</b></th>
                                        <th><b>Program</b></th>
                                        <th><b>Session</b></th>
                                        <th><b>Semester</b></th>
                                    </tr>
                                </thead>

<?php while($row = mysqli_fetch_array($result2)) { $i++; ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row["course_assigned"]; ?></td>
                                    <td><?php echo $row["room_name"]; ?></td>
                                    <td><?php echo $row["room_from"]." - ".$row["room_to"]; ?></td>
                                    <td><?php if($row['day']){echo ucwords($row["day"]);}else{echo 'Whole Week';} ?>
                                    <td><?php echo $row["program"]; ?></td>
                                    <td><?php echo $row["session_from"]." - ".$row["session_to"]; ?></td>
                                    <td><?php echo $row["semester"]; ?></td>
                                    </td>
                                </tr>


                                <?php }} ?>
                                </tbody>
                            </table>

                        <button class='btn btn-success mt-5   hide' style='background-color: #343957'
                            onclick="display()">Print Data</button>
                            <?php } ?>


                            <?php if(isset($_POST['search_bysession']))
{

    $Professor_Name = $_POST['professor_name'];
    $session_from = $_POST['session_from'];
    $session_to = $_POST['session_to'];

    $query = "SELECT * FROM timetables WHERE professor_name = '$Professor_Name' AND session_from = '$session_from' AND session_to = '$session_to'";
    $result2 = mysqli_query($con, $query);
    $count = mysqli_query($con, "SELECT COUNT(*) FROM timetables WHERE professor_name = '$Professor_Name'  AND session_from = '$session_from' AND session_to = '$session_to'");
    $course_count = mysqli_query($con, "SELECT COUNT(distinct course_assigned) FROM timetables WHERE professor_name = '$Professor_Name'  AND session_from = '$session_from' AND session_to = '$session_to'");

    $fetchcourse = mysqli_fetch_row($course_count);
    $course_count_result = $fetchcourse['0'];
    $fetchrow = mysqli_fetch_row($count);
    $count_result = $fetchrow['0'];

if ($result2 && mysqli_num_rows($result2) > 0) { 

?>


                        <div class="row">
    <div class="col-2 mb-1">
        <img src="logo.PNG" width="90px">
    </div>
    <div class="col-10">
    <center><h5>MNS-University of Engineering and Technology</h5>
                                <h5 class="bg-warning bg-gradient"> ( Credit Hours : <?php echo $count_result; ?> )  ( Course Assigned : <?php echo $course_count_result; ?> )</h5>
                                <h5>Assigned To  <b><?php echo $Professor_Name; ?> </b>  </h5>
                            </center>
    </div>
</div>

                            <table class="display table table-bordered table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><b>Sr</b></th>
                                        <th><b>Course</b></th>
                                        <th><b>Room</b></th>
                                        <th><b>Time</b></th>
                                        <th><b>Day</b></th>
                                        <th><b>Program</b></th>
                                        <th><b>Session</b></th>
                                        <th><b>Semester</b></th>
                                    </tr>
                                </thead>

<?php while($row = mysqli_fetch_array($result2)) { $i++; ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row["course_assigned"]; ?></td>
                                    <td><?php echo $row["room_name"]; ?></td>
                                    <td><?php echo $row["room_from"]." - ".$row["room_to"]; ?></td>
                                    <td><?php if($row['day']){echo ucwords($row["day"]);}else{echo 'Whole Week';} ?>
                                    <td><?php echo $row["program"]; ?></td>
                                    <td><?php echo $row["session_from"]." - ".$row["session_to"]; ?></td>
                                    <td><?php echo $row["semester"]; ?></td>
                                    </td>
                                </tr>


                                <?php }} ?>
                                </tbody>
                            </table>

                        <button class='btn btn-success mt-5   hide' style='background-color: #343957'
                            onclick="display()">Print Data</button>
                            <?php } ?>


                            <?php if(isset($_POST['search_byprogram']))
{

    $Professor_Name = $_POST['professor_name'];
    $program = $_POST['program'];

    $query = "SELECT * FROM timetables WHERE professor_name = '$Professor_Name' AND program = '$program'";
    $result2 = mysqli_query($con, $query);
    $count = mysqli_query($con, "SELECT COUNT(*) FROM timetables WHERE professor_name = '$Professor_Name' AND program = '$program'");
    $course_count = mysqli_query($con, "SELECT COUNT(distinct course_assigned) FROM timetables WHERE professor_name = '$Professor_Name' AND program = '$program'");

    $fetchcourse = mysqli_fetch_row($course_count);
    $course_count_result = $fetchcourse['0'];
    $fetchrow = mysqli_fetch_row($count);
    $count_result = $fetchrow['0'];

if ($result2 && mysqli_num_rows($result2) > 0) { 

?>


                        <div class="row">
    <div class="col-2 mb-1">
        <img src="logo.PNG" width="90px">
    </div>
    <div class="col-10">
    <center><h5>MNS-University of Engineering and Technology</h5>
                                <h5 class="bg-warning bg-gradient"> ( Credit Hours : <?php echo $count_result; ?> )  ( Course Assigned : <?php echo $course_count_result; ?> )</h5>
                                <h5>Assigned To  <b><?php echo $Professor_Name; ?> </b>  </h5>
                            </center>
    </div>
</div>

                            <table class="display table table-bordered table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><b>Sr</b></th>
                                        <th><b>Course</b></th>
                                        <th><b>Room</b></th>
                                        <th><b>Time</b></th>
                                        <th><b>Day</b></th>
                                        <th><b>Program</b></th>
                                        <th><b>Session</b></th>
                                        <th><b>Semester</b></th>
                                    </tr>
                                </thead>

<?php while($row = mysqli_fetch_array($result2)) { $i++; ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row["course_assigned"]; ?></td>
                                    <td><?php echo $row["room_name"]; ?></td>
                                    <td><?php echo $row["room_from"]." - ".$row["room_to"]; ?></td>
                                    <td><?php echo ucwords($row["day"]); ?>
                                    <td><?php echo $row["program"]; ?></td>
                                    <td><?php echo $row["session_from"]." - ".$row["session_to"]; ?></td>
                                    <td><?php echo $row["semester"]; ?></td>
                                    </td>
                                </tr>


                                <?php }} ?>
                                </tbody>
                            </table>

                        <button class='btn btn-success mt-5   hide' style='background-color: #343957'
                            onclick="display()">Print Data</button>
                            <?php } ?>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function display() {
        var hiding = document.getElementsByClassName('hide');
        $(".rmv").removeClass('content-wrap');

        for (var i = 0; i < hiding.length; ++i) {
            var item = hiding[i];
            item.style.display = 'none';
        }
        window.print();
        location.reload();
    }
    </script>
    <!-- Optional JavaScript -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <!-- bootstrap -->


    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <!-- <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script> -->
    <script src="assets/js/lib/data-table/datatables-init.js"></script>
</body>

</html>