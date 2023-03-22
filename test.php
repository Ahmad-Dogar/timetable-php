<!DOCTYPE html>
<html lang="en">
<?php include("database.php"); 
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("content-disposition: attachment;filename=timetable.doc");
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

<style type="text/css">

.table td {
text-align: center;
}
.table th {
text-align: center;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
table thead tr {
    background-color: #343957;
    color: #ffffff;
    text-align: left;
}
table th,
table td {
    padding: 12px 15px;
    border: solid 1px #dddddd;
}
.table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
  </style>
</head>

<body>

        <?php
 $username = "";
$email    = "";
$id = "";
$errors = array(); 
$mondayarr = array();
$tuesdayarr = array();
$wednesdayarr = array();
$thursdayarr = array();
$fridayarr = array();

// include("database.php");
// $con = mysqli_connect('localhost', 'root', '', 'timetable');
    $query = "SELECT * FROM timetables";
    $result = mysqli_query($con, $query);
    ?>	

<?php
if (mysqli_num_rows($result) > 0) {
?>

              <table id="bootstrap-data-table-export" class="display table table-bordered table">
              <thead class="thead-light">
  <tr>
  <!-- <th><b>Time</b></th> -->
                <th><b>Monday</b></th>
                <th><b>Tuesday</b></th>
                <th><b>Wednesday</b></th>
                <th><b>Thursday</b></th>
                <th><b>Friday</b></th>
              </tr></thead>


                        <?php
                        $i=0;
                        $week_days = array('monday','tuesday','wednesday','thurshday','friday');
                        $classes = array();
                        $total_classes = array();
                        $time = array('8:00','9:00','10:00','11:00','12:00','13:00','14:00');
                        while($row = mysqli_fetch_assoc($result)) {
                            $classes[$row['day']] = $row;
                            // $time[] = $row['room_from'];
                            // echo "day".$i++."<br>";
                            $total_classes[] = $classes;
                            $classes = array();
                			 }

                        foreach ($total_classes as $key) {
                        	// echo $key['tuesday'];	
                        	if (!empty($key['monday'])) {
                        		foreach ($key as $finalkey) {
                        			$mondayarr[] = $finalkey;
                        		}
                        	}
                        	if (!empty($key['tuesday'])) {
                        		foreach ($key as $finalkey) {
                        			$tuesdayarr[] = $finalkey;
                        		}
                        	}	
                        	if (!empty($key['wednesday'])) {
                        		foreach ($key as $finalkey) {
                        			$wednesdayarr[] = $finalkey;
                        		}
                        	}	
                        	if (!empty($key['thursday'])) {
                        		foreach ($key as $finalkey) {
                        			$thursdayarr[] = $finalkey;
                        		}
                        	}	
                        	if (!empty($key['friday'])) {
                        		foreach ($key as $finalkey) {
                        			$fridayarr[] = $finalkey;
                        		}
                            }                        	                        	                        		
                   }?>
                 	<tbody>
                    	<?php
                        	 array_map(function ($mkey, $tkey, $wkey, $thkey, $fkey) { 

                                // echo  $mkey['room_from'].' = '. $timekey.'<br>';
                                
                                if (!empty($mkey)) {
                                echo "<tr><td>(".$mkey["room_from"].'-'.$mkey["room_to"].")<br>".$mkey["course_assigned"]."<br><b>".$mkey["professor_name"]."</b><br>".$mkey['room_name']."</td>";
                                }else{echo "<td> </td>";}
                                if (!empty($tkey)) {
                                echo "<td>(".$tkey["room_from"].'-'.$tkey["room_to"].")<br>".$tkey["course_assigned"]."<br><b>".$tkey["professor_name"]."</b><br>".$tkey['room_name']."</td>"; 
                                }else{echo "<td> </td>";} 
                                if (!empty($wkey)) {
                                echo "<td>(".$wkey["room_from"].'-'.$wkey["room_to"].")<br>".$wkey["course_assigned"]."<br><b>".$wkey["professor_name"]."</b><br>".$wkey['room_name']."</td>";    
                                 }else{echo "<td> </td>";}
                                if (!empty($thkey)) {		
                                echo "<td>(".$thkey["room_from"].'-'.$thkey["room_to"].")<br>".$thkey["course_assigned"]."<br><b>".$thkey["professor_name"]."</b><br>".$thkey['room_name']."</td>";
                                }else{echo "<td> </td>";} 
                                if (!empty($fkey)) {
                                echo "<td>(".$fkey["room_from"].'-'.$fkey["room_to"].")<br>".$fkey["course_assigned"]."<br><b>".$fkey["professor_name"]."</b><br>".$fkey['room_name']."</td></tr>";
                                }else{echo "<td> </td></tr>";}                       	 	             	 	 
                            }, $mondayarr, $tuesdayarr, $wednesdayarr, $thursdayarr, $fridayarr); 
}
  ?>
                    </tbody>
</table>

                    </div>
                            </div>
                        </div>
</div>
        </div>
</div>





    <!-- <script src="assets/js/lib/data-table/datatables-init.js"></script> -->
</body>

</html>