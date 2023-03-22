<?php
include("database.php");

// $con = mysqli_connect("localhost","root","","timetable");

if(isset($_POST['update_data']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $from = mysqli_real_escape_string($con, $_POST['from']);
    $to = mysqli_real_escape_string($con, $_POST['to']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $day = mysqli_real_escape_string($con, $_POST['day']);

    if($name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE rooms SET room_name='$name' , room_from='$from' , room_to='$to' ,type='$type', day='$day'  WHERE id='$id'";
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

    $query = "SELECT * FROM rooms WHERE id='$id'";
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

    $query = "SELECT * FROM rooms WHERE id='$id2'";
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

    $query = "DELETE FROM rooms WHERE id='$id2'";
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