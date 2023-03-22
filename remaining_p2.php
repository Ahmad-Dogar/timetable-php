<?php
// session_start();

	$sessionfrom = $_SESSION['sessionfrom'];
	$sessionto = $_SESSION['sessionto'];
	$program = $_SESSION['program'];
	$section = $_SESSION['section'];
    
include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");

$query = "SELECT * FROM remaining_professors";
$rem_professors = mysqli_query($con, $query);

$query2 = "SELECT * FROM timetables";
$del_professors = mysqli_query($con, $query2);

$days = array("monday", "tuesday","wednesday","thursday","friday");
$i=0;

while($row = mysqli_fetch_array($rem_professors)) {

		$id = $row["id"];
		$name = $row["name"];
		$timefrom = $row["time_from"];
		$timeto = $row["time_to"];
		$day = $row["day"];
		$program_id = $row["program_id"];

		$starttime = (int)strtok($timefrom, ':');
		$endtime = (int)strtok($timeto, ':');	
        
        if($day == ''||$day == null || $day ==' ')
        {
            while ($i < 5) {


                $R_day = $days[$i];
                $i++;

		for ($x = $starttime; $x <= $endtime-1; $x++) {
            
            // echo 'T_name: '.$name.' '.$x.':00 - '.($x+1).':00'.$R_day.'<br>';
            $start=$x.':00';
            $end=($x+1).':00';

   			mysqli_query($con, "INSERT INTO remaining_professors (name, time_from, time_to, day, program_id)VALUES('$name', '$start', '$end', '$R_day', '$program_id')");

        }	
        // echo '<br>';
    }
    $i=0;
    }else{
        for ($x = $starttime; $x <= $endtime-1; $x++) {
            
            // echo 'T_name: '.$name.' '.$x.':00 - '.($x+1).':00'.$day.'<br>';
            $start=$x.':00';
            $end=($x+1).':00';
        
            mysqli_query($con, "INSERT INTO remaining_professors (name, time_from, time_to, day, program_id)VALUES('$name', '$start', '$end', '$day', '$program_id')");

        }	
        // echo '<br>';
    }
    mysqli_query($con, "DELETE FROM remaining_professors WHERE id='".$id."'");


        // echo '<br>';
}


while($row = mysqli_fetch_array($del_professors)) {

    $id = $row["id"];
    $name = $row["professor_name"];
    // $course_assigned = $row["course_assigned"];
    // $room_name = $row["room_name"];
    $time_from = $row["room_from"];
    $time_to = $row["room_to"];
    $day = $row["day"];

    // mysqli_query($con, "DELETE FROM remaining_professors WHERE name= 'Teacher1' AND time_from='8:00' AND time_to='9:00' AND day='Monday'");
    mysqli_query($con, "DELETE FROM remaining_professors WHERE name='$name' AND time_from='$time_from' AND time_to='$time_to' AND day='$day'");


}

header('location: timetable.php');


?>