<!DOCTYPE html>
<html lang="en">

<?php
include("database.php");

// $con = mysqli_connect('localhost', 'root', '', 'timetable');
    $query = "SELECT * FROM courses ORDER BY course_semester";
    $result = mysqli_query($con, $query);

    $sql1 = "SELECT DISTINCT name FROM program";
    $result1 = mysqli_query ($con, $sql1);
     ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inteligence TimeTable Management System - Course</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <?php include("sidebar.php"); ?>


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Courses Data</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Course</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
            </div>
        </div>
    </div>

    <div class="content-wrap">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-11 ">
                    <div class="card mb-5" style="padding-left:0px;">
                        <!--                                 <div class="card-title">
                                    <h4>Input Style</h4>
                                    
                                </div> -->
                        <div class="card-body">

                        <ul class="nav nav-tabs" role="tablist" style="margin-top:-59px">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#Add_Data"
                                        role="tab"><span class="hidden-sm-up"><i class="ti-plus"></i></span> <span
                                            class="hidden-xs-down">Add Data</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Upload_File"
                                        role="tab"><span class="hidden-sm-up"><i class="ti-upload"></i></span> <span
                                            class="hidden-xs-down">Upload Excel File</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content ">

                                <div class="tab-pane active" id="Add_Data" role="tabpanel">
                                    <div class="p-20">

                                    <div class="basic-form">
                                <form method="POST" action="course_saving.php">
                                    <div class="row justify-content-center" style="margin-bottom: -25px">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" Name='courseprogram'
                                                    style="height: 42px" required>
                                                    <option value="">--- Course Program ---</option>

                                                    <?php while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                                    <option value="<?php echo $row['name'];?>">
                                                        <?php echo $row['name'];?></option>
                                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" Name='semester'
                                                    style="height: 42px" required>
                                                    <option value="">--- Course Semester ---</option>
                                                    <option value="1st">1st</option>
                                                    <option value="2nd">2nd</option>
                                                    <option value="3rd">3rd</option>
                                                    <option value="4th">4th</option>
                                                    <option value="5th">5th</option>
                                                    <option value="6th">6th</option>
                                                    <option value="7th">7th</option>
                                                    <option value="8th">8th</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-md" name="code"
                                                    placeholder="Course Code" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-md" name="name"
                                                    placeholder="Course Name" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <input type="number" class="form-control form-control-md"
                                                    name="credithour" placeholder="Credit Hour" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" id='labselection'
                                                    name='labselection' style="height: 42px" required>
                                                    <option value="">--- Course LAB ---</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2" id="labhour" style="display:none">
                                            <div class="form-group">
                                                <input type="number" class="form-control form-control-md "
                                                    name="labhour" placeholder="Lab Hours">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="submit" class="btn" name="add_course"
                                                style="background-color: #343957;color: white"><i class="ti-plus"></i>
                                                Add Course</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                                    </div>
                                </div>
                                <div class="tab-pane  p-20" id="Upload_File" role="tabpanel">
                                    <form method="post" action="course_saving.php" enctype="multipart/form-data">
                                        <div class="row justify-content-center" style="margin-bottom: -25px">

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" Name='courseprogram'
                                                    style="height: 42px" required>
                                                    <option value="">--- Course Program ---</option>

                                                    <?php while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                                    <option value="<?php echo $row['name'];?>">
                                                        <?php echo $row['name'];?></option>
                                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                                </select>
                                            </div>
                                        </div>

                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    <input type="file" class="form-control form-control-md "
                                                        name="excel"
                                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-lg-2">
                                                <button type="submit" name="import" class="btn"
                                                    style="background-color: #343957;color: white"> <i
                                                        class="ti-upload"></i> Upload File </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <section id="main-content">
                <div class="row">
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <table id="myTable" id="bootstrap-data-table-export"
                                        class="table table-bordered table-striped">
                                        <?php
