<?php 

include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");
if(isset($_POST['resetTable'])){
$delete = mysqli_multi_query($con, "TRUNCATE table remaining_professors");
// SET FOREIGN_KEY_CHECKS=0;


$create = "INSERT INTO `remaining_professors` SELECT * FROM `professors`";
  $chk = mysqli_query($con, $create);

  if ($chk) {
  	// echo "running";
    header("Location: rem_professor.php");

  }else{
  	die(mysqli_error($con));
  }
//   SET FOREIGN_KEY_CHECKS=1;

}
?>
