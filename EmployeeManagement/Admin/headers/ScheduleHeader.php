<!DOCTYPE html>
<html lang="vi">
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Schedule</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
	<script type="text/javascript">

        $(document).ready(function () {

        window.setTimeout(function() {
            $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                $(this).remove(); 
            });
        }, 5000);

        });
    </script>
</head>
<?php
    ob_start();
    session_start();
    $username = $_SESSION["username"];

    $adminname = $_SESSION['adminname'];
    $adminemail = $_SESSION['adminemail'];
?>
<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="#">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <a href="http://localhost:8082/EmployeeManagement/Admin/Admin_Account.php">
                                <i class="fas fa-user"></i>My Account</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Announcement</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="http://localhost:8082/EmployeeManagement/Admin/Upload_Announcement.php">Upload new Announcement</a>
                                </li>
                                <li>
                                    <a href="http://localhost:8082/EmployeeManagement/Admin/View_All_Announcement.php">View all Announcement</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href="http://localhost:8082/EmployeeManagement/Admin/Schedule.php">
                                <i class="fas fa-table"></i>Schedule</a>
                        </li>
                        <li>
                            <a href="http://localhost:8082/EmployeeManagement/Admin/EmployeeManagement.php">
                                <i class="fas fa-users"></i>Employee Management</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="CoolAdmin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="http://localhost:8082/EmployeeManagement/Admin/Admin_Account.php">
                                <i class="fas fa-user"></i>My Account</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Announcement</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="http://localhost:8082/EmployeeManagement/Admin/Upload_Announcement.php">Upload new Announcement</a>
                                </li>
                                <li>
                                    <a href="http://localhost:8082/EmployeeManagement/Admin/View_All_Announcement.php">View all Announcement</a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href="http://localhost:8082/EmployeeManagement/Admin/Schedule.php">
                                <i class="fas fa-table"></i>Schedule</a>
                        </li>
                        <li>
                            <a href="http://localhost:8082/EmployeeManagement/Admin/EmployeeManagement.php">
                                <i class="fas fa-users"></i>Employee Management</a>
                        </li>
						<li>
							<a href="http://localhost:8082/EmployeeManagement/Admin/Salary.php">
                                <i class="fas fa-users"></i>Salary</a>
						</li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu" style="float:right">
                                        <div class="image">
                                            <img src="images/icon/Tommy.jpg" alt="Tommy" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $username?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/Tommy.jpg" alt="Tommy" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $adminname?></a>
                                                    </h5>
                                                    <span class="email"><?php echo $adminemail?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="http://localhost:8082/EmployeeManagement/Admin/Admin_Account.php">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="http://localhost:8082/EmployeeManagement/Admin/AdminLogout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->