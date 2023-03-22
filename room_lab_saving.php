<?php
session_start();
// $con = mysqli_connect("localhost","root","","timetable");
include("database.php");


if(isset($_POST['add_room']))
{
    $roomname = $_POST['roomname'];
    $roomfrom = $_POST['roomfrom'];
    $roomto = $_POST['roomto'];
    $type = $_POST['type'];
    $day = $_POST['day'];


    $chk_query = "SELECT room_name FROM rooms WHERE room_name='$roomname' AND room_from='$roomfrom' AND room_to='$roomto' AND day='$day' AND type= '$type'";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $chk_name = $query_result['0'];


    $name_chk = "SELECT room_name FROM rooms WHERE room_name='$roomname'";
    $name_run_query = mysqli_query($con, $name_chk);

    $name_result = mysqli_fetch_row($name_run_query);
    $r_name = $name_result['0'];

    $type_chk = "SELECT type FROM rooms WHERE type='$type'";
    $type_run_query = mysqli_query($con, $type_chk);

    $type_result = mysqli_fetch_row($type_run_query);
    $r_type = $type_result['0'];

    if ($r_name == $roomname && $day == "" && $type == $r_type) {

        $_SESSION['status'] = "cannot add whole week if already exists the week days";
        header("Location: room_lab.php");
        exit(0);

    }

    if($chk_name == $roomname)
    {
        $_SESSION['status'] = "data already exists";
        header("Location: room_lab.php");
        exit(0);
    }



    $query1 = mysqli_query($con, "INSERT INTO rooms (room_name,room_from, room_to, type, day) VALUES ('$roomname','$roomfrom','$roomto','$type', '$day')");
    $query2 = mysqli_query($con, "INSERT INTO remaining_rooms (room_name,room_from, room_to, type, day) VALUES ('$roomname','$roomfrom','$roomto','$type', '$day')");

    if($query1 || $query2)
    {
        $_SESSION['status'] = "Data Inserted Successfully";
        header("Location: room_lab.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: room_lab.php");
        exit(0);
    }
}

if(isset($_POST["import"]))
{
 $output = '';
 $fileName      = 'testing.xlsx';
 $tmp           = explode('.', $fileName);
 $extension = end($tmp);

 $allowed_extension = array("xls", "xlsx", "csv");
  
 if(in_array($extension, $allowed_extension)) 
 {
  $file = $_FILES["excel"]["tmp_name"]; 
  include("phpexcel/Classes/PHPExcel/IOFactory.php"); 
  $objPHPExcel = PHPExcel_IOFactory::load($file); 

  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=4; $row<=$highestRow; $row++)
   {
    $roomname = strval(($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
    $roomfrom = strval(( $worksheet->getCellByColumnAndRow(1, $row)->getValue()));
    $roomto = strval(( $worksheet->getCellByColumnAndRow(2, $row)->getValue()));
    $type = strtolower(strval(( $worksheet->getCellByColumnAndRow(3, $row)->getValue())));
    $day = strtolower(strval(( $worksheet->getCellByColumnAndRow(4, $row)->getValue())));

    if(empty($roomname) && empty($roomfrom) && empty($roomto) && empty($day) && empty($type)){    continue;    }
    if(empty($roomname)){  $_SESSION['status'] = "field is empty"; header("Location: room_lab.php"); exit(0); }
    if(empty($roomfrom)){  $_SESSION['status'] = "ield is empty"; header("Location: room_lab.php"); exit(0); }
    if(empty($roomto)){  $_SESSION['status'] = "field is empty"; header("Location: room_lab.php"); exit(0); }
    // if(empty($day)){  $_SESSION['status'] = "field is empty"; header("Location: room_lab.php"); exit(0); }
    if(empty($type)){  $_SESSION['status'] = "field is empty"; header("Location: room_lab.php"); exit(0); }

    if($day == 'Whole Week'){
        $day = '';
    }
    $chk_query = "SELECT room_name FROM rooms WHERE room_name='$roomname' AND room_from='$roomfrom' AND room_to='$roomto' AND day='$day' AND type= '$type'";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $chk_name = $query_result['0'];


    $name_chk = "SELECT room_name FROM rooms WHERE room_name='$roomname'";
    $name_run_query = mysqli_query($con, $name_chk);

    $name_result = mysqli_fetch_row($name_run_query);
    $r_name = $name_result['0'];

    $type_chk = "SELECT type FROM rooms WHERE type='$type'";
    $type_run_query = mysqli_query($con, $type_chk);

    $type_result = mysqli_fetch_row($type_run_query);
    $r_type = $type_result['0'];

    if ($r_name == $roomname && $day == "" && $type == $r_type) {

        $_SESSION['status'] = "cannot add whole week if already exists the week days";
        header("Location: room_lab.php");
        exit(0);

    }

    if($chk_name == $roomname)
    {
        $_SESSION['status'] = "data already exists";
        header("Location: room_lab.php");
        exit(0);
    }



    $query1 = mysqli_query($con, "INSERT INTO rooms (room_name,room_from, room_to, type, day) VALUES ('$roomname','$roomfrom','$roomto','$type', '$day')");
    $query2 = mysqli_query($con, "INSERT INTO remaining_rooms (room_name,room_from, room_to, type, day) VALUES ('$roomname','$roomfrom','$roomto','$type', '$day')");

    }



}
  } 
  $output .= 'uploaded the data successfully!';
  $_SESSION['status'] = $output;
  header("Location: room_lab.php");
  exit(0); 
 }
 else
 {
  $output = 'Invalid File';
  $_SESSION['status'] = $output;
  header("Location: room_lab.php");
  exit(0);
 }
?>