<?php 

include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");
if(isset($_POST['resetTable']))
{
$delete = mysqli_multi_query($con, "TRUNCATE table remaining_rooms");

$create = "INSERT INTO `remaining_rooms` SELECT * FROM `rooms`";
  $chk = mysqli_query($con, $create);

  if ($chk) {
    header("Location: rem_roomlab.php");
    exit(0);
  }else{
  	die(mysqli_error($con));
  }

}
?>
