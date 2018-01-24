<?php
$this->load->view('includes/admin_header');
?>
<style>
    #content{
        min-height:800px !important; 
    }
    .mar{
      margin-left:50px;   
    }
</style>
<div class="navbar">
    <?php
    $this->load->view('includes/admin_header_menu');
    ?> 
</div>
<div class="container-fluid-full">
    <div class="row-fluid">
        <?php
        $this->load->view('includes/admin_main_menu');
        ?>
        <noscript>
        <div class="alert alert-block span10">
            <h4 class="alert-heading">Warning!</h4>
            <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
        </div>
        </noscript>
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
            <div class="row-fluid">
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
                        <form class="form-horizontal" action="<?php echo base_url(); ?>save_assesment" method="post" enctype="multipart/form-data">
                            <h3 style="margin-left:100px">Course Teacher Evaluation Form</h3>
                            <div class="no-res"></div>
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Course Code</label>
                                    <input type="hidden" name="student_id" value="<?php echo  $this->session->userdata('student_id');?>">
                                    <div class="controls">
                                        <select name="course_id" class="crinfo">
                                            <option value="">Select One</option>
                                            <?php
                                            foreach ($all_course_static as $v_res) {
                                                ?>
                                                <option class="vl" value="<?php echo $v_res->course_id; ?>"><?php echo $v_res->course_code; ?></option>  
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Course Title</label>
                                    <div class="controls">
                                        <select name="course_name" class="course-info" id="course-change">   
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Teacher Name</label>
                                    <div class="controls">
                                        <select name="teacher_id" id="course-change" class="course_id teacher-info ">
                                        </select>
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label" for="selectError3">Batch Name</label>
                                    <div class="controls">
                                        <select name="batch_id"  class="batch-info ">
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>(Don,t write your Name or Id number.Tick out all the queries.Your objective response 
                                   to the following queries will help us ensure a quality education for you.)</label>
                                </div>   

                                <div class="control-group">
                                    <label class="mar">1.How Would You Rank Your Teacher ?</label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_rank" value="1" >1
                                        <input type="radio" name="teacher_rank" value="2"> 2
                                        <input type="radio" name="teacher_rank" value="3"> 3
                                        <input type="radio" name="teacher_rank" value="4"> 4
                                        <input type="radio" name="teacher_rank" value="5"> 5
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="mar">2.How much relevant were your exams, tests & assignments to the syllabus ?</label>
                                    <div class="controls">
                                        <input type="radio" name="relevant_exams" value="1" >1
                                        <input type="radio" name="relevant_exams" value="2"> 2
                                        <input type="radio" name="relevant_exams" value="3"> 3
                                        <input type="radio" name="relevant_exams" value="4"> 4
                                        <input type="radio" name="relevant_exams" value="5"> 5
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="mar"> 3.How punctual was the teacher in starting and ending the lesson ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_punctual" value="3" >1
                                        <input type="radio" name="teacher_punctual" value="2"> 2
                                        <input type="radio" name="teacher_punctual" value="3"> 3
                                        <input type="radio" name="teacher_punctual" value="4"> 4
                                        <input type="radio" name="teacher_punctual" value="5"> 5
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="mar">4.Were you satisfied with your teacher's time management in the class ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_satisfied" value="1" >1
                                        <input type="radio" name="teacher_satisfied" value="2"> 2
                                        <input type="radio" name="teacher_satisfied" value="3"> 3
                                        <input type="radio" name="teacher_satisfied" value="4"> 4
                                        <input type="radio" name="teacher_satisfied" value="5"> 5
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="mar">5.was the teacher cooperative & willing in giving you time for counseling ?</label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_cooperative" value="1" >1
                                        <input type="radio" name="teacher_cooperative" value="2"> 2
                                        <input type="radio" name="teacher_cooperative" value="3"> 3
                                        <input type="radio" name="teacher_cooperative" value="4"> 4
                                        <input type="radio" name="teacher_cooperative" value="5"> 5
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="mar">6.How readily cloud your teacher respond to your question in the class ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_respond" value="1" >1
                                        <input type="radio" name="teacher_respond" value="2"> 2
                                        <input type="radio" name="teacher_respond" value="3"> 3
                                        <input type="radio" name="teacher_respond" value="4"> 4
                                        <input type="radio" name="teacher_respond" value="5"> 5
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="mar">7.Did the teacher use English as the medium of instruction in the class ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_instruction" value="1" >1
                                        <input type="radio" name="teacher_instruction" value="2"> 2
                                        <input type="radio" name="teacher_instruction" value="3"> 3
                                        <input type="radio" name="teacher_instruction" value="4"> 4
                                        <input type="radio" name="teacher_instruction" value="5"> 5
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="mar">8.How much grumpiness your teacher cloud show while giving you feedback on your test or lesson ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_grumpiness" value="1" >1
                                        <input type="radio" name="teacher_grumpiness" value="2"> 2
                                        <input type="radio" name="teacher_grumpiness" value="3"> 3
                                        <input type="radio" name="teacher_grumpiness" value="4"> 4
                                        <input type="radio" name="teacher_grumpiness" value="5"> 5
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="mar">9.Did the teacher deal with the latest development of knowledge in your courses ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_deal" value="1" >1
                                        <input type="radio" name="teacher_deal" value="2"> 2
                                        <input type="radio" name="teacher_deal" value="3"> 3
                                        <input type="radio" name="teacher_deal" value="4"> 4
                                        <input type="radio" name="teacher_deal" value="5"> 5
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="mar">10.Did the teacher utilize the modern facilities of teaching ? </label>
                                    <div class="controls">
                                        <input type="radio" name="teacher_utilize" value="1" >1
                                        <input type="radio" name="teacher_utilize" value="2"> 2
                                        <input type="radio" name="teacher_utilize" value="3"> 3
                                        <input type="radio" name="teacher_utilize" value="4"> 4
                                        <input type="radio" name="teacher_utilize" value="5"> 5
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label>Out of 24 classes (12+12) before and after the mid-term exam,how many classes were
                                    taken by the course teacher? </label>
                                     <div class="controls">
                                        <input type="text" name="total_class">
                                    </div>
                                </div> 
                                 <div class="control-group">
                                    <label>Comment on the overall performance of the course teacher</label>
                                     <div class="controls">
                                         <textarea rows="5" name="performance_comment" cols="30"></textarea>
                                    </div>
                                </div> 
                                <div class="form-actions">
                                    <button type="submit" name="btn" id="assign" class="btn btn-primary">Save</button>
                                    <button type="reset" class="btn">Reset</button>
                                </div>
                            </fieldset>
                        </form>   
                    </div>
                </div><!--/span-->
            </div><!--/row-->
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
        $(".crinfo").change(function () {
            var course_id = $(this).val();
            var baseurl = "<?php echo base_url(); ?>";
            $.ajax({
                type: "post",
                url: baseurl + 'select_course_by_id_in_ajax_for_evaluation/',
                data: {course_id: course_id},
                dataType: "json",
                success: function (result) {
                    if (result.success == 1) {
                        $('.teacher-info').html('');
                        $('.teacher-info').append(result.teacher);
                        $('.course-info').html('');
                        $('.course-info').append(result.course);
                        $('.batch-info').html('');
                        $('.batch-info').append(result.batch);
                    } else {
                        $('.no-res').html(result.box);
                    }
                }
            });
        });

    });
</script>
<?php
$this->load->view('includes/admin_footer');
?>

