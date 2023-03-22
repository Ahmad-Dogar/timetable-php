<?php
error_reporting(0);
session_start();
include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");
// $con2 = mysqli_connect("localhost","root","","teacherdata");

// error_reporting (E_ALL ^ E_NOTICE);

$create= "CREATE TABLE IF NOT EXISTS `timetables` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`professor_name` varchar(128) NOT NULL,
	`course_assigned` varchar(128) NOT NULL,
	`room_name` varchar(128) NOT NULL,
	`room_from` varchar(128) NOT NULL,
	`room_to` varchar(128) NOT NULL,
	`day` varchar(128) NOT NULL,
	`session_from` int(128) NOT NULL,
	`session_to` int(128) NOT NULL,
	`program` varchar(128) NOT NULL,
	`semester` varchar(128) NOT NULL,
	`section` varchar(128) NOT NULL,
	PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9" ;  
	mysqli_query($con, $create);

	$sessionfrom = $_SESSION['sessionfrom'];
	$sessionto = $_SESSION['sessionto'];
	$program = $_SESSION['program'];
	$section = $_SESSION['section'];
	$semester= $_SESSION['semester'];


	// echo $sessionfrom.$sessionto.$program.$section.$semester;

    $query = "SELECT * FROM master WHERE session_from='$sessionfrom' AND session_to='$sessionto' AND program='$program' AND section='$section' AND semester='$semester'";
    $result = mysqli_query($con, $query);
	if($result){
		// echo '<br>winwin<br>';
	}else{
		die(mysqli_error($con));
	}

	$query2 = "SELECT * FROM remaining_rooms";
    $rooms = mysqli_query($con, $query2);


    $T_Name = "";
    $T_From = "";
    $T_To = "";
    $T_Time = array();
    $S_Name = "";
    $S_Time = "";
    $T_Day = "";
    $New_S_Time = "";
    $id = 0;
	$department = "";
	$session = "";
	// $section = "";    
	$tablebool = true;
	$lab_string = "";

	$break_from = "";
	$break_to = "";


    $R_Name = "";
    $R_From = "";
    $R_To = "";
	$R_Type = "";
    $R_Time = array();
    $T_Array = array();
    $T_Array2 = array();
    $finalarray = array();
    $finalarray2 = array();
    $finalarray3 = array();
    $remArray = array();
    $roomarray = array();
    $roomarrayfinal = array();
    $finalremArray = array();


    $timearray1 = array();
    $timearray2 = array();
    $timearraybool = true;

    $remainingroomarray = array();
    $remainingroomfinalarray = array();
    $roomnamearray = array();
    $remainingroombool = false;

    $array_bool = false;
    $array_bool2 = false;
    $remaining = 0;
    $remainingbool = false;
    $finali = 0;
    $time = "";
    	    $total = 0;
    	    $days = array("monday", "tuesday","wednesday","thursday","friday");
    	    $i=0;
    	    $confirm = 0;
    	    $total2=0;

    	    function remainingrooms(){
    	    	global $con,$rooms, $remainingroomfinalarray, $remainingroombool, $day;

    	    	    if (mysqli_num_rows($rooms) > 0) {
    				
						while($row3 = mysqli_fetch_array($rooms)) {
							$id = $row3["id"];
							$R_Name = $row3["room_name"];
							$R_From = $row3["room_from"];
							$R_To   = $row3["room_to"];
							$R_Day   = $row3["day"];


							$starttime = (int)strtok($R_From, ':');
							$endtime = (int)strtok($R_To, ':');
							
							for ($x = $starttime; $x <= $endtime; $x++) { $R_Time[] = $x; }		

    						// print_r($R_Time);
    						for ($x = 0; $x < count($R_Time)-1; $x++){
								
								foreach ($remainingroomfinalarray as $key => $value) {
										if ($value[$R_Name] == ($R_Time[$x].$R_Time[$x+1])) {
											$remainingroombool = true;
										}
									}
									if ($remainingroombool == false && ($day == $R_Day || empty($R_Day))) {
										// echo $R_Name.$R_Time[$x]." ".$R_Time[$x+1].$day."<br>";
										$roomstarttime = $R_Time[$x].":00";
										$roomendtime = $R_Time[$x+1].":00";
										// echo "coming ";
   					$chk  = mysqli_query($con, "INSERT INTO remaining_rooms (room_name, room_from, room_to, day)VALUES('$R_Name', '$roomstarttime', '$roomendtime', '$day')");
// if($chk)
// {
//     echo "Success!";
// }
// else
// {
//     die(mysql_error());    // Thanks to Pekka for pointing this out.
// }
									}
									$remainingroombool = false;
						}$R_Time = array();
						 mysqli_query($con, "DELETE FROM remaining_rooms WHERE id='".$id."'");

					}
				}mysqli_data_seek($rooms,0);
					$remainingroomfinalarray = array();
						// print_r($roomnamearray);
    	    }

    function findTime($roomtime, $teachertime, $credithours, $course_name, $room_name,$id){
    	global $total, $T_Array, $T_Array2, $answer, $confirm, $con, $b, $finalarray, $finalarray2, $array_bool, $array_bool2, $array_bool3,$R_Name, $T_Name,$remaining, $day, $time, $roomarray, $roomarrayfinal, $remainingroomarray, $remainingroomfinalarray, $department, $session, $section, $timetable,$con2,$timearraybool, $timearray1, $timearray2,$sessionfrom,$sessionto,$program,$semester, $break_from, $break_to;

    	// FOR LOOP FOR TEACHER TIME
    	for ($x = 0; $x < count($teachertime); $x++){

    		if ($total == $credithours) {
    			 break;
    		}
    		// NESTED FOR LOOP FOR ROOM TIME
    		for ($y = 0; $y < count($roomtime)-1; $y++){

    			if ($total == $credithours) {
    				 break;
    			}



    			if ($teachertime[$x]==$roomtime[$y] && $teachertime[$x+1]==$roomtime[$y+1]) {

    				$array_bool = false;
    				$array_bool2 = false;
    				$array_bool3 = false;

    				foreach($finalarray as $index => $array)
					{
					    if ($array[$R_Name] == $teachertime[$x].$teachertime[$x+1]) {
					    	$array_bool = true;
					    	$array_bool2 = true;

					    	break;
					    }
					}
					foreach($finalarray2 as $index2 => $array2)
					{
					    if ($array2[$T_Name] == $teachertime[$x].$teachertime[$x+1]) {
					    	$array_bool = true;
					    	$array_bool3 = true;				
					    	break;
					    }
					}
					 

    				if ($array_bool == false) {
    			$remainingroomarray[$R_Name] = $roomtime[$y].$roomtime[$y+1];
    			$remainingroomfinalarray[] = $remainingroomarray;
    			$remainingroomarray = array();

					foreach($timearray2 as $index3 => $array3)
					{
					    if ($array3[$day] == $roomtime[$y].$roomtime[$y+1]) {
					    $timearraybool = false;			
					    	break;
					    }
					}

    				// echo $day;
    				$timearray1[$day] = $roomtime[$y].$roomtime[$y+1];
    				$timearray2[] = $timearray1;
    				$timearray1 = array();

    				// print_r($timearray2);
    				// echo "<br><br>";    


					$breakfrom = (int)strtok($break_from, ':');
					$breakto = (int)strtok($break_to, ':');

					echo $teachertime[$x]." brk : ". $breakfrom." after: ".$teachertime[$x+1]." brk to: ".$breakto."<br>";
					
					if($breakfrom != $teachertime[$x] && $breakto != $teachertime[$x+1]){

					echo "<br>Check mate: ".$teachertime[$x]." brk : ". $breakfrom." after: ".$teachertime[$x+1]." brk to: ".$breakto."<br>";

					if ($timearraybool) {

    				// echo "(".$teachertime[$x].":00-".$teachertime[$x+1].":00) - ".$course_name." - ".$room_name."<br>";
    				$total++;
    				$remaining++;
    				$time = ($teachertime[$x].":00-".$teachertime[$x+1].":00");
    				// $table = $department."_".$session."_".$section;

    				$teachertablename = $T_Name."_data";
    				$start = $teachertime[$x].":00";
    				$end = $teachertime[$x+1].":00";


    				// echo $course_name.$start.$end."<br>";
    				// $chkquery = mysqli_query($con2, "INSERT INTO $teachertablename (name, time_from, time_to, course_name, class, day)VALUES('$T_Name', '$start', '$end', '$course_name', '$room_name', '$day')");
    				// if ($chkquery) {
    					// echo "running";
    				// }else{die(mysqli_error($con2));}
	// echo $sessionfrom.$sessionto.$program.$section.$semester;

   					// mysqli_query($con, "INSERT INTO timetable (room_name, roomtime, name, course_name, day)VALUES('$R_Name', '$time', '$T_Name', '$course_name', '$day')");

					$err= mysqli_query($con, "INSERT INTO backup_table (professor_name, course_assigned, room_name, room_from,room_to, day,session_from,session_to,program,semester,section)VALUES('$T_Name', '$course_name', '$R_Name', '$start', '$end', '$day','$sessionfrom','$sessionto','$program','$semester','$section')");

   				// if ($err) {
				// 	echo 'winn';
				// }else {
				// 	die(mysqli_error($con));
				// }	
				}
			}else{
				$start = $teachertime[$x].":00";
				$end = $teachertime[$x+1].":00";
				$err= mysqli_query($con, "INSERT INTO backup_table (professor_name, course_assigned, room_name, room_from,room_to, day,session_from,session_to,program,semester,section)VALUES('0', '0', 'break', '$start', '$end', '$day','$sessionfrom','$sessionto','$program','$semester','$section')");

			}
    				$timearraybool = true;

    				}


    				if ($array_bool3 == false) {
    				$T_Array[$room_name] = $teachertime[$x].$teachertime[$x+1];
    				$finalarray[] = $T_Array;
    				$T_Array = array();
    				}

    				if ($array_bool2 == false) {
    				$T_Array2[$T_Name] = $teachertime[$x].$teachertime[$x+1];
    				$finalarray2[] = $T_Array2;
    				$T_Array2 = array();
    				}

    			} else{
    				$roomarray[$room_name] = $roomtime[$y].$roomtime[$y+1];
    				$roomarrayfinal[] = $roomarray;
    				$roomarray = array();


    				foreach ($roomarrayfinal as $index => $key) {
    					
    					foreach($finalarray as $index2 => $array)
						{
						    if ($array[$R_Name] == $key[$R_Name]) {
						    	unset($roomarrayfinal[$index]);
						    }
						}
    				}
    				// echo "remainingtime = ".$roomtime[$y].":00".$roomtime[$y+1].":00 ".$R_Name."<br>";
    			}

    		}
    	}		

    	    	$T_Time= $teachertime;


    }
