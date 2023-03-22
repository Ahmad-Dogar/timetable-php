<!DOCTYPE html>

<?php
session_start();

include("database.php"); 
mysqli_query($con, 'DROP TABLE IF EXISTS `master`');


if($_SESSION['mode'])
{
$mode = $_SESSION['mode'];
}else{
    $mode = '';
}

// header("Content-Type: application/vnd.msword");
// header("content-disposition: attachment;filename=sampleword.doc");
?>


<head>

    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<style type="text/css">

.table td {
text-align: center;
}
.table th {
text-align: center;
}
/* .clr{
    background-color:#FFF4E5 !important;;
}

@media print {
    body {
        -webkit-print-color-adjust: exact; 
    }

    .clr {
        background-color: #FFF4E5 !important;
}
} */
  </style>
</head>

<body>
<?php include("sidebar.php"); ?>


    <div class="content-wrap hide rmv">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title hide">
                                <h1>Search Timetable</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header hide">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Search Timetable</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap hide rmv">
    	<div class="container-fluid">
    		         <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card mb-5">

    		        <div class="card-body">
            <div class="basic-form">
                <form method="POST" action="timetable.php">
                	<div class="row " style="margin-bottom: -15px;">

                    <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='sessionfrom' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">Session From ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT session_from FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['session_from'];?>"><?php echo $row['session_from'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	</div>

                    <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='sessionto' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">-Session  To ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT session_to FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['session_to'];?>"><?php echo $row['session_to'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	</div>                    
                    
                    <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='program' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">--- Program ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT program FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['program'];?>"><?php echo $row['program'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	</div>



                    <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='semester' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">--- Semester ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT semester FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['semester'];?>"><?php echo $row['semester'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	</div>  

                        <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='section' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">--- Section ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT section FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['section'];?>"><?php echo $row['section'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	</div>

                    <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='mode' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">--- M/E ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT mode FROM timetables"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['mode'];?>"><?php echo $row['mode'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	</div>                    

                    </div>
                    <div class="row mt-3">
                    <div class="col-lg-10 offset-1">
    <button type="submit" name="search_timetable" class="btn btn-md btn-block" style="background-color: #343957;color: white;margin-bottom:-60px"><i class=""></i>Submit</button>
</div>
                    </div>	
                </form>
            </div>
        </div>
    </div>
</div>
</div>


        </div>
    	</div>
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
$result = '';


// $con = mysqli_connect('localhost', 'root', '', 'timetable');

if(isset($_POST['search_timetable']))
{
    $session_from = $_POST['sessionfrom'];
    $session_to = $_POST['sessionto'];
    $program = $_POST['program'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $mode = $_POST['mode'];


    $query = "SELECT * FROM timetables WHERE session_from='$session_from' AND session_to='$session_to' AND program='$program' AND section='$section' AND semester='$semester' AND mode = '$mode' ";
    $result = mysqli_query($con, $query);
    
}
if (!empty($_SESSION['sessionfrom']) && !empty($_SESSION['sessionto']) && !empty($_SESSION['program']) && !empty($_SESSION['semester']) && !empty($_SESSION['section'])) {

    $session_from = $_SESSION['sessionfrom'];
	$session_to = $_SESSION['sessionto'];
	$program = $_SESSION['program'];
	$section = $_SESSION['section'];
	$semester= $_SESSION['semester'];


    $query = "SELECT * FROM timetables WHERE session_from='$session_from' AND session_to='$session_to' AND program='$program' AND section='$section' AND semester='$semester' AND mode = '$mode' ";
    $result = mysqli_query($con, $query);

    $_SESSION['sessionfrom'] = '';
    $_SESSION['sessionto'] = '';
    $_SESSION['program'] = '';
    $_SESSION['semester'] = '';
    $_SESSION['section'] = '';
    $_SESSION['mode'] = '';

}


// $con = mysqli_connect('localhost', 'root', '', 'timetable');
//     $query = "SELECT * FROM timetables";
//     $result = mysqli_query($con, $query);
    ?>	
                            <?php
if ($result && mysqli_num_rows($result) > 0) {
?>


<div class="content-wrap     rmv">
    	<div class="container-fluid mb-4">
    		         <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card mb-5">
<div class="row">
    <div class="col-2">
        <img src="logo.PNG" width="90px">
    </div>
    <div class="col-10">
    <center><h5>MNS-University of Engineering and Technology</h5>
                                <h5 class="bg-warning bg-gradient"><?php echo $program. " (" .$session_from."-".$session_to; ?>) - <?php echo $semester; ?> Semester</h5>
                                <h5>Time Table ( Section <?php echo $section; ?> ) ( <?php echo $mode; ?> )</h5>
                            </center>
    </div>
</div>
    		        <div >


              <table  class="display table table-bordered table">
              <thead class="thead-light">
  <tr>
  <!-- <th><b>Time</b></th> -->
                <th><b>Monday</b></th>
                <th><b>Tuesday</b></th>
                <th><b>Wednesday</b></th>
                <th><b>Thursday</b></th>
                <th style="text-align:center"><b>Friday</b></th>
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

                                    if($mkey["room_to"] == '9:00' || $mkey["room_to"] == '10:00' || $mkey["room_to"] == '11:00'){$mkey["room_to"] = $mkey["room_to"]."AM";}else{$mkey["room_to"] = $mkey["room_to"]."PM";}
                                    if($mkey["room_from"] == '9:00' || $mkey["room_from"] == '10:00' || $mkey["room_from"] == '11:00'){$mkey["room_from"] = $mkey["room_from"]."AM";}else{$mkey["room_from"] = $mkey["room_from"]."PM";}
                                       
                                    if($mkey["room_name"] == 'break'){echo "<tr><td style='background-color: #FFF4E5 !important;'><b>"."BREAK"."</b><br>(".$mkey["room_from"].'-'.$mkey["room_to"].")</td>";}else
                                {echo "<tr><td>(".$mkey["room_from"].'-'.$mkey["room_to"].")<br>".$mkey["course_assigned"]."<br><b>".$mkey["professor_name"]."</b><br>".$mkey['room_name']."</td>";}
                                }else{echo "<td> </td>";}

                                if (!empty($tkey)) {

                                    if($tkey["room_to"] == '9:00' || $tkey["room_to"] == '10:00' || $tkey["room_to"] == '11:00'){$tkey["room_to"] = $tkey["room_to"]."AM";}else{$tkey["room_to"] = $tkey["room_to"]."PM";}
                                    if($tkey["room_from"] == '9:00' || $tkey["room_from"] == '10:00' || $tkey["room_from"] == '11:00'){$tkey["room_from"] = $tkey["room_from"]."AM";}else{$tkey["room_from"] = $tkey["room_from"]."PM";}
                                       
                                    if($tkey["room_name"] == 'break'){echo "<td style='background-color:#FFF4E5 !important;'><b>"."BREAK"."</b><br>(".$tkey["room_from"].'-'.$tkey["room_to"].")</td>";}else
                                {echo "<td>(".$tkey["room_from"].'-'.$tkey["room_to"].")<br>".$tkey["course_assigned"]."<br><b>".$tkey["professor_name"]."</b><br>".$tkey['room_name']."</td>";}
                                }else{echo "<td> </td>";} 

                                if (!empty($wkey)) {

                                    if($wkey["room_to"] == '9:00' || $wkey["room_to"] == '10:00' || $wkey["room_to"] == '11:00'){$wkey["room_to"] = $wkey["room_to"]."AM";}else{$wkey["room_to"] = $wkey["room_to"]."PM";}
                                    if($wkey["room_from"] == '9:00' || $wkey["room_from"] == '10:00' || $wkey["room_from"] == '11:00'){$wkey["room_from"] = $wkey["room_from"]."AM";}else{$wkey["room_from"] = $wkey["room_from"]."PM";}
                                       
                                    if($wkey["room_name"] == 'break'){echo "<td style='background-color:#FFF4E5 !important;'><b>"."BREAK"."</b><br>(".$wkey["room_from"].'-'.$wkey["room_to"].")</td>";}else
                                {echo "<td>(".$wkey["room_from"].'-'.$wkey["room_to"].")<br>".$wkey["course_assigned"]."<br><b>".$wkey["professor_name"]."</b><br>".$wkey['room_name']."</td>";}
                                }else{echo "<td> </td>";}

                                if (!empty($thkey)) {		

                                    if($thkey["room_to"] == '9:00' || $thkey["room_to"] == '10:00' || $thkey["room_to"] == '11:00'){$thkey["room_to"] = $thkey["room_to"]."AM";}else{$thkey["room_to"] = $thkey["room_to"]."PM";}
                                    if($thkey["room_from"] == '9:00' || $thkey["room_from"] == '10:00' || $thkey["room_from"] == '11:00'){$thkey["room_from"] = $thkey["room_from"]."AM";}else{$thkey["room_from"] = $thkey["room_from"]."PM";}
                                       
                                    if($thkey["room_name"] == 'break'){echo "<td style='background-color:#FFF4E5 !important;'><b>"."BREAK"."</b><br>(".$thkey["room_from"].'-'.$thkey["room_to"].")</td>";}else
                                {echo "<td>(".$thkey["room_from"].'-'.$thkey["room_to"].")<br>".$thkey["course_assigned"]."<br><b>".$thkey["professor_name"]."</b><br>".$thkey['room_name']."</td>";}
                                }else{echo "<td> </td>";} 

                                if (!empty($fkey)) {

                                    if($fkey["room_to"] == '9:00' || $fkey["room_to"] == '10:00' || $fkey["room_to"] == '11:00'){$fkey["room_to"] = $fkey["room_to"]."AM";}else{$fkey["room_to"] = $fkey["room_to"]."PM";}
                                    if($fkey["room_from"] == '9:00' || $fkey["room_from"] == '10:00' || $fkey["room_from"] == '11:00'){$fkey["room_from"] = $fkey["room_from"]."AM";}else{$fkey["room_from"] = $fkey["room_from"]."PM";}
                                       
                                    if($fkey["room_name"] == 'break'){echo "<td style='background-color:#FFF4E5 !important;'><b>"."BREAK"."</b><br>(".$fkey["room_from"].'-'.$fkey["room_to"].")</td></tr>";}else
                                {echo "<td>(".$fkey["room_from"].'-'.$fkey["room_to"].")<br>".$fkey["course_assigned"]."<br><b>".$fkey["professor_name"]."</b><br>".$fkey['room_name']."</td></tr>";}
                                }else{echo "<td> </td></tr>";}                       	 	             	 	 
                            }, $mondayarr, $tuesdayarr, $wednesdayarr, $thursdayarr, $fridayarr); 
}
  ?>
                    </tbody>

              </table>

</table>


                    </div>
                    <!-- <a class='btn btn-primary hide' href="test.php"> Download Time Table</a>            -->
                    <button class='btn btn-success mt-5   hide' style='background-color: #343957'onclick="display()">Print Time Table</button>
                </div>
                        </div>
</div>
        </div>
</div>

      <script>
         function display() {
  var hiding = document.getElementsByClassName('hide');
  var sidebr = document.getElementById('sideb');
  $(".rmv").removeClass('content-wrap');
  sidebr.style.display = 'none';

  for (var i = 0; i < hiding.length; ++i) {
    var item = hiding[i];  
    item.style.display = 'none';
}
            window.print();
            location.reload();
         }
      </script>
        <!-- Optional JavaScript -->

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


        <!-- jquery vendor -->
        <script src="assets/js/lib/jquery.min.js"></script>
        <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="assets/js/lib/menubar/sidebar.js"></script>
        <script src="assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->

        <!-- bootstrap -->


        <script src="assets/js/lib/bootstrap.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- scripit init-->
        <script src="assets/js/lib/data-table/datatables.min.js"></script>
        <!-- <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.flash.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script> -->
        <script src="assets/js/lib/data-table/datatables-init.js"></script>
</body>

</html>