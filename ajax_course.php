<?php
include("database.php");

// $con = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['update_data']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $courseprogram = mysqli_real_escape_string($con, $_POST['courseprogram']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $semester = mysqli_real_escape_string($con, $_POST['semester']);
    $credithour = mysqli_real_escape_string($con, $_POST['credithour']);
    $coursetype = mysqli_real_escape_string($con, $_POST['type']);

    $query = "SELECT id FROM program WHERE name='$courseprogram' limit 1";
    $run_query = mysqli_query($con, $query);

    $query_result = mysqli_fetch_row($run_query);
    $program_id = $query_result['0'];


    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE courses SET course_semester='$semester',course_name='$name',course_code='$code',credithour='$credithour',course_type='$coursetype',program_id='$program_id'  WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => ' Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => ' Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT courses.*, program.name FROM courses INNER JOIN program ON courses.program_id = program.id  WHERE courses.id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $data = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'data Fetch Successfully by id',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'data Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}
if(isset($_GET['id2']))
{
    $id2 = mysqli_real_escape_string($con, $_GET['id2']);

    $query = "SELECT * FROM courses WHERE id='$id2'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $data = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'data Fetch Successfully by id',
            'data' => $data
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'data Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_data']))
{
    $id2 = mysqli_real_escape_string($con, $_POST['id2']);

    $query = "DELETE FROM courses WHERE id='$id2'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'data Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'data Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>