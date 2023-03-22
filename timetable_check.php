<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

        <!-- Styles -->
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    
<?php
session_start();
// $con = mysqli_connect("localhost","root","","timetable");
include("database.php");
$_SESSION['total'] = '';


if($_SESSION['mode'])
{
$mode = $_SESSION['mode'];
}else{
    $mode = '';
}



// function missingdata()
// {
// include("database.php");

// $assigned_teacher = mysqli_query($con, "SELECT DISTINCT professor_name FROM backup_table");
// $total_teacher = mysqli_query($con, "SELECT DISTINCT professor FROM master");

// $assigned_time = mysqli_query($con, "SELECT time_from, time_to FROM remaining_professors WHERE name='$assigned_teacher'");



// }


$query = "SELECT DISTINCT course_assigned FROM backup_table";
$courses_chk = mysqli_query($con, $query);

$query = "SELECT DISTINCT course_assigned FROM master";
$table_chk = mysqli_query($con, $query);

$courses = array();
$hours = array();
$matchFound = 0;    
$total = 0;

while($row = mysqli_fetch_array($table_chk)) {

    $course_assigned = $row['course_assigned'];
    // echo $row['course_assigned'];
    $result = mysqli_query($con, "SELECT course_assigned FROM backup_table WHERE course_assigned = '$course_assigned'");
$matchFound = mysqli_num_rows($result) > 0 ? 'true' : 'false';

       if($matchFound == 'true')
       {
        // echo 'true<br>';
       }
       else
       {
        // echo 'not true<br>';
        $course_assigned = $row['course_assigned'];
        $credithour = mysqli_query($con, "SELECT credithour FROM courses WHERE course_name='$course_assigned'");
        $result1=mysqli_fetch_assoc($credithour);
        $courses[] = $row['course_assigned'];
        $hours[] = $result1['credithour'];
       }



}

while($row = mysqli_fetch_array($courses_chk)) {

    $course_assigned = $row["course_assigned"];

    if($course_assigned != '0'){
    $credithour = mysqli_query($con, "SELECT credithour FROM courses WHERE course_name='$course_assigned'");
    $result1=mysqli_fetch_assoc($credithour);


    $course_chk=mysqli_query($con, "SELECT count(*) as course_assigned from backup_table WHERE course_assigned='$course_assigned'");
    $result2=mysqli_fetch_assoc($course_chk);
    if ($result2['course_assigned'] == $result1['credithour']) {
        // echo $course_assigned.' has all lectures INN<br>';
    }
    else
    {
        // echo $course_assigned.' Opps'.($result1['credithour']-$result2['course_assigned']).'<br>';
        $courses[] = $course_assigned;
        $hours[] = ($result1['credithour']-$result2['course_assigned']);

    }

}
}
if (!empty($courses)) {


 echo "<script>$(document).ready(function(){
$('#confirmationmessag').modal('show');
});
</script>";
    // $delete = mysqli_multi_query($con, "TRUNCATE table backup_table");

}else {
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

    $table2 = "INSERT INTO `timetables` (professor_name, course_assigned, room_name,room_from,room_to,day,session_from,session_to, program,semester,section, mode) VALUES ('$name', '$course', '$room_name', '$room_from', '$room_to', '$day', '$session_form', '$session_to', '$program', '$semester','$section','$mode')";
    $chk = mysqli_query($con, $table2);

    }
    header('location: timetable.php');
    $delete = mysqli_multi_query($con, "TRUNCATE table backup_table");   
  exit(0); 

}


?>

<div class="modal fade bd-example-modal-sm" id="confirmationmessag" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="text-align:center" role="document">
       
        <div class="modal-content p-4">
            <input type="hidden" name="id2" id="id2" >
            <div class=" py-4 w-100 text-center">
            <img src="alert.PNG" width="50px" height="50px" >
        </div>

        <h3 class="pb-1 modal-title w-100 text-center mb-5"  id="exampleModalLongTitle">Couldn't Complete the Table</h3>

            <!-- <div class="container-fluid" style="margin-top:10px;margin-bottom:30px">
        Either room or professor availability is missing. These are the following couorses that couldn't be added
            </div> -->

        <table class="table table-bordered table-striped">
        <thead class="thead">
 <tr>
 <th>Course Name</th>
 <th>Missing Lecture</th>
 </tr>
</thead>
            <tr>
                <?php foreach($courses as $index => $answer) {  if(str_contains($hours[$index], '-')){unset($hours[$index]);unset($answer);}else{?>
                <td><?php echo $answer; ?></td>
                <td><?php 
               
                echo $hours[$index]; $total += $hours[$index]; } ?></td>
            </tr>
            <?php $_SESSION['total'] = $total; } ?>
        </table>

        <div class="py-4 justify-content-center">
            <a type="button" class="btn btn-secondary text-light" href="index.php" >Go Back</a>
            <span class="mx-2"></span>
            <a type="button" class="btn btn-primary text-light" href="incomplete_timetable.php">Check TimeTable</a>
        </div>

    </div>
</div>

    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- // <script> -->
    // $(document).ready(function(){
    //     $("#confirmationmessag").modal(    backdrop: 'static',
    // keyboard: false);    
    // });



    <script src="assets/js/lib/bootstrap.min.js"></script><script src="assets/js/scripts.js"></script>
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