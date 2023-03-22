<?php
session_start();
include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['add_professor']))
{
    $name = $_POST['name'];
    $from = $_POST['professorfrom'];
    $to = $_POST['professorto'];
    $day = $_POST['day'];




    $chk_query = "SELECT name FROM professors WHERE name='$name' AND time_from='$from' AND time_to='$to' AND day='$day' ";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $chk_name = $query_result['0'];


    $name_chk = "SELECT name FROM professors WHERE name='$name'";
    $name_run_query = mysqli_query($con, $name_chk);

    $name_result = mysqli_fetch_row($name_run_query);
    $r_name = $name_result['0'];

    if ($r_name == $name && $day == "") {

        $_SESSION['status'] = "Cannot add whole week if already added the week days";
        header("Location: professor.php");
        exit(0);

    }

    if($chk_name == $name)
    {
        $_SESSION['status'] = "data already exists";
        header("Location: professor.php");
        exit(0);
    }

    $query = "INSERT INTO professors (name,time_from,time_to,day) VALUES ('$name','$from','$to','$day')";
    $query_run = mysqli_query($con, $query);

    $query2 = mysqli_query($con, "INSERT INTO remaining_professors (name,time_from,time_to,day) VALUES ('$name','$from','$to','$day')");

    if($query_run)
    {
        $_SESSION['status'] = " Data Inserted Successfully";
        header("Location: professor.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: professor.php");
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
    $name = strval(($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
    $from = strval(($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
    $to = strval(($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
    $day = strtolower(strval(($worksheet->getCellByColumnAndRow(3, $row)->getValue())));

    if(empty($name) && empty($from) && empty($to) && empty($day)){    continue;    }
    if(empty($name)){  $_SESSION['status'] = "field is empty"; header("Location: professor.php"); exit(0); }
    if(empty($from)){  $_SESSION['status'] = "ield is empty"; header("Location: professor.php"); exit(0); }
    if(empty($to)){  $_SESSION['status'] = "field is empty"; header("Location: professor.php"); exit(0); }
    // if(empty($day)){  $_SESSION['status'] = "field is empty"; header("Location: professor.php"); exit(0); }
    
    if($day == 'Whole Week'|| $day == 'whole week' || $day == 'WholeWeek'){
        $day = '';
    }

    $chk_query = "SELECT name FROM professors WHERE name='$name' AND time_from='$from' AND time_to='$to' AND day='$day' ";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $chk_name = $query_result['0'];


    $name_chk = "SELECT name FROM professors WHERE name='$name'";
    $name_run_query = mysqli_query($con, $name_chk);

    $name_result = mysqli_fetch_row($name_run_query);
    $r_name = $name_result['0'];

    if ($r_name == $name && $day == "") {

        $_SESSION['status'] = "Cannot add whole week if already added the week days";
        header("Location: professor.php");
        exit(0);

    }

    if($chk_name == $name)
    {
        $_SESSION['status'] = "data already exists";
        header("Location: professor.php");
        exit(0);
    }

    $query = "INSERT INTO professors (name,time_from,time_to,day) VALUES ('$name','$from','$to','$day')";
    $query_run = mysqli_query($con, $query);

    $query2 = mysqli_query($con, "INSERT INTO remaining_professors (name,time_from,time_to,day) VALUES ('$name','$from','$to','$day')");

    if($query_run)
    {
        // $_SESSION['status'] = " Data Inserted Successfully";
        // header("Location: professor.php");
        // exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: professor.php");
        exit(0);
    }
    }



}
  } 
  $output .= 'uploaded the data successfully!';
  $_SESSION['status'] = $output;
  header("Location: professor.php");
  exit(0); 
 }
 else
 {
  $output = 'Invalid File';
  $_SESSION['status'] = $output;
  header("Location: professor.php");
  exit(0);
 }


?>