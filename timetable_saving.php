<?php
session_start();
include("database.php");

if($_SESSION['mode'])
{
$mode = $_SESSION['mode'];
}else{
    $mode = '';
}


$create= "CREATE TABLE IF NOT EXISTS `master` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `professor` varchar(128) NOT NULL,
    `course_assigned` varchar(128) NOT NULL,
    `session_from` varchar(128) NOT NULL,
    `session_to` varchar(128) NOT NULL,
    `semester` varchar(128) NOT NULL,
    `program` varchar(128) NOT NULL,
    `department` varchar(128) NOT NULL,
    `section` varchar(128) NOT NULL,
    `breakfrom` varchar(128) NOT NULL,
    `breakto` varchar(128) NOT NULL,
    PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9" ;   
    mysqli_query($con, $create);
// $con = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['add_timetable']))
{
    $program = $_POST['program'];
    $sessionfrom = $_POST['sessionfrom'];
    $sessionto = $_POST['sessionto'];
    $semester = $_POST['semester'];
    $professor = $_POST['professor'];
    $course = $_POST['course'];
    $section = $_POST['section'];
    if($_POST['breakfrom']){$breakfrom = $_POST['breakfrom'];}else{$breakfrom = '0:0';}
    if($_POST['breakto']){$breakto = $_POST['breakto'];}else{$breakto = '0:0';}
    

    $chk_query = "SELECT semester FROM timetables WHERE program='$program' AND session_from='$sessionfrom' AND session_to='$sessionto' AND semester='$semester' AND section= '$section'";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $chk_name = $query_result['0'];

    if ($chk_name == $semester) {
        $_SESSION['status'] = "Timetable already exists for this class!";
        header("Location: index.php");
        exit(0);
    }

    $department_query=mysqli_query($con, "SELECT department_id FROM program WHERE name='$program'");
    $query_result = mysqli_fetch_row($department_query);
    $depart_id = $query_result['0'];

    $department_query2=mysqli_query($con, "SELECT Name FROM departments WHERE id='$depart_id'");
    $query_result2 = mysqli_fetch_row($department_query2);
    $department = $query_result2['0'];

    foreach($professor as $index => $professors)
    {
        $s_professor =  ucwords($professors);
        $s_course =  ucwords($course[$index]);

        
        $query = "INSERT INTO master (professor,course_assigned, session_from, session_to, semester, program, department, section,breakfrom, breakto) VALUES ('$s_professor','$s_course','$sessionfrom', '$sessionto', '$semester', '$program', '$department','$section', '$breakfrom', '$breakto')";
        $query_run = mysqli_query($con, $query);    
    }



    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        $_SESSION['sessionfrom'] = $sessionfrom;
        $_SESSION['sessionto'] = $sessionto;
        $_SESSION['program'] = $program;
        $_SESSION['semester'] = $semester;
        $_SESSION['section'] = $section;

        header('location: remaining_room.php');
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: create_timetable.php");
        // exit(0);
    }
}
    // header('location: output.php');


    if(isset($_POST['del'])){
        mysqli_multi_query($con, "TRUNCATE table backup_table");   
    // mysqli_query($con, "DROP TABLE master");
    
        header('location: index.php');
        exit(0); 
    }

    if(isset($_POST['save'])){

        $table1 = mysqli_query($con, "SELECT * FROM `backup_table`");
        while ($row = mysqli_fetch_array( $table1,MYSQLI_ASSOC))
        {
        $name = $row['professor_name'];
        $course = $row['course_assigned'];
        $room_name = $row['room_name'];
        $room_from = $row['room_from'];
        $room_to = $row['room_to'];
        $day = $row['day'];
        $session_form = $row['session_from'];
        $session_to = $row['session_to'];
        $program = $row['program'];
        $semester = $row['semester'];
        $section = $row['section'];
    
        $table2 = "INSERT INTO `timetables` (professor_name, course_assigned, room_name,room_from,room_to,day,session_from,session_to, program,semester,section, mode) VALUES ('$name', '$course', '$room_name', '$room_from', '$room_to', '$day', '$session_form', '$session_to', '$program', '$semester','$section', '$mode')";
        $chk = mysqli_query($con, $table2);
    }
    header('location: timetable.php');
    exit(0); 
}
?>