<?php
$user_info = $this->User_model->get_single_record('tbl_users', array('user_id' => $this->session->userdata['user_id']), '*');
if (empty($this->session->userdata['user_id'])) {
  redirect('Member/Management/logout');
}
if ($this->session->userdata['user_id'] != $user_info['user_id']) {
  redirect('Member/Management/logout');
}
if (empty($user_info['user_id'])) {
  redirect('Member/Management/logout');
}
if ($user_info['disabled'] == 1 && $user_info['fake_id'] == 0) {
  redirect('Member/Management/logout');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?php echo title . ' | ' . $header; ?></title>
  <!--favicon-->
  <link rel="icon" href="<?php echo base_url(logo); ?>" type="image/x-icon">
  <!-- notifications css -->
  <link rel="stylesheet" href="<?php echo base_url('Resource/Member/assets/'); ?>plugins/notifications/css/lobibox.min.css" />
  <!-- Vector CSS -->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- simplebar CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS-->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>css/sidebar-menu.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="<?php echo base_url('Resource/Member/assets/'); ?>css/app-style.css" rel="stylesheet" />

  <style>
    /*SK edits*/
    /* .logo-icon {
    margin-left: 23px;
    width: 83%;
    margin-top: 13px;
}*/
    .logo-icon {
      margin-left: 34px;
      width: 32%;
      /*margin-top: 4px;*/
    }

    .brand-logo {
      width: 100%;
      height: 78px;
      border-bottom: 1px solid #33444a;
    }

    /*#sidebar-wrapper {
    background: #1a262b;
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 1000;
    overflow: hidden;
    width: 253px;
    height: 100%;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    box-shadow: 0 1px 8px rgba(0,0,0,.3);
}*/
    .gradient-ohhappiness {
      /*background: #00b09b;*/
      /*background: -webkit-linear-gradient(45deg, #00b09b, #96c93d) !important;*/
      /*background: linear-gradient(to right, #e10000, #15348f) !important;*/
    }

    .bg-skype {
      background-color: #fc5916 !important;
      /*background-color: #113d5a;*/
      height: 43px;
      font-weight: bold;
    }

    .gradient-scooter {
      /*background: #17ead9;*/
      /*background: -webkit-linear-gradient(45deg, #17ead9, #6078ea) !important;*/
      background: linear-gradient(45deg, #171e19, #008cff) !important;
    }

    .gradient-ibiza {
      /*background: #ee0979;*/
      /*background: -webkit-linear-gradient(45deg, #ee0979, #ff6a00) !important;*/
      background: linear-gradient(45deg, #171e19, #008cff) !important;

    }

    .card {
      margin-bottom: 30px;
      box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
      border: none;
      background: linear-gradient(45deg, #171e19, #008cff) !important;
      color: #fff;
      padding-left: 20px;
    }
  </style>
</head>

<!-- <body onload="info_noti()"> -->

<!-- Start wrapper-->
<div id="wrapper">

  <!--Start sidebar-wrapper-->
  <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
      <a href="<?php echo base_url('Member/Management/Index'); ?>">
        <img src="<?php echo base_url(logo); ?>" class="logo-icon" alt="logo icon">

        <!-- <h5 class="logo-text"> DashRock</h5> -->
      </a>
    </div>
    <!-- <div class="user-details">
    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">

       <div class="media-body">
       <h6 class="side-user-name"><?php //echo strtoupper($user_info['name']);
                                  ?></h6>
      </div>
       </div>
     <div id="user-dropdown" class="collapse">
      <ul class="user-setting-menu">
            <li><a href="<?php //echo base_url('Member/Profile/index');
                          ?>"><i class="icon-user"></i>  My Profile</a></li>
      <li><a href="<?php //echo base_url('Member/Management/logout');
                    ?>"><i class="icon-power"></i> Logout</a></li>
      </ul>
     </div>
      </div> -->
    <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="<?php echo base_url('Member/Management/index') ?>" class="waves-effect">
          <i class="icon-home"></i><span>Dashboard</span></i>
        </a>
      </li>

      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-users"></i><span>Downline</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Member/Downline/Index'); ?>"><i class="fa fa-long-arrow-right"></i> All Directs</a></li>
          <li><a href="<?php echo base_url('Member/Downline/Index/1'); ?>"><i class="fa fa-long-arrow-right"></i> Active Directs</a></li>
          <li><a href="<?php echo base_url('Member/Downline/Index/2'); ?>"><i class="fa fa-long-arrow-right"></i> Inactive Directs</a></li>
          <!-- <li><a href="<?php //echo base_url('Member/Downline/checkLeadership');
                            ?>"><i class="fa fa-long-arrow-right"></i> Check Leadership</a></li> -->
        </ul>
      </li>

      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-external-link"></i><span>Register</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a target="_blank" href="<?php echo base_url('Register?id=' . $this->session->userdata['user_id']); ?>"><i class="fa fa-long-arrow-right"></i> Register</a></li>
        </ul>
      </li>

      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-cog"></i><span>Settings</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Member/Profile/index'); ?>"><i class="fa fa-long-arrow-right"></i> Edit Profile</a></li>
          <li><a href="<?php echo base_url('Member/Profile/changePassword'); ?>"><i class="fa fa-long-arrow-right"></i> Change Password</a></li>
          <li><a href="<?php echo base_url('Member/Profile/changeTxnPassword'); ?>"><i class="fa fa-long-arrow-right"></i> Change Txn Password</a></li>
        </ul>
      </li>


      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-key"></i><span>Epins Management</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">

          <li><a href="<?php echo base_url('Member/Epin/AvailebleEpin'); ?>"><i class="fa fa-long-arrow-right"></i>Avaliable E-Pins</a></li>
          <li><a href="<?php echo base_url('Member/Epin/epinHistory/1'); ?>"><i class="fa fa-long-arrow-right"></i>Used E-Pins</a></li>
          <li><a href="<?php echo base_url('Member/Epin/epinHistory/2'); ?>"><i class="fa fa-long-arrow-right"></i>Transfer E-Pins Details</a></li>
          <li><a href="<?php echo base_url('Member/Epin/Transfer_Epin'); ?>"><i class="fa fa-long-arrow-right"></i>Transfer E-Pins</a></li>
        </ul>
      </li>

      <!-- <li>
        <a href="javaScript:void();" class="waves-effect">
        <i class="fa fa-key"></i><span>Activation</span> 
       <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
            <li><a href="<?php // echo base_url('Member/Epin/AvailebleEpin');
                          ?>"><i class="fa fa-long-arrow-right"></i>Account Activation</a></li>
        </ul>
      </li> -->
      <li>
        <a href="javaScript:void();" class="waves-effect">
          <i class="fa fa-university" aria-hidden="true"></i><span>Money Transfer</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Member/IMPS/index'); ?>"><i class="fa fa-long-arrow-right"></i>Add Beneficiary</a></li>
        </ul>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url('Member/IMPS/beneficiaryDetails'); ?>"><i class="fa fa-long-arrow-right"></i>Money Transfer</a></li>
        </ul>
      </li>

      <!--  <li>
        <a href="javaScript:void();" class="waves-effect">
        <i class="fa fa-trophy"></i><span>Achivers List</span> 
       <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
            <li><a href="<?php //echo base_url('Member/Downline/royaltyAchiver_list');
                          ?>"><i class="fa fa-long-arrow-right"></i>Royalty Achivers</a></li>
        </ul>
        <ul class="sidebar-submenu">
            <li><a href="<?php //echo base_url('Member/Downline/leadershipAchiver_list');
                          ?>"><i class="fa fa-long-arrow-right"></i>Leadership Achivers</a></li>
        </ul>
      </li> -->

      <li>
        <a href="javaScript:void();" class="waves-effect">
          <?php echo currency_icon ?><span>Incomes Reports</span>
          <i class="fa fa-angle-left pull-right"></i>

        </a>
        <ul class="sidebar-submenu">
          <?php
          $incomes = $this->config->item('incomes');
          foreach ($incomes as $key => $value) {
            echo ' <li><a href="' . base_url('Member/Incomes/index/' . $key) . '"><i class="fa fa-long-arrow-right"></i> ' . $value . '</a></li>';
          }
          echo ' <li><a href="' . base_url('Member/Incomes/index/') . '"><i class="fa fa-long-arrow-right"></i>All Income Reports</a></li>';
          ?>
        </ul>
      </li>


      <li><a href="<?php echo base_url('Member/Management/logout'); ?>" class="waves-effect"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
    </ul>

  </div>
  <!--End sidebar-wrapper-->

  <!--Start topbar header-->
  <header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top gradient-ibiza">
      <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link toggle-menu" href="javascript:void();">
            <i class="icon-menu menu-icon"></i>
          </a>
        </li>
        <!-- <li>
      <input type="text" name="" readonly="" value="<?php //echo base_url('Register?sponser_id='.$user_info['user_id']); 
                                                    ?>">
    </li> -->
      </ul>

    </nav>
  </header>
  <!--End topbar header-->