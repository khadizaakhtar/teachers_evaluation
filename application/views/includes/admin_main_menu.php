<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <?php if (($this->session->userdata('access_level') == 1) || ($this->session->userdata('access_level') == 3)) { ?> 
                <li><a href="<?php echo base_url(); ?>dashboard"><i class="icon-bar-chart"></i><span class="hidden-tablet">Dashboard</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_department"><i class="icon-bar-chart"></i><span class="hidden-tablet">Department</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_course"><i class="icon-bar-chart"></i><span class="hidden-tablet">Course</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_batch"><i class="icon-bar-chart"></i><span class="hidden-tablet">Batch</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_teacher"><i class="icon-bar-chart"></i><span class="hidden-tablet">Teacher</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_student"><i class="icon-bar-chart"></i><span class="hidden-tablet">Student</span></a></li>
                <li><a href="<?php echo base_url(); ?>register_student"><i class="icon-bar-chart"></i><span class="hidden-tablet">Register Student</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_staff"><i class="icon-bar-chart"></i><span class="hidden-tablet">All Staff</span></a></li>
                <li><a href="<?php echo base_url(); ?>add_sub_admin"><i class="icon-bar-chart"></i><span class="hidden-tablet">Add Sub-Admin</span></a></li>
                <li><a href="<?php echo base_url(); ?>course_assign_to_teacher"><i class="icon-bar-chart"></i><span class="hidden-tablet">Course Assign To Teacher</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_course_static"><i class="icon-bar-chart"></i><span class="hidden-tablet">View Course Static</span></a></li>
                <li><a href="<?php echo base_url(); ?>view_assesment"><i class="icon-bar-chart"></i><span class="hidden-tablet">Teacher Assesment</span></a></li>
            <?php } ?>
            <?php if ($this->session->userdata('access_level') == 0) { ?> 
                <li><a href="<?php echo base_url(); ?>teacher_evaluation"><i class="icon-bar-chart"></i><span class="hidden-tablet">Teacher Evaluation</span></a></li>
            <?php } ?>
            <?php if ($this->session->userdata('access_level') == 2) { ?> 
                <li><a href="<?php echo base_url(); ?>view_assesment"><i class="icon-bar-chart"></i><span class="hidden-tablet">Teacher Assesment</span></a></li>
            <?php } ?>
        </ul>
    </div>
</div>