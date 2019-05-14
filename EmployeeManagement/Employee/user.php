<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Employee</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8082/EmployeeManagement/login.php");
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/Teacher/ViewEmployeeInfomation/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    $data = array('username'=>$_SESSION['username']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $result = (array) json_decode($output);
    // User information
    $name                           = $result['name'];
    $DOB                            = $result['DOB'];
    $identifycardnumber             = $result['identifycardnumber'];
    $gender                         = $result['gender'];
    $phonenumber                    = $result['phonenumber'];
    $country                        = $result['country'];
    $email                          = $result['email'];
    $address                        = $result['address'];
    $religion                       = $result['religion'];
    $subjectname                    = $result['subjectname'];
    $_SESSION['adminname']          = $name;
?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                       
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo $_SESSION['username']?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="http://localhost:8082/EmployeeManagement/Teacher/TeacherLogout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                    </li>
                    <li>
                        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                    <li>
                        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
                    </li>
                    <li>
                        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
                    </li>
                    <li>
                        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
                    </li>
                    <li>
                        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>ID (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Teacher ID" value="<?php echo $_SESSION["username"]?>">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="text" class="form-control" name = "EMAIL_INPUT" placeholder="quocbao281197@gmail.com" value="<?php echo $email?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="NAME_INPUT" placeholder="Nguyễn Minh Khôi" value="<?php echo $name?>">
                                            </div>
                                        </div>

										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <input type="date" class="form-control" name="DOB_INPUT" placeholder="dd/mm/yyyy" value="<?php echo substr($DOB, 0, 10)?>">
                                            </div>
                                        </div>
                                    </div>

									<div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Identify Card Number</label>
                                                <input type="text" class="form-control" readonly name = "IDENTIFY_CARD_NUMBER_INPUT" placeholder="xxxxxxxxxx" value="<?php echo $identifycardnumber?>">
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select name="GENDER_INPUT" id="GENDER_INPUT" class="form-control" value="$subjectname">
													    <option value="0">Please select</option>
                                                        <option value="Nam" <?php if(strpos($gender, 'Nam') !== false){ echo 'selected ="selected"';} ?>>Nam</option>
                                                        <option value="Nữ" <?php if(strpos($gender, 'Nữ') !== false){ echo 'selected ="selected"';} ?>>Nữ</option>
                                                 </select>
                                                <!-- <input type="text" class="form-control" name="GENDER_INPUT"  placeholder="Nam hoặc nữ" value="<?php echo $gender?>"> -->
                                            </div>
                                        </div>
										
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" name = "PHONE_NUMBER_INPUT" placeholder="xxxxxxxxxx" value="<?php echo $phonenumber?>">
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name = "ADDRESS_INPUT" placeholder="Home Address" value="<?php echo $address?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Religion</label>
                                                <input type="text" class="form-control" name = "RELIGION_INPUT" placeholder="Religion" value="<?php echo $religion?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name = "COUNTRY_INPUT" placeholder="Country" value="<?= $country?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Subject Name: </label>
                                                
                                                <select name="ROLE" id="ROLE" class="form-control" value="$subjectname">
													    <option value="0">Please select</option>
                                                        <option value="Bartender" <?php if(strpos($subjectname, 'Bartender') !== false){ echo 'selected ="selected"';} ?>>Bartender</option>
                                                        <option value="Security" <?php if(strpos($subjectname, 'Security') !== false){ echo 'selected ="selected"';} ?>>Security</option>
                                                        <option value="Waiter" <?php if(strpos($subjectname, 'Waiter') !== false){ echo 'selected ="selected"';} ?>>Waiter</option>
                                                        <option value="Manager" <?php if(strpos($subjectname, 'Manager') !== false){ echo 'selected ="selected"';} ?>>Manager</option>
                                                        <option value="Labor" <?php if(strpos($subjectname, 'Labor') !== false){ echo 'selected ="selected"';} ?>>Labor</option>
                                                 </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>PASSWORD</label>
                                                <input type="text" class="form-control" name = "PASSWORD_INPUT" placeholder="Home Address" value="<?php echo $_SESSION["password"]?>">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                                <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                    <strong>Update Private Information Success!</strong>
                                </div>
                            </div>
                            <?php
                                if(isset($_POST['NAME_INPUT'])  && isset($_POST['DOB_INPUT']) 
                                                                && isset($_POST['IDENTIFY_CARD_NUMBER_INPUT']) 
                                                                && isset($_POST['COUNTRY_INPUT']) 
                                                                && isset($_POST['GENDER_INPUT']) 
                                                                && isset($_POST['PHONE_NUMBER_INPUT']) 
                                                                && isset($_POST['EMAIL_INPUT']) 
                                                                && isset($_POST['ADDRESS_INPUT']) 
                                                                && isset($_POST['RELIGION_INPUT'])
                                                                && isset($_POST['SUBJECT_INPUT'])
                                                                && isset($_POST['PASSWORD_INPUT'])){
                                    $ch = curl_init();
                                    curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
                                    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/Teacher/UpdatePersonalInfomation/");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER , array(
                                        'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
                                    ));
                                    $data = array('ID'=>$_SESSION['username'], 'TEACHERNAME' =>$_POST['NAME_INPUT']
                                                    , 'DOB' => $_POST['DOB_INPUT']
                                                    , 'SUBJECT_NAME' => $_POST['SUBJECT_INPUT']
                                                    , 'GENDER'=> $_POST['GENDER_INPUT']
                                                    , 'PHONENUMBER' => $_POST['PHONE_NUMBER_INPUT']
                                                    , 'COUNTRY' => $_POST['COUNTRY_INPUT']
                                                    , 'EMAIL' => $_POST['EMAIL_INPUT']
                                                    , 'ADDRESS' => $_POST['ADDRESS_INPUT']
                                                    , 'RELIGION' => $_POST['RELIGION_INPUT']
                                                    , 'PASSWORD' => $_POST['PASSWORD_INPUT']);
                                    //$data = array();
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                    $output = curl_exec($ch);
                                    $info = curl_getinfo($ch);
                                    curl_close($ch);
                                    if($output == "true"){
                                        ?>
                                            <script>
                                                document.getElementById('alert-addSuccess').style.display = 'block';
                                            </script>
                                        <?php
                                            unset($_SESSION["password"]);
                                            $_SESSION["password"] = $_POST['PASSWORD_INPUT'];
                                            echo("<meta http-equiv='refresh' content='3'>");
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
