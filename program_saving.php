<?php
session_start();
include("database.php");
// $con = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['program_saving']))
{
    $depart = $_POST['depart'];
    $programD = $_POST['program'];
    $programname = $_POST['programname'];
    $sections = $_POST['sections'];
    
    $section_array = explode (",", $sections);
    // echo $sections . ' ';
    // print_r($section_array);
    $program = $programD."".$programname;

    //fetching depart name from depart ID to save to DB table

    $query = "SELECT id FROM departments WHERE Name='$depart' limit 1";
    $run_query = mysqli_query($con, $query);

    $query_result = mysqli_fetch_row($run_query);
    $depart_id = $query_result['0'];

    //fetching program name from program table

    $program_chk = "SELECT name FROM program WHERE name='$program' ";
    $program_run = mysqli_query($con, $program_chk);

    $fetch_query = mysqli_fetch_row($program_run);
    $program_name = $fetch_query['0'];
    $query_run = '';
    

    foreach($section_array as $index => $sect)
    {
        $a_sections =  ucwords($sect);

        $section_chk = "SELECT section FROM program WHERE section='$a_sections' AND name='$program' ";
        $section_run = mysqli_query($con, $section_chk);
    
        $fetch_query2 = mysqli_fetch_row($section_run);
        $section_name = $fetch_query2['0'];

        // echo $section_name;
        if (empty($section_name)) {
            $section_name = 'null';
        }


        // echo $program_name . ' ' . $section_name .' ' . $program . ' '. $a_sections;
        if($program_name == $program && $section_name == $a_sections)
        {
           
        }else{
            $query = "INSERT INTO program (name,section,department_id) VALUES ('$program','$a_sections','$depart_id')";
            $query_run = mysqli_query($con, $query); 

        }

        
   
    }

    // $query = "INSERT INTO rooms (room_name,room_from, room_to) VALUES ('$roomname','$roomfrom','$roomto')";
    // $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = " Data Inserted Successfully";
        header("Location: program.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data failed ";
        header("Location: program.php");
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
    $programD = strval(($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
    $programname = strval(($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
    $sections = strval(($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
    
    if(empty($programname) && empty($programD) && empty($sections)){    continue;    }
    if(empty($programname)){  $_SESSION['status'] = "Program Name field is empty"; header("Location: program.php"); exit(0); }
    if(empty($programD)){  $_SESSION['status'] = "Program Degree field is empty"; header("Location: program.php"); exit(0); }
    if(empty($sections)){  $_SESSION['status'] = "Section field is empty"; header("Location: program.php"); exit(0); }
    
    if($programname!='' || !empty($programname) && $sections!='' || !empty($sections)){
        
    $depart = $_POST['depart'];
    
    $section_array = explode (",", $sections);
    // echo $sections . ' ';
    // print_r($section_array);
    $program = $programD."-".$programname;

    //fetching depart name from depart ID to save to DB table

    $query = "SELECT id FROM departments WHERE Name='$depart' limit 1";
    $run_query = mysqli_query($con, $query);

    $query_result = mysqli_fetch_row($run_query);
    $depart_id = $query_result['0'];

    //fetching program name from program table

    $program_chk = "SELECT name FROM program WHERE name='$program' ";
    $program_run = mysqli_query($con, $program_chk);

    $fetch_query = mysqli_fetch_row($program_run);
    $program_name = $fetch_query['0'];
    $query_run = '';
    

    foreach($section_array as $index => $sect)
    {
        $a_sections =  ucwords($sect);

        $section_chk = "SELECT section FROM program WHERE section='$a_sections' AND name='$program' ";
        $section_run = mysqli_query($con, $section_chk);
    
        $fetch_query2 = mysqli_fetch_row($section_run);
        $section_name = $fetch_query2['0'];

        // echo $section_name;
        if (empty($section_name)) {
            $section_name = 'null';
        }


        // echo $program_name . ' ' . $section_name .' ' . $program . ' '. $a_sections;
        if($program_name == $program && $section_name == $a_sections)
        {
           
        }else{
            $query = "INSERT INTO program (name,section,department_id) VALUES ('$program','$a_sections','$depart_id')";
            $query_run = mysqli_query($con, $query); 

        }

        
   
    }



 }
}
  } 
  $output .= 'uploaded the data successfully!';
  $_SESSION['status'] = $output;
  header("Location: program.php");
  exit(0); 
 }
 else
 {
  $output = 'Invalid File';
  $_SESSION['status'] = $output;
  header("Location: program.php");
  exit(0);
 }
}

?>