<?php
$this->load->view('includes/admin_header');
?>
<style>
    .show{
        margin-left:340px;
    }
    #content{
        min-height:800px !important; 
    }
    .box-header .box-icon {
        float: right;
        margin-top: 0px !important; 
    }
    .box-header {
        height: 28px !important;
    }
    #unsuc{
        color:green;
        margin-left:100px; 
    }
</style>
<!-- start: Header -->
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
                    <a href="index.html">Home</a> 
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="#">Tables</a></li>
                <li class="pull-right">
                    <a class="btn btn-primary delete" title="delete this" href="<?php echo base_url(); ?>logout" title="Delete" >
                        Log Out 
                    </a>
                </li>  
            </ul>

            <div class="row-fluid sortable">		
                <div class="box span12">
                    <div class="box-header" data-original-title>
                        <h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
                        <div class="box-icon">
                            <button type="button" class="btn btn-danger print">Print</button>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                            <div class="nores"></div>
                            <fieldset>
                                <div id="first-div">
                                    <?php if ($this->session->userdata('access_level') == 1) { ?>
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Teacher,s Name</label>
                                            <div class="controls">
                                                <select name="teacher_id" id="teacher_info" class="teacher_info">
                                                    <option value="">Select Teacher</option>
                                                    <?php
                                                    foreach ($all_teacher as $v_res) {
                                                        ?>
                                                        <option value="<?php echo $v_res->teacher_id; ?>"><?php echo $v_res->name; ?></option>  
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('access_level') == 2) { ?>
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Teacher,s Name</label>
                                            <div class="controls">
                                                <select name="teacher_id" id="teacher_info" class="teacher_info">
                                                    <option value="">Select Teacher</option>
                                                    <option value="<?php echo $all_teacher->teacher_id; ?>"><?php echo $all_teacher->name; ?></option>  
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="control-group">
                                        <label class="control-label" for="selectError3">Course Name</label>
                                        <div class="controls">
                                            <select name="course_id" id="course-change" class="course-info">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="selectError3">Batch Name</label>
                                        <div class="controls">
                                            <select name="batch_id" id="batch-info" class="batch-info">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <button type="button" name="btn" id="show" class="btn btn-primary show">Show</button>
                                    </div>
                            </fieldset>
                        </form>
                    </div>

                </div>

                <div id="unsuc"></div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Questions</th>
                            <th>Average</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Medium</th>
                        </tr>
                    </thead>   
                    <tbody>             
                        <tr>
                            <td class="center">1.How Would You Rank Your Teacher ?</td>
                            <td class="center rank" id="avg_tr"></td>
                            <td class="center" id="min_tr"></td>
                            <td class="center" id="max_tr"></td>
                            <td id="mid_tr"></td>
                        </tr>  
                        <tr>
                            <td class="center">2.How much relevant were your exams, tests & assignments to the syllabus ?</td>
                            <td class="center" id="avg_r"></td>
                            <td class="center" id="min_r"></td>
                            <td class="center" id="max_r"></td>
                            <td id="mid_r"></td>
                        </tr> 
                        <tr>
                            <td class="center">3.How punctual was the teacher in starting and ending the lesson ?</td>
                            <td class="center" id="avg_p"></td>
                            <td class="center" id="min_p"></td>
                            <td class="center" id="max_p"></td>
                            <td id="mid_p"></td>
                        </tr> 
                        <tr>
                            <td class="center">4.Were you satisfied with your teacher's time management in the class ?</td>
                            <td class="center" id="avg_ts"></td>
                            <td class="center" id="min_ts"></td>
                            <td class="center" id="max_ts"></td>
                            <td id="mid_ts"></td>
                        </tr> 
                        <tr>
                            <td class="center">5.was the teacher cooperative & willing in giving you time for counseling ?</td>
                            <td class="center" id="avg_tc"></td>
                            <td class="center" id="min_tc"></td>
                            <td class="center" id="max_tc"></td>
                            <td id="mid_tc"></td>
                        </tr> 
                        <tr>
                            <td class="center">6.How readily cloud your teacher respond to your question in the class ?</td>
                            <td class="center" id="avg_tre"></td>
                            <td class="center" id="min_tre"></td>
                            <td class="center" id="max_tre"></td>
                            <td id="mid_tre"></td>
                        </tr> 
                        <tr>
                            <td class="center">7.Did the teacher use English as the medium of instruction in the class ?</td>
                            <td class="center" id="avg_ti"></td>
                            <td class="center" id="min_ti"></td>
                            <td class="center" id="max_ti"></td>
                            <td id="mid_ti"></td>
                        </tr> 
                        <tr>
                            <td class="center">8.How much grumpiness your teacher cloud show while giving you feedback on your test or lesson ?</td>
                            <td class="center" id="avg_tg"></td>
                            <td class="center" id="min_tg"></td>
                            <td class="center" id="max_tg"></td>
                            <td id="mid_tg"></td>
                        </tr> 
                        <tr>
                            <td class="center">9.Did the teacher deal with the latest development of knowledge in your courses ?</td>
                            <td class="center" id="avg_td"></td>
                            <td class="center" id="min_td"></td>
                            <td class="center" id="max_td"></td>
                            <td id="mid_td"></td>
                        </tr> 
                        <tr>
                            <td class="center">10.Did the teacher utilize the modern facilities of teaching ?</td>
                            <td class="center" id="avg_tu"></td>
                            <td class="center" id="min_tu"></td>
                            <td class="center" id="max_tu"></td>
                            <td id="mid_tu"></td>
                        </tr> 
                    </tbody>
                </table>  
                </form> 
            </div>
        </div><!--/span-->
    </div><!--/row-->
</div><!--/.fluid-container-->
<!-- end: Content -->
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
<script>
    $(document).ready(function () {
        $(".teacher_info").change(function () {
            var teacher_id = $(this).val();
            if (teacher_id == '') {
                $('#course-change').prop('disabled', true);
                $('#batch-info').prop('disabled', true);
            } else {
                $('#course-change').prop('disabled', false);
                $('#batch-info').prop('disabled', false);

                var baseurl = "<?php echo base_url(); ?>";
                $.ajax({
                    type: "post",
                    url: baseurl + 'select_assesment_course_by_id_in_ajax/',
                    data: {teacher_id: teacher_id},
                    dataType: "json",
                    success: function (result) {
                        if(result.success==1){
                        $('#course-change').html(result.course_select_box);
                        $('#batch-info').html(result.batch_select_box);
                    }else{
                        $('.nores').html(result.nores);
                    }
                    }
                });
            }
        });

        $("#show").click(function () {
            var teacher_id = $("#teacher_info").val();
            var course_id = $("#course-change").val();
            var batch_id = $("#batch-info").val();
            var baseurl = "<?php echo base_url(); ?>";
            if (teacher_id == "" || course_id == "" || batch_id == "") {
                if (teacher_id == "") {
                    alert('Teacher Field Required');
                }
                if (course_id == "") {
                    alert('Course Field Required');
                }
                if (batch_id == "") {
                    alert('Batch Field Required');
                }

            } else {
                $.ajax({
                    type: "post",
                    url: baseurl + 'select_all_assesment_by_id_in_ajax/',
                    data: {teacher_id: teacher_id, course_id: course_id, batch_id: batch_id},
                    dataType: "json",
                    success: function (result) {
                        if (result.success == 1) {
                            $('#avg_tr').html(result.avg_teacher_rank);
                            $('#min_tr').html(result.min_teacher_rank);
                            $('#max_tr').html(result.max_teacher_rank);
                            $('#mid_tr').html(result.mid_teacher_rank);

                            $('#avg_r').html(result.avg_relevant_exams);
                            $('#min_r').html(result.min_relevant_exams);
                            $('#max_r').html(result.max_relevant_exams);
                            $('#mid_r').html(result.mid_relevant_exams);

                            $('#avg_p').html(result.avg_teacher_punctual);
                            $('#min_p').html(result.min_teacher_punctual);
                            $('#max_p').html(result.max_teacher_punctual);
                            $('#mid_p').html(result.mid_teacher_punctual);


                            $('#avg_ts').html(result.avg_teacher_satisfied);
                            $('#min_ts').html(result.min_teacher_satisfied);
                            $('#max_ts').html(result.max_teacher_satisfied);
                            $('#mid_ts').html(result.mid_teacher_satisfied);

                            $('#avg_tc').html(result.avg_teacher_cooperative);
                            $('#min_tc').html(result.min_teacher_cooperative);
                            $('#max_tc').html(result.max_teacher_cooperative);
                            $('#mid_tc').html(result.mid_teacher_cooperative);

                            $('#avg_tre').html(result.avg_teacher_respond);
                            $('#min_tre').html(result.min_teacher_respond);
                            $('#max_tre').html(result.max_teacher_respond);
                            $('#mid_tre').html(result.mid_teacher_respond);

                            $('#avg_ti').html(result.avg_teacher_instruction);
                            $('#min_ti').html(result.min_teacher_instruction);
                            $('#max_ti').html(result.max_teacher_instruction);
                            $('#mid_ti').html(result.mid_teacher_instruction);

                            $('#avg_tg').html(result.avg_teacher_grumpiness);
                            $('#min_tg').html(result.min_teacher_grumpiness);
                            $('#max_tg').html(result.max_teacher_grumpiness);
                            $('#mid_tg').html(result.mid_teacher_grumpiness);

                            $('#avg_td').html(result.avg_teacher_deal);
                            $('#min_td').html(result.min_teacher_deal);
                            $('#max_td').html(result.max_teacher_deal);
                            $('#mid_td').html(result.mid_teacher_deal);

                            $('#avg_tu').html(result.avg_teacher_utilize);
                            $('#min_tu').html(result.min_teacher_utilize);
                            $('#max_tu').html(result.max_teacher_utilize);
                            $('#mid_tu').html(result.mid_teacher_utilize);
                        } else {
                            $('#unsuc').html('<h3 style="color:red; margin-left:185px;">Sorry No Assesment Found or Invalid Input!</h3>');
                        }
                    }
                });

            }

        });


        $(".print").click(function () {
            var teacher_id = $("#teacher_info").val();
            var course_id = $("#course-change").val();
            var batch_id = $("#batch-info").val();
            var baseurl = "<?php echo base_url(); ?>";
            if (teacher_id == "" || course_id == "" || batch_id == "") {
                if (teacher_id == "") {
                    alert('Teacher Field Required');
                }
                if (course_id == "") {
                    alert('Course Field Required');
                }
                if (batch_id == "") {
                    alert('Batch Field Required');
                }

            } else {
                $.ajax({
                    type: "post",
                    url: baseurl + 'create_pdf_page_in_ajax/',
                    data: {teacher_id: teacher_id, course_id: course_id, batch_id: batch_id},
                    dataType: "json",
                    success: function (result) {
                        if(result.success==1){
                            alert('Your Assesment Pdf Save in Pdf Folder!');
                            $('.nores').html('<h3 style="color:green; margin-left:185px;">Your Assesment Pdf Save in Pdf Folder!</h3>');
                        }else{
                           $('.nores').html('<h3 style="color:red; margin-left:185px;">Sorry No Assesment Found or Invalid Input!</h3>');
                        }
                    }
                });


            }

        });


    });
</script>
<?php
$this->load->view('includes/admin_footer');
?>
