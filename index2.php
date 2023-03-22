<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include("database.php");
mysqli_query($con, 'DROP TABLE IF EXISTS `master`');
mysqli_multi_query($con, "TRUNCATE table backup_table");   

$_SESSION['mode'] = 'Evening';

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inteligence TimeTable Management System - Department</title>
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
    <!-- <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/data-table/buttons.bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet"> -->
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
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
                                <h1>Create Evening Timetable</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Create Evening Timetable</li>
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

                            <?php 
                    if(isset($_SESSION['status']))
                    {
                        if(str_contains($_SESSION['status'], 'Inserted')|| str_contains($_SESSION['status'], 'uploaded'))
                        { ?>
                                <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $_SESSION['status']; ?>
                        </div>
                     <?php  } else {?>
                        <div class="alert alert-warning alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $_SESSION['status']; ?>
                        </div>
                        <?php } 
                        
                        unset($_SESSION['status']);
                    }
                ?>
    		        <div class="card-body">
            <div class="basic-form">
                <form method="POST" action="timetable_saving.php">
                	<div class="row " style="margin-bottom: -15px;">

                    <div class="col-lg-4">
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

                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="number" id='session' name="sessionfrom" class="form-control form-control-md "  placeholder="Session From"required>
                        </div>
                	</div>
                    
                        
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input type="number" name="sessionto" class="form-control form-control-md "  placeholder="Session To"required>
                        </div>
                	</div>



                		<div class="col-lg-3" id="semester" style="display:none">
                			<div class="form-group">
                			    <select class="form-control form-control-md" Name='semester'style="height: 42px" required>
                                    <option value="">--- Semester ---</option>
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

                        <div class="col-lg-3"  id="break" style="display:none">
                                            <div class="form-group">
                                                <select class="form-control form-control-md" id='labselection'
                                                    name='labselection' style="height: 42px" required>
                                                    <option value="">--- Break ---</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                        <div class="col-lg-3"  id="breakfrom" style="display:none">
                                                        <div class="form-group" >
                                                            <select class="form-control form-control-md"
                                                                Name='breakfrom' >
                                                                <option value="">--- Break From ---</option>
                                                                <option value="16:00PM">4:00PM</option>
                                                                <option value="17:00PM">5:00PM</option>
                                                                <option value="18:00PM">6:00PM</option>
                                                                <option value="19:00PM">7:00PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3"  id="breakto" style="display:none">
                                                        <div class="form-group">
                                                            <select class="form-control form-control-md"
                                                                Name='breakto' >
                                                                <option value="">--- Break To ---</option>
                                                                <option value="17:00PM">5:00PM</option>
                                                                <option value="18:00PM">6:00PM</option>
                                                                <option value="19:00PM">7:00PM</option>
                                                                <option value="20:00PM">8:00PM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                        <div class="col-lg-6" id="linebreak" style="display: none;"></div>
                        <div class="col-lg-2"  id="section" style="display:none">
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

                        <div class="col-lg-4"  id="professor" style="display:none">
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

                		<div class="col-lg-4"  id="course" style="display:none">
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

                    
                        <div class="col-lg-2"  id="addbtn" style="display:none">
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

    <!-- bootstrap -->
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
                                    <?php while ($row = mysqli_fetch_array( $result1,MYSQLI_ASSOC)):; ?>\
                                            <option value="<?php echo $row['name'];?>"><?php echo $row['name'];?></option>\
                                    <?php endwhile; mysqli_data_seek($result1,0); ?>\
                                </select>\
                     </div>\
                   </div>\
                   <div class="col-lg-5 mt-2">\
                     <div class="input-group" >\
                     <select class="form-control form-control-md" name="course[]" style="height: 42px" required>\
                                    <option value="">--- Course Assigned ---</option>\
                                    <?php while ($row = mysqli_fetch_array( $result3,MYSQLI_ASSOC)):; ?>\
                                            <option value="<?php echo $row['course_name'];?>"><?php echo $row['course_name'];?></option>\
                                    <?php endwhile; mysqli_data_seek($result3,0); ?>\
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

<script type="text/javascript">

$('#session').on('change',function(){
var valchange = $('#nextrow').val();

if(valchange != ''){
$('#break').show("fast");
$('#semester').show("fast");
}
});


$('#labselection').on('change',function(){
var changeVal = $('#labselection').val();

if(changeVal == 'yes'){
    
$('#breakfrom').show("fast");
$('#breakto').show("fast");
$('#linebreak').hide("fast");

}else{
$('#breakfrom').hide("fast");
$('#breakto').hide("fast");
$('#linebreak').show("fast");

}
if(changeVal == 'yes' ||changeVal == 'no' ){
$('#section').show("fast");
$('#professor').show("fast");
$('#course').show("fast");
$('#addbtn').show("fast");
}
}
);
</script>

    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</body>

</html>