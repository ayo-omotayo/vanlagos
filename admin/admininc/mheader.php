<?php  session_start();  include_once("../controllers/classes/Admin.php"); ?>
<!DOCTYPE html>
<html lang="en"><meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" type="image/png" href="adminasset/favIcon.png" sizes="16x16">
    <base href="http://localhost/vanlagos/admin/">
    <title>VanLagos: Admin </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="admincss/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="admincss/bootstrap4.1.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link href="admincss/paper-dashboard.min790f.css?v=2.0.1" rel="stylesheet" />
    <style>
        .remove-nav-bg:hover{background: none !important;}
        form .error {
            color: #e74c3c !important;
            border-color: #e74c3c !important;
        }
        form label.error{
            font-size: 0.8rem !important;
        }
    </style>
</head>
<body class="sidebar-mini">
<div class="wrapper">
    <div class="sidebar" data-color="brown" data-active-color="danger">
        <div class="logo">
            <a href="mdashboard" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="adminasset/favIcon.png" alt="Logo">
                </div>
            </a>
            <a href=mdashboard" class="simple-text logo-normal">
                <b>VanLagos ADMIN</b>
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mdashboard.php') echo 'active'; ?>">
                    <a href="mdashboard">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a data-toggle="collapse" href="#travelList">
                        <i class="nc-icon nc-book-bookmark"></i>
                        <p>Bookings<b class="caret"></b></p>
                    </a>
                    <div class="collapse" id="travelList">
                        <ul class="nav">
                            <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mbookings.php') echo 'active'; ?>">
                                <a href="mbookings">
                                    <span class="sidebar-mini-icon">BL</span>
                                    <span class="sidebar-normal">Bookings List</span>
                                </a>
                            </li>
                            <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mhirebus.php') echo 'active'; ?>">
                                <a href="mhirebus">
                                    <span class="sidebar-mini-icon">BH</span>
                                    <span class="sidebar-normal">Bus Hire</span>
                                </a>
                            </li>
                            <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mhirevan.php') echo 'active'; ?>">
                                <a href="mhirevan">
                                    <span class="sidebar-mini-icon">VH</span>
                                    <span class="sidebar-normal">Van Hire</span>
                                </a>
                            </li>
                            <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mhirecar.php') echo 'active'; ?>">
                                <a href="mhirecar">
                                    <span class="sidebar-mini-icon">CH</span>
                                    <span class="sidebar-normal">Car Hire</span>
                                </a>
                            </li>
                            <?php if ($_SESSION['admin_login']['adm_role']==="super") { ?>
<!--                            <li class="--><?php //if(basename($_SERVER['PHP_SELF']) =='mcreatebooking.php') echo 'active'; ?><!--">-->
<!--                                <a href="mcreatebooking">-->
<!--                                    <span class="sidebar-mini-icon">M</span>-->
<!--                                    <span class="sidebar-normal">Manual Booking</span>-->
<!--                                </a>-->
<!--                            </li>-->
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mpayments.php') echo 'active'; ?>">
                    <a data-toggle="collapse" href="#mpayments">
                        <i class="nc-icon nc-bullet-list-67"></i>
                        <p>Transactions <b class="caret"></b></p>
                    </a>
                    <div class="collapse" id="mpayments">
                        <ul class="nav">
                            <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mtransfer-request.php') echo 'active'; ?>">
                                <a href="mtransfer-request">
                                    <span class="sidebar-mini-icon">TR</span>
                                    <span class="sidebar-normal">Pending (TF) <span class="badge badge-pill badge-danger pull-right"><?= $admin->count_transfer_request(); ?></span></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="<?php if(basename($_SERVER['PHP_SELF']) =='mpayments') echo 'active'; ?>">
                                <a href="mpayments">
                                    <span class="sidebar-mini-icon">PY</span>
                                    <span class="sidebar-normal">Payments</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="<?php if(basename($_SERVER['PHP_SELF']) =='logout.php') echo 'active'; ?>">
                    <a href="logout/<?= $_SESSION['admin_login']['adm_id']; ?>">
                        <i class="nc-icon nc-button-power"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-icon btn-round">
                            <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
                            <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
                        </button>
                    </div>
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="mdashboard">Admin Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link btn-magnify" href="mcustomers">
                                <i class="nc-icon nc-layout-11"></i>
                                <p>view all customer</p>
                            </a>
                        </li>
                        <li class="nav-item btn-magnify dropdown">
                            <a class="nav-link dropdown-toggle" style="text-transform: capitalize" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['admin_login']['adm_name']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item  remove-nav-bg" href="logout/true">
                                    <span class="text-warning"><i class="nc-icon nc-settings-gear-65">&nbsp;&nbsp;</i>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>