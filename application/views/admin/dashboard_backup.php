<?php
$this->load->view('includes/admin_header');
?>
<style>
    .head{
        margin-left:250px !important;
    }
    #stats-chart2{
        background: url(admin_assets/img/c.jpg);
        background-repeat: no-repeat;
        background-size: cover;
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

            <div class="row-fluid">

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

            <div class="row-fluid">

                <div class="span8 widget blue" onTablet="span7" onDesktop="span8">

                    <div id="stats-chart2"  style="height:282px" ></div>

                </div>

                <div class="sparkLineStats span4 widget green" onTablet="span5" onDesktop="span4">

                    <ul class="unstyled">

                        <li><span class="sparkLineStats3"></span> 
                            Students: 
                            <span class="number">123</span>
                        </li>
                        <li><span class="sparkLineStats4"></span>
                            Departments: 
                            <span class="number">854</span>
                        </li>
                        <li><span class="sparkLineStats5"></span>
                            Teachers: 
                            <span class="number">982</span>
                        </li>
                        <li><span class="sparkLineStats6"></span>
                            Batch: <span class="number">7</span>
                        </li>
                        <li><span class="sparkLineStats7"></span>
                            Student Visits: 
                            <span class="number">70</span>
                        </li>
                        <li><span class="sparkLineStats8"></span>
                            Returning Visitor: 
                            <span class="number">29</span>
                        </li>

                    </ul>

                    <div class="clearfix"></div>

                </div><!-- End .sparkStats -->

            </div>

            <div class="row-fluid hideInIE8 circleStats">

                <div class="span2" onTablet="span4" onDesktop="span2">
                    <div class="circleStatsItemBox yellow">
                        <div class="header"></div>

                        <div class="circleStat">

                        </div>		
                        <div class="footer">
                            <span class="count">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>
                            <span class="sep"></span>
                            <span class="value">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>	
                        </div>
                    </div>
                </div>

                <div class="span2" onTablet="span4" onDesktop="span2">
                    <div class="circleStatsItemBox green">
                        <div class="header"></div>

                        <div class="circleStat">

                        </div>
                        <div class="footer">
                            <span class="count">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>
                            <span class="sep"></span>
                            <span class="value">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>	
                        </div>
                    </div>
                </div>

                <div class="span2" onTablet="span4" onDesktop="span2">
                    <div class="circleStatsItemBox greenDark">
                        <div class="header"></div>
                        <span class="percent"></span>
                        <div class="circleStat">

                        </div>
                        <div class="footer">
                            <span class="count">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>
                            <span class="sep"></span>
                            <span class="value">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>	
                        </div>
                    </div>
                </div>

                <div class="span2 noMargin" onTablet="span4" onDesktop="span2">
                    <div class="circleStatsItemBox pink">
                        <div class="header"></div>
                        <span class="percent"></span>
                        <div class="circleStat">

                        </div>
                        <div class="footer">
                            <span class="count">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>
                            <span class="sep"> / </span>
                            <span class="value">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>	
                        </div>
                    </div>
                </div>

                <div class="span2" onTablet="span4" onDesktop="span2">
                    <div class="circleStatsItemBox orange">
                        <div class="header"></div>
                        <span class="percent"></span>
                        <div class="circleStat">

                        </div>
                        <div class="footer">
                            <span class="count">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>
                            <span class="sep"></span>
                            <span class="value">
                                <span class="number"></span>
                                <span class="unit"></span>
                            </span>	
                        </div>
                    </div>
                </div>

                <div class="span2" onTablet="span4" onDesktop="span2">
                    <div class="circleStatsItemBox greenLight">
                        <div class="header"></div>
                        <span class="percent"></span>
                        <div class="circleStat">

                        </div>
                        <div class="footer">
                            <span class="count">


                            </span>
                            <span class="sep"></span>
                            <span class="value">

                                <span class="unit"></span>
                            </span>	
                        </div>
                    </div>
                </div>

            </div>		

            <div class="row-fluid">

                <div class="widget blue span5" onTablet="span6" onDesktop="span5">

                    <h2><span class="glyphicons globe"><i></i></span> </h2>

                    <hr>

                    <div class="content">

                        <div class="verticalChart">

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>

                            <div class="singleBar">

                                <div class="bar">

                                    <div class="value">
                                        <span></span>
                                    </div>

                                </div>

                                <div class="title"></div>

                            </div>	

                            <div class="clearfix"></div>

                        </div>

                    </div>

                </div><!--/span-->

                <div class="widget span3 red" onTablet="span6" onDesktop="span3">

                    <h2><span class="glyphicons pie_chart"><i></i></span> </h2>

                    <hr>

                    <div class="content">

                        <div class="browserStat big">
                            <img src="img/browser-chrome-big.png" alt="">
                            <span></span>
                        </div>
                        <div class="browserStat big">
                            <img src="img/browser-firefox-big.png" alt="">
                            <span></span>
                        </div>
                        <div class="browserStat">
                            <img src="img/browser-ie.png" alt="">
                            <span></span>
                        </div>
                        <div class="browserStat">
                            <img src="img/browser-safari.png" alt="">
                            <span></span>
                        </div>
                        <div class="browserStat">
                            <img src="img/browser-opera.png" alt="">
                            <span></span>
                        </div>	


                    </div>
                </div>

                <div class="widget yellow span4 noMargin" onTablet="span12" onDesktop="span4">
                    <h2><span class="glyphicons fire"><i></i></span> </h2>
                    <hr>
                    <div class="content">
                        <div id="mapContainer" style="height:224px;">dfsgdf</div>
                    </div>
                </div>

            </div>

            <div class="row-fluid">

                <div class="box black span4" onTablet="span6" onDesktop="span4">
                    <div class="box-header">
                        <h2><i class="halflings-icon white list"></i><span class="break"></span></h2>
                        <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="dashboard-list metro">
                            <li>
                                <a href="#">
                                    <i class="icon-arrow-up green"></i>                               
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-arrow-down red"></i>
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-minus blue"></i>
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-comment yellow"></i>
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-arrow-up green"></i>                               
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-arrow-down red"></i>
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-minus blue"></i>
                                    <strong></strong>

                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="icon-comment yellow"></i>
                                    <strong></strong>

                                </a>
                            </li>
                        </ul>
                    </div>
                </div><!--/span-->

                <div class="box black span4" onTablet="span6" onDesktop="span4">
                    <div class="box-header">
                        <h2><i class="halflings-icon white user"></i><span class="break"></span></h2>
                        <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <ul class="dashboard-list metro">
                            <li class="green">
                                <a href="#">
                                    <img class="" alt="" src="">
                                </a>
                                <strong></strong><br>
                                <strong></strong> <br>
                                <strong></strong>             
                            </li>
                            <li class="yellow">
                                <a href="#">
                                    <img class="avatar" alt="" src="img/avatar.jpg">
                                </a>
                                <strong></strong> <br>
                                <strong></strong> <br>
                                <strong></strong>                                
                            </li>
                            <li class="red">
                                <a href="#">
                                    <img class="" alt="" src="img/avatar.jpg">
                                </a>
                                <strong></strong> <br>
                                <strong></strong> <br>
                                <strong></strong>                                  
                            </li>
                            <li class="blue">
                                <a href="#">
                                    <img class="" alt="" src="img/avatar.jpg">
                                </a>
                                <strong></strong> <br>
                                <strong></strong> <br>
                                <strong></strong>                                 
                            </li>
                        </ul>
                    </div>
                </div><!--/span-->

                <div class="box black span4 noMargin" onTablet="span12" onDesktop="span4">
                    <div class="box-header">
                        <h2><i class="halflings-icon white check"></i><span class="break"></span></h2>
                        <div class="box-icon">
                            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <div class="todo metro">
                            <ul class="todo-list">
                                <li class="red">
                                    <a class="action icon-check-empty" href="#"></a>	

                                    <strong></strong>
                                </li>
                                <li class="red">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                                <li class="yellow">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                                <li class="yellow">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                                <li class="green">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                                <li class="green">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                                <li class="blue">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                                <li class="blue">
                                    <a class="action icon-check-empty" href="#"></a>

                                    <strong></strong>
                                </li>
                            </ul>
                        </div>	
                    </div>
                </div>

            </div>

            <div class="row-fluid">	

                <a class="quick-button metro yellow span2">
                    <i class="icon-group"></i>
                    <p></p>
                    <span class="badge"></span>
                </a>
                <a class="quick-button metro red span2">
                    <i class="icon-comments-alt"></i>
                    <p></p>
                    <span class="badge"></span>
                </a>
                <a class="quick-button metro blue span2">
                    <i class="icon-shopping-cart"></i>
                    <p></p>
                    <span class="badge"></span>
                </a>
                <a class="quick-button metro green span2">
                    <i class="icon-barcode"></i>
                    <p></p>
                </a>
                <a class="quick-button metro pink span2">
                    <i class="icon-envelope"></i>
                    <p></p>
                    <span class="badge"></span>
                </a>
                <a class="quick-button metro black span2">
                    <i class="icon-calendar"></i>
                    <p></p>
                </a>

                <div class="clearfix"></div>

            </div><!--/row-->



        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3></h3>
    </div>
    <div class="modal-body">
        <p></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal"></a>
        <a href="#" class="btn btn-primary"></a>
    </div>
</div>

<div class="clearfix"></div>

<footer>

    <p>
        <span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>

    </p>

</footer>
<script src="http://maps.google.com/maps/api/js?sensor=false">
</script>

<script type="text/javascript">
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var coords = new google.maps.LatLng(latitude, longitude);
            var mapOptions = {
                zoom: 15,
                center: coords,
                mapTypeControl: true,
                navigationControlOptions: {
                    style: google.maps.NavigationControlStyle.SMALL
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(
                    document.getElementById("mapContainer"), mapOptions
                    );
            var marker = new google.maps.Marker({
                position: coords,
                map: map,
                title: "Your current location!"
            });

        });
    } else {
        alert("Geolocation API is not supported in your browser.");
    }
</script>

<!-- start: JavaScript-->
<?php
$this->load->view('includes/admin_footer');
?>