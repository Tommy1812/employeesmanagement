<!DOCTYPE html>
<html lang="en">

<head>
<title>My Account </title>
</head>

<?php
    require_once('headers/header.php');
?>
<body style="background-color:powderblue;">

    <div id="wrapper" >

        <div class="content" >
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header" >
                                <h4 class="title" >Edit Profile</font></h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label >ID (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Employee ID" value="<?php echo $_SESSION["username"]?>">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="text" class="form-control" name = "EMAIL_INPUT" placeholder="minhkhoi@gmail.com" value="<?php echo $email?>">
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
                                                <select name="ROLE_INPUT" id="ROLE_INPUT" class="form-control" value="$subjectname">
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
                                                                && isset($_POST['ROLE_INPUT'])
                                                                && isset($_POST['PASSWORD_INPUT'])){
                                    $ch = curl_init();
                                    curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
                                    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/UpdatePersonalInfomation/");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER , array(
                                        'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
                                    ));
                                    $data = array('ID'=>$_SESSION['username']
                                                    , 'EMPLOYEENAME' =>$_POST['NAME_INPUT']
                                                    , 'DOB' => $_POST['DOB_INPUT']
                                                    , 'ROLE_INPUT' => $_POST['ROLE_INPUT']
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

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
