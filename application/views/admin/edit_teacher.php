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
                      <form class="form-horizontal" action="<?php echo base_url(); ?>update_teacher/<?php echo $result->teacher_id; ?>" method="post">
                            <fieldset>
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Teacher Name </label>
                                    <div class="controls">
                                        <input type="text" name="name" value="<?php if (isset($result->name) != '') echo set_value('name', $result->name); ?>" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
                                        <input type="hidden" name="teacher_id" value="<?php if (isset($result->teacher_id) != '') echo set_value('teacher_id', $result->teacher_id); ?>" class="span6 typeahead" id="typeahead"  data-provide="typeahead">
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label" for="typeahead">Email Address </label>
                                    <div class="controls">
                                        <input type="text" name="email_address" value="<?php if (isset($result->email_address) != '') echo set_value('email_address', $result->email_address); ?>" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
                                    </div>
                                <div class="control-group">
                                    <label class="control-label" for="typeahead">Contact Number </label>
                                    <div class="controls">
                                        <input type="text" name="contact_number" value="<?php if (isset($result->contact_number) != '') echo set_value('contact_number', $result->contact_number); ?>" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
                                    </div>
                                    <label class="control-label" for="selectError3">Designation</label>
                                    <div class="controls">
                                        <select name="teacher_designation">
                                            <option value="">Select Designation</option>
                                            <option value="lecturer" <?php if (($result->teacher_designation)=='lecturer') echo 'selected'; ?>>Lecturer</option>
                                            <option value="professor" <?php if (($result->teacher_designation)=='professor') echo 'selected'; ?>>Professor</option> 
                                            <option value="chairman" <?php if (($result->teacher_designation)=='chairman') echo 'selected'; ?>>Chairman</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="selectError3">Department Name</label>
                                    <div class="controls">
                                        <select name="department_id">
                                            <option value="">Select Department</option>
                                            <?php
                                            foreach ($all_department as $v_dept) {
                                                ?>
                                            <option value="<?php echo $v_dept->dept_id; ?>" <?php
                                                if (isset($result->department_id) && $result->department_id == $v_dept->dept_id) {
                                                    echo 'selected';
                                                }
                                                ?>><?php echo $v_dept->dept_name; ?></option>  
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label" for="typeahead">Address </label>
                                    <div class="controls">
                                        <input type="text" name="address" value="<?php if (isset($result->address) != '') echo set_value('address', $result->address); ?>" class="span6 typeahead" id="typeahead"  data-provide="typeahead" data-items="4" >
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="fileInput">Teacher Image</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" name="image" id="fileInput" type="file">
                                    </div>
                                </div>
                                 <div class="control-group">
                               
                                <div class="form-actions">
                                    <button type="submit" name="btn" class="btn btn-primary">Update Teacher</button>
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
<?php
$this->load->view('includes/admin_footer');
?>

