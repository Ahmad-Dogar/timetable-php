<?php
session_start();
// $con = mysqli_connect("localhost","root","","timetable");
include("database.php");


if(isset($_POST['add_course']))
{

    $course_type = "";
    $lab_name= '';
    $courseprogram = $_POST['courseprogram'];
    $semester = $_POST['semester'];
    $name = $_POST['name'];
    $code = $_POST['code'];
    $credithour = $_POST['credithour'];
    $labhour = $_POST['labhour'];
    // echo $labhour;
    if( $labhour != "" ||  $labhour != null){
        $course_type = "lab";
    }else{
        $course_type = "theory";
    }

    $query = "SELECT id FROM program WHERE name='$courseprogram' limit 1";
    $run_query = mysqli_query($con, $query);

    $query_result = mysqli_fetch_row($run_query);
    $program_id = $query_result['0'];

    $query = "INSERT INTO courses (course_semester,course_name,course_code,credithour,course_type,program_id) VALUES ('$semester','$name','$code','$credithour','theory','$program_id')";
    $query_run = mysqli_query($con, $query);

    if($course_type == "lab")
    {
        $lab_name = $name.' (lab)';
        $query = "INSERT INTO courses (course_semester,course_name,course_code,credithour,course_type,program_id) VALUES ('$semester','$lab_name','$code','$labhour','$course_type','$program_id')";
        $query_run = mysqli_query($con, $query);
    }

    if($query_run)
    {
        $_SESSION['status'] = "Multiple Data Inserted Successfully";
        header("Location: course.php");
        exit(0);
    }
    else
    {
        $_SESSION['status'] = "Data Not Inserted";
        header("Location: course.php");
        exit(0);
    }
}


if(isset($_POST["import"]))
{
 $output = '';
 $course_type = "";
 $lab_name= '';
 $fileName      = 'courses.xlsx';
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
    $semester = strval(($worksheet->getCellByColumnAndRow(0, $row)->getValue()));
    $code = strval(($worksheet->getCellByColumnAndRow(1, $row)->getValue()));
    $name = strval(($worksheet->getCellByColumnAndRow(2, $row)->getValue()));
    $credithour = intval(($worksheet->getCellByColumnAndRow(3, $row)->getValue()));
    $labhour = strval(($worksheet->getCellByColumnAndRow(4, $row)->getValue()));

    if(empty($semester) && empty($name) && empty($code) && empty($credithour) && empty($labhour)){    continue;    }
    // if(empty($semester)){  $_SESSION['status'] = "field is empty"; header("Location: course.php"); exit(0); }
    // if(empty($name)){  $_SESSION['status'] = "ield is empty"; header("Location: course.php"); exit(0); }
    // if(empty($code)){  $_SESSION['status'] = "field is empty"; header("Location: course.php"); exit(0); }
    // if(empty($credithour)){  $_SESSION['status'] = "field is empty"; header("Location: course.php"); exit(0); }
    // if(empty($labhour)){  $_SESSION['status'] = "field is empty"; header("Location: course.php"); exit(0); }
    
    $courseprogram = $_POST['courseprogram'];


    if( $labhour != "" ||  $labhour != null){
        $course_type = "lab";
    }else{
        $course_type = "theory";
    }

    $query = "SELECT id FROM program WHERE name='$courseprogram' limit 1";
    $run_query = mysqli_query($con, $query);

    $query_result = mysqli_fetch_row($run_query);
    $program_id = $query_result['0'];

    $query = "INSERT INTO courses (course_semester,course_name,course_code,credithour,course_type,program_id) VALUES ('$semester','$name','$code','$credithour','theory','$program_id')";
    $query_run = mysqli_query($con, $query);

    if($course_type == "lab")
    {
        $lab_name = $name.' (lab)';
        $query = "INSERT INTO courses (course_semester,course_name,course_code,credithour,course_type,program_id) VALUES ('$semester','$lab_name','$code','$labhour','$course_type','$program_id')";
        $query_run = mysqli_query($con, $query);
    }
    }



}
  } 
  $output .= 'uploaded the data successfully!';
  $_SESSION['status'] = $output;
  header("Location: course.php");   
  exit(0); 
 }
 else
 {
  $output = 'Invalid File';
  $_SESSION['status'] = $output;
  header("Location: course.php");
  exit(0);
 }

?>