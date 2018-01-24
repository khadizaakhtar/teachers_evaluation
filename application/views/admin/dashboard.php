<?php
$this->load->view('includes/admin_header');
?>
<style>
    .head{
        margin-left:250px !important;
    }
    #first-div{
        background: url(admin_assets/img/stamford.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        width:100%;
        min-height:400px; 
        border-radius: 10px;
        margin-bottom:20px;
    }
    .span3{
     border-radius: 10px;   
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
                    <a href="#">Home</a> 
                    <i class="icon-angle-right"></i>
                </li>
                <li><a href="#">Dashboard</a></li>
                <li><a class="head"><b><?php
                            if ($this->session->userdata('student_id')) {
                                echo'Student Admin Panel';
                            } else if ($this->session->userdata('admin_id')) {
                                echo'Admin Panel';
                            } else {
                                echo'Teacher Admin Panel';
                            }
                            ?></a></b></li>
                <li class="pull-right">
                    <a class="btn btn-primary" title="delete this" href="<?php echo base_url(); ?>logout" title="Delete">
                        Log Out 
                    </a>
                </li>  
            </ul>

            <div class="row-fluid" id="first-div">
            </div>		
            <div class="row-fluid hideInIE8 circleStats">

                <div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
                    <div class="boxchart"></div>
                    <div class="number">854<i class="icon-arrow-up"></i></div>
                    <div class="title">Departments</div>
                    <div class="footer">
                    </div>	
                </div>
                <div class="span3 statbox green" onTablet="span6" onDesktop="span3">
                    <div class="boxchart"></div>
                    <div class="number">123<i class="icon-arrow-up"></i></div>
                    <div class="title">Students</div>
                    <div class="footer">
                    </div>
                </div>
                <div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
                    <div class="boxchart"></div>
                    <div class="number">982<i class="icon-arrow-up"></i></div>
                    <div class="title">Teachers</div>
                    <div class="footer">
                    </div>
                </div>
                <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
                    <div class="boxchart"></div>
                    <div class="number">678<i class="icon-arrow-down"></i></div>
                    <div class="title">Course</div>
                    <div class="footer">
                    </div>
                </div>	

                </div>

            </div>		
          </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->
<footer>
    <p>
        <span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>

    </p>

</footer>
<!-- start: JavaScript-->
<?php
$this->load->view('includes/admin_footer');
?>