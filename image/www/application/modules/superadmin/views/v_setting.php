<!--header-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Attendance</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/pages/dashboard.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.css" rel="stylesheet">
        <!--  <link href="<?php echo base_url(); ?>assets/css/bootstrapk.css" rel="stylesheet"> -->

<!-- <link href="<?php echo base_url(); ?>assets/css/bootstrap2.css" rel="stylesheet" media="screen"> -->
        <link href="<?php echo base_url(); ?>assets/css/datepicker2.css" rel="stylesheet">

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                            class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand"><?php echo "DRIFE";  ?></a>
                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="icon-cog"></i>Settings<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url(); ?>index.php/superadmin/setting">Settings</a></li>
                                    <li><a href="javascript:;">Help</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                        class="icon-user"></i> <?php  echo $user;  ?><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url() ?>index.php/superadmin/manage_profile">Profile</a></li>
                                    <li>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                                            Logout
                                        </button>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <form class="navbar-search pull-right">
                            <input type="text" class="search-query" placeholder="Search">
                        </form>
                    </div>
                    <!--/.nav-collapse --> 
                </div>
                <!-- /container --> 
            </div>
            <!-- /navbar-inner --> 
        </div>

        <!--header-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Logout Sistem ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                        <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/main_module/logout">Ya</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /subnavbar -->
        <div class="subnavbar">
            <div class="subnavbar-inner">
                <div class="container">
                    <ul class="mainnav">
                        <li><a href="<?php echo base_url(); ?>index.php/superadmin/dashboard"><i><img width="35" height="35" style="margin-left:-5px;" src="<?php echo base_url(); ?>assets/img/icon/dashboard.png"></i><span>Dashboard</span> </a> </li>

                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i><img width="25" height="20" style="margin-left:-5px;" src="<?php echo base_url(); ?>assets/img/icon/setting.png"></i><span>Manage Setting</span> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url(); ?>index.php/superadmin/manage_category">Category</a></li>
                            </ul>
                        </li>
<!-- <li><a href="#"><i><img width="35" height="35" style="margin-left:-5px;" src="<?php echo base_url(); ?>assets/img/icon/report.png"></i><span>Reports</span> </a> </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- /subnavbar -->