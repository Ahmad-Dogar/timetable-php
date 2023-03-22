<!DOCTYPE html>

<?php
session_start();

include("database.php"); 

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
                                <h1>Incomplete Timetable</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header hide">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Incomplete Timetable</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
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


if (!empty($_SESSION['sessionfrom']) && !empty($_SESSION['sessionto']) && !empty($_SESSION['program']) && !empty($_SESSION['semester']) && !empty($_SESSION['section'])) {

    $total = $_SESSION['total'];
    $session_from = $_SESSION['sessionfrom'];
	$session_to = $_SESSION['sessionto'];
	$program = $_SESSION['program'];
	$section = $_SESSION['section'];
	$semester= $_SESSION['semester'];


    $query = "SELECT * FROM backup_table WHERE session_from='$session_from' AND session_to='$session_to' AND program='$program' AND section='$section' AND semester='$semester'";
    $result = mysqli_query($con, $query);


}


// $con = mysqli_connect('localhost', 'root', '', 'timetable');
//     $query = "SELECT * FROM backup_table";
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
                                <h5>( Missing Lectures : <?php echo $total; ?> )</h5>
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
                                echo "<td style='text-align:center'>(".$fkey["room_from"].'-'.$fkey["room_to"].")<br>".$fkey["course_assigned"]."<br><b>".$fkey["professor_name"]."</b><br>".$fkey['room_name']."</td></tr>";
                                }else{echo "<td> </td></tr>";}                       	 	             	 	 
                            }, $mondayarr, $tuesdayarr, $wednesdayarr, $thursdayarr, $fridayarr); 
}
  ?>
                    </tbody>

              </table>
              <!-- <a class='btn btn-primary hide' href="test.php"> -->
<!-- Download -->
<!-- </a> -->
</table>

<form method="POST" action="timetable_saving.php">
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-lg-6" style="text-align: right;">
                        <button class='btn btn-warning ' name='del' style='background-color: #343957;width:100%'>Delete Table & Continue</button>
                        </div>
                        <div class="col-lg-6">                            
                        <button class='btn btn-primary ' name='save' style='width:100%'>Save this table anyway</button>
                        </div>
                    </div>
                </form>            
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