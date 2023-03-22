<?php
session_start();
include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['add_depart']))
{
    $depart = $_POST['department'];

    $chk_query = "SELECT Name FROM departments WHERE Name='$depart' ";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $name = $query_result['0'];

    if($name == $depart)
    {
        $_SESSION['status'] = "Department already exists";
        header("Location: department.php");
        exit(0);
    }
    

    $query = "INSERT INTO departments (Name) VALUES ('$depart')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Inserted Successfully!";
        header("Location: department.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data already exists";
        header("Location: department.php");
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
    $depart = strval(($worksheet->getCellByColumnAndRow(0, $row)->getValue()));

    
    if(empty($depart)){    continue;    }
 
    
    $chk_query = "SELECT Name FROM departments WHERE Name='$depart' ";
    $run_query = mysqli_query($con, $chk_query);

    $query_result = mysqli_fetch_row($run_query);
    $name = $query_result['0'];

    if($name == $depart)
    {
        $_SESSION['status'] = "Department already exists";
        header("Location: department.php");
        exit(0);
    }
    

    $query = "INSERT INTO departments (Name) VALUES ('$depart')";
    $query_run = mysqli_query($con, $query);
   
    }



}
  } 
  $output .= 'uploaded the data successfully!';
  $_SESSION['status'] = $output;
  header("Location: department.php");
  exit(0); 
 }
 else
 {
  $output = 'Invalid File';
  $_SESSION['status'] = $output;
  header("Location: department.php");
  exit(0);
 }

?>