<?php
include("database.php");

// $con = mysqli_connect("localhost","root","","timetable");
// $con2 = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['update_data']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $section = mysqli_real_escape_string($con, $_POST['section']);

    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }
    
    $query = "UPDATE program SET section='$section'  WHERE program.id='$id'";
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

    $query = "SELECT program.*, departments.Name FROM program INNER JOIN departments ON program.department_id = departments.id  WHERE program.id='$id'";
    $query_run = mysqli_query($con, $query);

    // $id_query = "SELECT department_id FROM program  WHERE id='$id' limit 1";
    // $id_run = mysqli_query($con, $id_query);

    // $query_result = mysqli_fetch_row($id_run);
    // $depart_id = $query_result['0'];
    // $query2 = "SELECT * FROM departments WHERE id='$depart_id' limit 1";
    // $run_query2 = mysqli_query($con, $query2);

    // $query_result = mysqli_fetch_row($run_query2);
    // $data2 = $query_result['0'];

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

    $query = "SELECT * FROM program WHERE id='$id2'";
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

    $query = "DELETE FROM program WHERE id='$id2'";
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