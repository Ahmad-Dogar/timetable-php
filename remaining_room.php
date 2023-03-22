<?php
// session_start();

include("database.php");

	// $sessionfrom = $_SESSION['sessionfrom'];
	// $sessionto = $_SESSION['sessionto'];
	// $program = $_SESSION['program'];
	// $section = $_SESSION['section'];
	// echo $sessionfrom.$sessionto.$program.$section;

// $con = mysqli_connect("localhost","root","","timetable");

$query = "SELECT * FROM remaining_rooms";
$rem_rooms = mysqli_query($con, $query);

$query2 = "SELECT * FROM timetables";
$del_rooms = mysqli_query($con, $query2);

$days = array("monday", "tuesday","wednesday","thursday","friday");
$i=0;

while($row = mysqli_fetch_array($rem_rooms)) {

		$id = $row["id"];
		$name = $row["room_name"];
		$timefrom = $row["room_from"];
		$timeto = $row["room_to"];
		$type = $row["type"];
		$day = $row["day"];

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

   			mysqli_query($con, "INSERT INTO remaining_rooms (room_name, room_from, room_to, type, day)VALUES('$name', '$start', '$end', '$type', '$R_day')");

        }	
        // echo '<br>';
    }
    $i=0;
    }else{
        for ($x = $starttime; $x <= $endtime-1; $x++) {
            
            // echo 'T_name: '.$name.' '.$x.':00 - '.($x+1).':00'.$day.'<br>';
            $start=$x.':00';
            $end=($x+1).':00';
        
            mysqli_query($con, "INSERT INTO remaining_rooms (room_name, room_from, room_to, type, day)VALUES('$name', '$start', '$end', '$type', '$day')");

        }	
        // echo '<br>';
    }
    mysqli_query($con, "DELETE FROM remaining_rooms WHERE id='".$id."'");


        // echo '<br>';
}


while($row = mysqli_fetch_array($del_rooms)) {

    $id = $row["id"];
    // $name = $row["professor_name"];
    // $course_assigned = $row["course_assigned"];
    $name = $row["room_name"];
    $time_from = $row["room_from"];
    $time_to = $row["room_to"];
    $day = $row["day"];

    // mysqli_query($con, "DELETE FROM remaining_rooms WHERE name= 'Teacher1' AND time_from='8:00' AND time_to='9:00' AND day='Monday'");
    mysqli_query($con, "DELETE FROM remaining_rooms WHERE room_name='$name' AND room_from='$time_from' AND room_to='$time_to' AND day='$day'");

}


header('location: remaining_professor.php');
// echo("<script>location.href = 'remaining_professor.php';</script>");


?>