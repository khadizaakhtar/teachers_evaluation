<?php
$this->load->view('includes/admin_header');
?>
<style>
    #content{
        min-height:800px !important; 
    }
</style>
<div class="navbar">
    <?php
    $this->load->view('includes/admin_header_menu');
    ?> 
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <?php
        $this->load->view('includes/admin_main_menu');
        ?>
        <!-- end: Main Menu -->

        <noscript>
        <div class="alert alert-block span10">
            <h4 class="alert-heading">Warning!</h4>
            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
        </div>
        </noscript>

        <!-- start: Content -->
        <div id="content" class="span10">


            <ul class="breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="#">Home</a>
                    <i class="icon-angle-right"></i> 
                </li>
                <li>
                    <i class="icon-edit"></i>
                    <a href="#">Forms</a>
                </li>
                <li class="pull-right">
                    <a class="btn btn-primary" title="delete this" href="<?php echo base_url(); ?>logout" title="Delete">
                        Log Out 
                    </a>
                </li>  
            </ul>

            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon edit"></i><span class="break"></span>Form Elements</h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                    </div>

                    <?php
                    if (validation_errors() || $this->session->flashdata('err')) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Error!</b> <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('err'); ?>

                        </div>
                    <?php } ?>

                    <?php
                    if ($this->session->flashdata('success')) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Success!</b> 
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?> 

                    <div class="box-content"> 
                        <form class="form-horizontal" action="<?php echo base_url(); ?>save_course_assign_to_teacher" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Department Name</label>
                                    <div class="controls">
                                        <select name="department_id" id="department_info" class="department_info">
                                            <option value="">Select Department</option>
                                            <?php
                                            foreach ($all_department as $v_dept) {
                                                ?>
                                                <option value="<?php echo $v_dept->dept_id; ?>"><?php echo $v_dept->dept_name; ?></option>  
                                            <?php } ?>
                                        </select>
                                        <span style="color:red">*</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Teacher</label>
                                    <div class="controls">
                                        <select name="teacher_id" class="teacher-change teacher-info" id="teacher-change">   
                                        </select>

                                        <span style="color:red">*</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Course Code</label>
                                    <div class="controls">
                                        <select name="course_id" id="course-change" class="course_id course-info ">
                                        </select>
                                        <span style="color:red">*</span>
                                    </div>
                                </div>

                                <div class="course_info" id="course_info">
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Batch Name</label>
                                    <div class="controls">
                                        <select name="batch_id">
                                            <option value="">Select Batch</option>
                                            <?php
                                            foreach ($all_batch as $v_batch) {
                                                ?>
                                                <option value="<?php echo $v_batch->batch_id; ?>"><?php echo $v_batch->batch_name; ?></option>  
                                            <?php } ?>
                                        </select>
                                        <span style="color:red">*</span>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Semester</label>
                                    <div class="controls">
                                        <select name="semester">
                                            <option value="">Select Semester</option>
                                            <option value="summer">Summer</option>  
                                            <option value="fall">Fall</option> 
                                            <option value="spring">Spring</option> 
                                        </select>
                                        <span style="color:red">*</span>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="btn" id="assign" class="btn btn-primary">Assign</button>
                                    <button type="reset" class="btn">Reset</button>
                                </div>
                            </fieldset>
                        </form>   
                    </div>
                </div><!--/span-->
            </div><!--/row-->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2></h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"></a>
                            <a href="#" class="btn-minimize"></a>
                            <a href="#" class="btn-close"></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal">

                        </form>
                    </div>
                </div><!--/span-->

            </div>
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2></h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"></a>
                            <a href="#" class="btn-minimize"></a>
                            <a href="#" class="btn-close"></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal">

                        </form>
                    </div>
                </div><!--/span-->

            </div>
        </div><!--/.fluid-container-->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>
<div class="clearfix"></div>
<footer>
    <p>
        <span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>
    </p>
</footer>
<!-- start: JavaScript-->
<script>
    $(document).ready(function () {
        $(".department_info").change(function () {
            var department_id = $(this).val();
            var baseurl = "<?php echo base_url(); ?>";
            $.ajax({
                type: "post",
                url: baseurl + 'select_department_by_id_in_ajax/',
                data: {department_id: department_id},
                dataType: "json",
                success: function (result) {
                    if (result.success == 1) {
                        $('.teacher-info').html('');
                        $('.teacher-info').append(result.teacher);
                        $('.course-info').html('');
                        $('.course-info').append(result.course);
                    } else {
                        $('.teacher-info').html('');
                        $('.teacher-info').append(result.box);
                    }
                }
            });
        });

        $("#course-change").change(function () {
            var course_id = $(this).val();
            var baseurl = "<?php echo base_url(); ?>";
            $.ajax({
                type: "post",
                url: baseurl + 'select_course_by_id_in_ajax/',
                data: {course_id: course_id},
                dataType: "json",
                success: function (result) {
                    if (result.success == 1) {
                        $('.course_info').html('');
                        $('.course_info').append(result.box);
                    } else {
                        $('.course_info').html('');
                        $('.course_info').append(result.box);
                    }
                }
            });
        });



    });
</script>
<?php
$this->load->view('includes/admin_footer');
?>

