<!DOCTYPE html>
<html lang="en">
<?php include("database.php"); ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inteligence TimeTable Management System - Professor</title>
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
<!-- <style> 
.col-lg-1-5 { width: 12.5%; } // = 8,3333 + 4,16667
.col-lg-2-5 { width: 20.83333%; } // = 16,6666 + 4,16667
.col-lg-3-5 { width: 29.16667%; } // = 25 + 4,16667
.col-lg-4-5 { width: 37.5%; } // = 33,3333 + 4,16667
.col-lg-5-5 { width: 45.83333%; } // = 41,6667 + 4,16667
.col-lg-6-5 { width: 54.16667%; } // = 50 + 4,16667
.col-lg-7-5 { width: 62.5%; } // = 58,3333 + 4,16667
.col-lg-8-5 { width: 70.83333%; } // = 66,6666 + 4,16667
.col-lg-9-5 { width: 79.16667%; } // = 75 + 4,16667
.col-lg-10-5 { width: 87.5%; } // = 83,3333 + 4,16667
.col-lg-11-5 { width: 95.8333%; } // = 91,6666 + 4,16667
</style> -->
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
                                <h1>Timetable Data</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">timetable</li>
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
    		         <div class="row">
                        <div class="col-lg-10 offset-1 ">
                            <div class="card mb-5">

    		        <div class="card-body">
            <div class="basic-form">
                <form method="POST" action="timetable_saving.php">
                	<div class="row " style="margin-bottom: -15px;">

                    <div class="col-lg-3">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='program' style="height: 42px" class="ajaxUpdate" required>
                                    <option value="">--- Program ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT name FROM program"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	    </div>                        

                    
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="number" name="sessionfrom" class="form-control form-control-md "  placeholder="Session From"required>
                        </div>
                	</div>
                    
                        
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="number" name="sessionto" class="form-control form-control-md "  placeholder="Session To"required>
                        </div>
                	</div>



                		<div class="col-lg-3">
                			<div class="form-group">
                			    <select class="form-control form-control-md" Name='semester'style="height: 42px" required>
                                    <option value="">--- Semester ---</option>
                                    <option value="">--- Subject Semester ---</option>
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

                        <div class="col-lg-2">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='section' style="height: 42px;font-size:14.5px"  required>
                                    <option value="">- Section -</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT section FROM program"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['section'];?>"><?php echo $row['section'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	    </div>                        

                        <div class="col-lg-4">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='professor[]' id='professor_dd' style="height: 42px" required>
                                    <option value="">--- Professor ---</option>
                                    <?php $result1 = mysqli_query ($con, "SELECT DISTINCT name FROM professors"); 
                                        while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select> 
                		    </div>
                	    </div>

                		<div class="col-lg-4">
                			<div class="form-group">
                                <select class="form-control form-control-md" Name='course[]' id='course' style="height: 42px" required>
                                    <option value="">--- Course Assigned ---</option>
                                    <?php $result3 = mysqli_query ($con, "SELECT DISTINCT course_name FROM courses"); 
                                        while ($row = mysqli_fetch_array( $result3,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['course_name'];?>"><?php echo $row['course_name'];?></option>
                                    <?php endwhile; mysqli_data_seek($result3,0); ?>
                                </select> 
                		    </div>
                	    </div>                        

                    
                        <div class="col-lg-2">
                        <a href="javascript:void(0)" class="add-more-teachers float-end btn btn-primary"style="background-color: #343957;color: white"><i class="ti-plus"></i> Add</a>
                		</div>
                		                		                		
                	</div>

                    <div class="row-10">
                    <span style="margin: 0px;padding: 0px" class="paste-new-teachers"></span>

                    </div>
                    <div class="row mt-3">
                    <div class="col-lg-10 offset-1">
    <button type="submit" name="add_timetable" class="btn btn-md btn-block" style="background-color: #343957;color: white;margin-bottom:-60px"><i class=""></i> Create Timetable</button>
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
    </div>



    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>

        $(document).on('click', '.ajaxUpdate', function () {

var program = $(this).val();

$.ajax({
    type: "GET",
    url: "update_dropdown.php?id=" + program,
    success: function (response) {

        var res = jQuery.parseJSON(response);
        if(res.status == 404) {

            alert(res.message);
        }else if(res.status == 200){

            $('#professor_dd').val(res.data.name);

        }

    }
});

});


    </script>
    
    <script>
        $(document).ready(function () {

$(document).on('click', '.remove-btn', function () {
   $(this).closest('.teacher-form').remove();
});


$(document).on('click', '.add-more-teachers', function () {
   $('.paste-new-teachers').append('<span class="teacher-form">\
     <div class="row mb-3">\
                   <div class="col-lg-5 mt-2">\
                     <div class="input-group" >\
                     <select class="form-control form-control-md" name="professor[]" style="height: 42px" required>\
                                    <option value="">--- Professor ---</option>\
                                    <?php while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>\
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>
                                </select>\
                     </div>\
                   </div>\
                   <div class="col-lg-5 mt-2">\
                     <div class="input-group" >\
                     <select class="form-control form-control-md" name="course[]" style="height: 42px" required>\
                                    <option value="">--- Course Assigned ---</option>\
                                    <?php while ($row = mysqli_fetch_array( $result3,MYSQLI_ASSOC)):; ?>
                                            <option value="<?php echo $row['course_name'];?>"><?php echo $row['course_name'];?></option>\
                                    <?php endwhile; mysqli_data_seek($result3,0); ?>
                                </select>\
                     </div>\
                   </div>\
                    <div class="col-lg-2 my-auto">\
                      <a href="javascript:void(0)" class="remove-btn btn btn-danger"style="color: white;padding: 06px 18px;font-size: 20px;">-</a>\
                   </div>\
                 </div>\
                 </span>');
});

});


// $('#timepickers').timepicker({  showMeridian: false;});
    </script>
    <!-- bootstrap -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
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
</body>

</html>