<?php
include("database.php"); 

$query = "INSERT IGNORE INTO program (name, section) VALUES ('cs','b')";
$query_run = mysqli_query($con, $query);

?>