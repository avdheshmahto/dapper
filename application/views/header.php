<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Integral - A fully responsive, HTML5 based admin template">
    <meta name="keywords" content="Responsive, Web Application, HTML5, Admin Template, business, professional, Integral, web design, CSS3">
    <title>Dapper</title>
    <!-- Site favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='<?=base_url();?>assets/images/logo.png' />
    <!-- /site favicon -->
    <!-- Entypo font stylesheet -->
    <link href="<?=base_url();?>assets/css/entypo.css" rel="stylesheet">
    <!-- /entypo font stylesheet -->
    <!-- Font awesome stylesheet -->
    <link href="<?=base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- /font awesome stylesheet -->
    <!-- Bootstrap stylesheet min version -->
    <link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- /bootstrap stylesheet min version -->
    <!-- Integral core stylesheet -->
    <link href="<?=base_url();?>assets/css/integral-core.css" rel="stylesheet">
    <!-- /integral core stylesheet -->
    <!--Jvector Map-->
    <link href="<?=base_url();?>assets/plugins/jvectormap/css/jquery-jvectormap-2.0.3.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/integral-forms.css" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  </head>
  <body <?php if($_GET['view']!=''){ ?> oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;' <?php }?>>
    <!-- Page container -->
    <div class="page-container">
    <?php if($_GET['popup']=='True'){} else {?>
    <!-- Page Sidebar -->
    <?php 
      //require_once(APPPATH.'views/side.php');
       $this->load->view("side.php");?>
    <!-- /page sidebar -->
    <!-- Main container -->
    <div class="main-container">
    <!-- Main header -->
    <div class="main-header row">
      <div class="col-sm-6 col-xs-5">
        <div class="pull-left">
          <!-- User alerts -->
          <ul class="user-info pull-left">
            <!-- Notifications -->
           
            <!-- /messages -->
          </ul>
          <!-- /user alerts -->
        </div>
      </div>
      <div class="col-sm-6 col-xs-7">
        <!-- User info -->
        <ul class="user-info pull-right">
          <li class="profile-info dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"> <img width="44" class="img-circle avatar" alt="" src="<?=base_url();?>assets/images/man-3.jpg"><?=$this->session->userdata('user_name');?><span class="caret"></span></a>
            <!-- User action menu -->
            <ul class="dropdown-menu dropdown-menu-to" style="margin: 11px 0px 0px -40px;">
              <!-- <li><a href="#/"><i class="icon-user"></i>My profile</a></li> -->
              <li style="display:none"><a href="<?php echo base_url();?>master/Item/profile"><i class="icon-user" ></i>My profile</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo base_url();?>master/changePassword/changepwd"><i class="icon-cog"></i>Change Password</a></li>
              <li><a href="<?php echo base_url();?>master/Item/logout"><i class="icon-logout"></i>Logout</a></li>
            </ul>
            <!-- /user action menu -->
          </li>
        </ul>
        <!-- /user info -->
      </div>
    </div>
    <!-- /main header -->
    <?php }?>
    <!-- /main header -->