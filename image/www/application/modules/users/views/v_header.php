<!--header-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Administrator</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="<?php echo base_url(); ?>assetsdashboard/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assetsdashboard/css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assetsdashboard/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assetsdashboard/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assetsdashboard/css/pages/dashboard.css" rel="stylesheet">
</head>

<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand"><?php echo $access; ?></a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> Account <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Settings</a></li>
              <li><a href="javascript:;">Help</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php echo $user; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="javascript:;">Profile</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/main_module/logout">Logout</a></li>
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
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class="active"><a href="index.html"><i><img style="margin-left:-5px;" src="<?php echo base_url(); ?>assetsdashboard/img/icon/dashboard.png"></i><span>Dashboard</span> </a> </li>
        <li><a href="reports.html"><i><img style="margin-left:-5px;" src="<?php echo base_url(); ?>assetsdashboard/img/icon/report.png"></i><span>Reports</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-long-arrow-down"></i><span>Drops</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="icons.html">Icons</a></li>
            <li><a href="faq.html">FAQ</a></li>
            <li><a href="pricing.html">Pricing Plans</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="signup.html">Signup</a></li>
            <li><a href="error.html">404</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>

<!--header-->
