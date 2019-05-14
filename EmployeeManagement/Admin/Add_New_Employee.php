<?php
    require_once('headers/EmployeeManagementHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8082/EmployeeManagement/login.php");
    }
?>

            
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>New Employee Information:</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" accept-charset="UTF-8">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="NAME_INPUT" name="NAME_INPUT" placeholder="Nguyen Minh Khoi" class="form-control" value = "">
                                                    <small class="form-text text-muted">Please enter username</small>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Role</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="ROLE" id="ROLE" class="form-control" value="">
                                                        <option value="0">Please select</option>
                                                        <option value="Bartender">Bartender</option>
                                                        <option value="Security">Security</option>
                                                        <option value="Waiter">Waiter</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Labor">Labor</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                
                                                <div class="col col-md-3">
                                                    <label for="DOB-input" class=" form-control-label">DOB</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="date" id="DOB_INPUT" name="DOB_INPUT" placeholder="dd/mm/yyyy" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your Date Of Birth</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Identify_Card_Number-input" class=" form-control-label">Identify Card Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="IDENTIFY_CARD_NUMBER_INPUT" name="IDENTIFY_CARD_NUMBER_INPUT" placeholder="Identify Card Number" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your Identify Card Number</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Gender</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="gender_select" id="gender" class="form-control">
                                                        <option value="0">Please select</option>
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ" >Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Phone-input" class=" form-control-label">Phone Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="PHONE_NUMBER_INPUT" name="PHONE_NUMBER_INPUT" placeholder="Phone Number" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your Phone Number</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Country-input" class=" form-control-label">Country</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="COUNTRY_INPUT" name="COUNTRY_INPUT" placeholder="Enter Country" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your Country</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Email Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="EMAIL_INPUT" name="EMAIL_INPUT" placeholder="Enter Email" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your email</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Address-input" class=" form-control-label">Address Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="ADDRESS_INPUT" name="ADDRESS_INPUT" placeholder="Enter Address" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your Address</small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Religion-input" class=" form-control-label">Religion Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="RELIGION_INPUT" name="RELIGION_INPUT" placeholder="Enter Religion" class="form-control" value="">
                                                    <small class="help-block form-text">Please enter your Religion</small>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Add
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                            if(isset($_POST['NAME_INPUT']) && isset($_POST['ROLE']) && isset($_POST['DOB_INPUT']) && isset($_POST['IDENTIFY_CARD_NUMBER_INPUT']) && isset($_POST['COUNTRY_INPUT']) && isset($_POST['gender_select']) && isset($_POST['PHONE_NUMBER_INPUT']) && isset($_POST['EMAIL_INPUT']) && isset($_POST['ADDRESS_INPUT']) && isset($_POST['RELIGION_INPUT'])){
                                $username_input              = $_POST['NAME_INPUT'];
                                $role                        = $_POST['ROLE'];
                                $DOB_input                   = $_POST['DOB_INPUT'];
                                $Identify_Card_Number_input  = $_POST['IDENTIFY_CARD_NUMBER_INPUT'];
                                $Country_input               = $_POST['COUNTRY_INPUT'];
                                $gender_selected             = $_POST['gender_select'];
                                $phone_input                 = $_POST['PHONE_NUMBER_INPUT'];
                                $email_input                 = $_POST['EMAIL_INPUT'];
                                $Address_input               = $_POST['ADDRESS_INPUT'];
                                $Religion_input              = $_POST['RELIGION_INPUT'];
                                
                                // Update Information
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Admin/AddEmployee/");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                            
                               $data = array('EMPLOYEENAME' => $_POST['NAME_INPUT'], 
                                'DOB' => $_POST['DOB_INPUT'], 
                                'IDENTIFYCARDNUMBER'=>$_POST['IDENTIFY_CARD_NUMBER_INPUT'], 
                                'GENDER' => $_POST['gender_select'], 
                                'PHONENUMBER' => $_POST['PHONE_NUMBER_INPUT'], 
                                'COUNTRY' => $_POST['COUNTRY_INPUT'], 
                                'EMAIL' => $_POST['EMAIL_INPUT'], 
                                'ADDRESS' => $_POST['ADDRESS_INPUT'], 
                                'RELIGION' =>  $_POST['RELIGION_INPUT'], 
                                'ROLE' => $_POST['ROLE']);

                                //$data = array();
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                $output = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                curl_close($ch);
                               // print_r($data);
                               if($output == 'true'){
                                    header("Location: http://localhost:8082/EmployeeManagement/Admin/EmployeeManagement.php");
                               }

                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