if (mysqli_num_rows($result) > 0) {
?>

                                        <thead class="thead">
                                            <tr>
                                                <th>Sr</th>
                                                <th>COURSE CODE</th>
                                                <th>COURSE NAME</th>
                                                <th>CREDIT HOURS</th>
                                                <th>COURSE TYPE</th>
                                                <th>COURSE SEMESTER</th>
                                                <th style="text-align: center;">UPDATE</th>
                                                <th style="text-align: center;">DELETE</th>
                                            </tr>
                                        </thead>
                                        <?php
$i=0;
while($row = mysqli_fetch_array($result)) {
  $i++;
?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row["course_code"]; ?></td>
                                            <td><?php echo $row["course_name"]; ?></td>
                                            <td><?php echo $row["credithour"]; ?></td>
                                            <td><?php echo ucwords($row["course_type"]); ?></td>
                                            <td><?php echo $row["course_semester"]; ?></td>
                                            <td style="text-align: center;"><button type="button"
                                                    value="<?=$row['id']; ?>" class=" ajaxEdit btn btn-primary"
                                                    style="padding: 5px 10px;"><i class="ti-pencil-alt"
                                                        style="color: white"></button></td>
                                            <td style="text-align: center;"><button type="button"
                                                    value="<?=$row['id']; ?>" class="deletepopup btn btn-danger"
                                                    style="padding: 5px 10px;"><i class="ti-trash"
                                                        style="color: white"></button></td>
                                        </tr>
                                        <?php
}
?>
                                    </table>
                                    <?php
}
else{
    echo "<center>There's nothing in here</center>";
}
?>

                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

            </section>

        </div>
    </div>
    </div>

    <!-- Edit  Modal -->
    <div class="modal fade bd-example-modal-lg" id="AjaxEditForm" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Row Data</h5>
                </div>

                <div class="modal-body mt-3">
                    <div class="container-fluid">
                        <form id="ajaxUpdate">
                            <div class="row">
                                <!--     START   -->
                                <input type="hidden" name="id" id="id">

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select class="form-control form-control-md" Name='courseprogram' id='courseprogram'
                                            style="height: 42px" required>
                                            <option value="">--- Course Program ---</option>

                                            <?php while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?>
                                            </option>
                                            <?php endwhile; mysqli_data_seek($result1,0); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select class="form-control form-control-md" Name='semester' id='semester'
                                            style="height: 42px" required>
                                            <option value="">--- Course Semester ---</option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
                                            <option value="5th">5th</option>
                                            <option value="6th">6th</option>
                                            <option value="7th">7th</option>
                                            <option value="8th">8th</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select class="form-control form-control-md" name='type' id="type"
                                            style="height: 42px" required>
                                            <option value="">--- Course Type ---</option>
                                            <option value="theory">Theory</option>
                                            <option value="lab">Lab</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-md" name="code" id="code"
                                            placeholder="Course Code" required>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-md" name="name" id="name"
                                            placeholder="Course Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="number" class="form-control form-control-md" name="credithour"
                                            id="credithour" placeholder="Credit Hour" required>
                                    </div>
                                </div>

                                <!--     END   -->
                            </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update changes</button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <!-- delete Student Modal -->
    <div class="modal fade bd-example-modal-sm" id="confirmationmessag" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="text-align:center" role="document">

            <div class="modal-content">
                <input type="hidden" name="id2" id="id2">
                <div class=" py-4 w-100 text-center">
                    <img src="alert.PNG" width="50px" height="50px">
                </div>

                <h3 class="pb-1 modal-title w-100 text-center" id="exampleModalLongTitle">Are you sure to delete ?</h3>

                <div class="container-fluid">
                    You will not be able to recover the data after deleted !!
                </div>

                <div class="py-4 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <span class="mx-2"></span>
                    <button type="button" class=" ajaxDelete btn btn-danger">Confirm</button>
                </div>

            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


        <script>

$(document).on('click', '.deletepopup', function () {

    var id2 = $(this).val();
    
    $.ajax({
        type: "GET",
        url: "ajax_course.php?id2=" + id2,
        success: function (response) {

            var res = jQuery.parseJSON(response);
            if(res.status == 404) {

                alert(res.message);
            }else if(res.status == 200){

                $('#id2').val(res.data.id);
                $('#confirmationmessag').modal('show');
            }

        }
    });

});
$(document).on('click', '.ajaxEdit', function () {

var id = $(this).val();

$.ajax({
type: "GET",
url: "ajax_course.php?id=" + id,
success: function (response) {

var res = jQuery.parseJSON(response);
if(res.status == 404) {

    alert(res.message);
}else if(res.status == 200){

    $('#id').val(res.data.id);
    $('#name').val(res.data.course_name);
    $('#code').val(res.data.course_code);
    $('#semester').val(res.data.course_semester);
    $('#credithour').val(res.data.credithour);
    $('#type').val(res.data.course_type);
    $('#courseprogram').val(res.data.name);

    $('#AjaxEditForm').modal('show');
}

}
});

});

$(document).on('submit', '#ajaxUpdate', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append("update_data", true);

    $.ajax({
        type: "POST",
        url: "ajax_course.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);

            }else if(res.status == 200){

                $('#errorMessageUpdate').addClass('d-none');

                // alertify.set('notifier','position', 'top-right');
                // alertify.success(res.message);
                
                $('#AjaxEditForm').modal('hide');
                $('#ajaxUpdate')[0].reset();

                $('#myTable').load(location.href + " #myTable");

            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});

$(document).on('click', '.ajaxDelete', function (e) {
    e.preventDefault();

    // if(confirm('Are you sure you want to delete this data?'))
    // {
        var id2 = $('#id2').val();
        $.ajax({
            type: "POST",
            url: "ajax_course.php",
            data: {
                'delete_data': true,
                'id2': id2
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if(res.status == 500) {

                    alert(res.message);
                    console.message("errorroror");
                }else{
                    // alertify.set('notifier','position', 'top-right');
                    // alertify.success(res.message);
                $('#confirmationmessag').modal('hide');


                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    // }
});

</script>




<!-- jquery vendor -->
<script src="assets/js/lib/jquery.min.js"></script>
<script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
<!-- nano scroller -->
<script src="assets/js/lib/menubar/sidebar.js"></script>
<script src="assets/js/lib/preloader/pace.min.js"></script>
<!-- sidebar -->

<script type="text/javascript">

$('#labselection').on('change',function(){
var changeVal = $('#labselection').val();

if(changeVal == 'yes'){
$('#labhour').show();
}else{
$('#labhour').hide();

}
});
</script>

        <!-- bootstrap -->


        <script src="assets/js/lib/bootstrap.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <!-- scripit init-->
        <!-- <script src="assets/js/lib/data-table/datatables.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/buttons.flash.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/jszip.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/pdfmake.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/vfs_fonts.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/buttons.html5.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/buttons.print.min.js"></script> -->
        <!-- <script src="assets/js/lib/data-table/datatables-init.js"></script> -->
</body>

</html>