$val = 0;
$T_Time = array();

while ($i < 5) {


	$day = $days[$i];
	// echo "<br><b>".$day."</b>";
			$remaining = $finali;
			// echo "remaining : ".$remaining;
    $remainingbool = false;

// FETCHING TEACHERS DATA FROM SQL 
if (mysqli_num_rows($result) > 0) {

	while($row = mysqli_fetch_array($result)) {
		$val++;

				// $New_S_Time = $row["newsubjecttime"];

		// echo "<br>newS value is ".$New_S_Time.$val."<br>";
		$id = $row["id"];
		$T_Name = $row["professor"];
		$break_from = $row["breakfrom"];
		$break_to = $row["breakto"];

		// $teacher_query=mysqli_query($con, "SELECT time_from FROM remaining_professors WHERE name='$T_Name'");
		// $query_result = mysqli_fetch_row($teacher_query);
		// $T_From = $query_result['0'];

		// $teacher_query2=mysqli_query($con, "SELECT time_to FROM remaining_professors WHERE name='$T_Name'");
		// $query_result2 = mysqli_fetch_row($teacher_query2);
		// $T_To = $query_result2['0'];

		$teacher_query3=mysqli_query($con, "SELECT time_from, time_to, day FROM remaining_professors WHERE name='$T_Name'");
		// $query_result3 = mysqli_fetch_row($teacher_query);
		// $T_Day = strtolower($query_result3['0']);

		while($row2 = mysqli_fetch_array($teacher_query3)) {
			$T_Day = strtolower($row2['day']);
			$T_From = ($row2['time_from']);
			$T_To = ($row2['time_to']);

		$S_Name = $row["course_assigned"];

		// $lab_string = str_contains(string, substring);

		if ($T_Day == $day || empty($T_Day) || $T_Day == " ") {


// echo "<br> time is ".$S_Time."<br>";
// print_r($finalremArray);
$remaining = "";
		foreach($finalremArray as $index => $array)
					{

						if (!empty($array[$S_Name.$T_Name])) {
					// print_r($finalremArray);

						$remaining = $array[$S_Name.$T_Name];

						// echo "index ".$S_Name;
						if ($remaining == 1000) {
   							 $remainingbool = true;
						}						 
						break;
						}

					}
		// echo "remaing is ".$remaining."<br>";	

		if ($remaining > 0 || $remaining == 1000) {
				if ($remaining == 1000) {	$S_Time = 0;}else{$S_Time = $remaining; $remaining = 0;}
				}else{
					$teacher_query4=mysqli_query($con, "SELECT credithour FROM courses WHERE course_name='$S_Name'");
					$query_result4 = mysqli_fetch_row($teacher_query4);
					$S_Time = $query_result4['0']; }
// echo "sub time is ".$S_Time;
						$T_Array2[$T_Name] = "null";
		$finalarray2[] = $T_Array2;
		$T_Array2 = array();	

		// echo "<br>";

		$starttime = (int)strtok($T_From, ':');
		$endtime = (int)strtok($T_To, ':');

		for ($x = $starttime; $x <= $endtime; $x++) { $T_Time[] = $x; }		
		// echo "subject time is ".$S_Time."<br>";


// FETCHING ROOM DATA FROM SQL INSIDE TEACHERS DATA WHILE LOOP

    if (mysqli_num_rows($rooms) > 0) {

	while($row2 = mysqli_fetch_array($rooms)) {
    	// echo "bbbj";

		$R_Name = $row2["room_name"];
		$R_From = $row2["room_from"];
		$R_To   = $row2["room_to"];
		$R_Type   = $row2["type"];
		$R_Day   = strtolower($row2["day"]);

		if ($R_Day == $day || empty($R_Day)) {
			if($R_Type == 'room' && !str_contains($S_Name, 'lab'))
			{
		// echo $R_Day.' : '.$day.'<br>';

		// echo "another time is ".$R_Name.$R_From.$R_To.$R_Day."<br>";
		// echo "another time is <br>";


		$starttime = (int)strtok($R_From, ':');
		$endtime = (int)strtok($R_To, ':');		

		for ($x = $starttime; $x <= $endtime; $x++) { $R_Time[] = $x; }		
							// echo " ".$S_Time."<br>";


		findTime($R_Time, $T_Time, (int)$S_Time,$S_Name, $R_Name,$id);
		// echo "remmm ".$remaining." ".$S_Time."<br>";
		
	$R_Time = array();
	foreach ($roomarrayfinal as $key) {
	if (!empty($key[$R_Name])) {
		// echo $key[$R_Name]." ".$R_Name." ";
	}
	// print_r($roomarrayfinal);
	
	$roomarrayfinal = array();
	}
	// print_r($roomarrayfinal);
	}elseif(str_contains($S_Name, 'lab') && $R_Type == 'lab')
		{
			$starttime = (int)strtok($R_From, ':');
			$endtime = (int)strtok($R_To, ':');		
	
			for ($x = $starttime; $x <= $endtime; $x++) { $R_Time[] = $x; }		
								// echo " ".$S_Time."<br>";
	
	
			findTime($R_Time, $T_Time, (int)$S_Time,$S_Name, $R_Name,$id);
			// echo "remmm ".$remaining." ".$S_Time."<br>";
			
		$R_Time = array();
		foreach ($roomarrayfinal as $key) {
		if (!empty($key[$R_Name])) {
			// echo $key[$R_Name]." ".$R_Name." ";
		}
		// print_r($roomarrayfinal);
		
		$roomarrayfinal = array();
		}
		// print_r($roomarrayfinal);
		}
	}
}
		// echo "remmm ".$remaining." ".$S_Time.$S_Name."<br>";

	if ($remaining == $S_Time) {
				foreach ($finalremArray as $key => $value) {
			if (!empty($value[$S_Name.$T_Name])) {
				unset($finalremArray[$key]);
			}
		}
    	$remArray[$S_Name.$T_Name] = 1000;
    	$finalremArray[] = $remArray;
    	// print_r($finalremArray);
    	$remArray = array();		
		// echo "zero = ".$remArray;
	}
	

	if ($remaining < $S_Time && $remaining > 0) {
		$remaining = $S_Time-$remaining;
		foreach ($finalremArray as $key => $value) {
			if (!empty($value[$S_Name.$T_Name])) {
				unset($finalremArray[$key]);
			}
		}
		$remArray[$S_Name.$T_Name] = $remaining;
    	$finalremArray[] = $remArray;
    	$remArray = array();
    	// print_r($finalremArray);
		// echo "remiaing = ".$S_Time."<br>";
	}


	// echo "<br>";
	// print_r($finalarray2);
	// echo "<br>";

}mysqli_data_seek($rooms,0);
// echo "sub time is ".$S_Time.' rem '.$remaining.' subname '.$S_Name;

}


$T_Time = array();
$finali = $remaining;
    $remaining = 0;


	$total = 0;

}
	}

	}mysqli_data_seek($result,0);
	$finalarray2 = array();
	$finalarray = array();

					// print_r($finalremArray);



// remainingrooms();

						// print_r($finalremArray);

$i++;
}

    header('location: timetable_check.php');


?>