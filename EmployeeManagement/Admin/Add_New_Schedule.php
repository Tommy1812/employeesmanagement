<?php
    require_once('headers/ScheduleHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8082/EmployeeManagement/login.php");
    }
?>

<?php
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/getListEmployeeID/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
    $data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_ID = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $arrID = (array)json_decode($array_ID,true);

    // get year

    // get year
    $ch1 = curl_init();
    curl_setopt($ch1, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/getYear/");
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
    $data = array();
    curl_setopt($ch1, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Year = curl_exec($ch1);
    $info = curl_getinfo($ch1);
    curl_close($ch1);
    $arrYear = (array)json_decode($array_Year,true);
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/getMonth/");
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_POST, 1);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
        $data = array();
        curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($data));        
        $array_Month = curl_exec($ch2);
        $info = curl_getinfo($ch2);
        curl_close($ch2);
        $Month =(array)json_decode($array_Month,true);
?>

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Add Employee Schedule:</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" accept-charset="UTF-8">
  
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Employee ID:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="GV_select" id="GV" class="form-control">
                                                        <option value="0">Please select Account</option>
                                                        <?php
                                                            foreach($arrID as $item){
                                                                ?>
                                                                    <option value="<?= $item?>"><?= $item?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Day:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Day_select" id="Day" class="form-control">
                                                        <option value="0">Please select Day</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Shift:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Shift_select" id="Shift" class="form-control">
                                                        <option value="0">Please select Shift</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="Location_input" class=" form-control-label">Location Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="Location_input" name="Location_input" placeholder="Location" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Month:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Month_Select" id="Month" class="form-control">
                                                        <option value="0">Please select Month</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="select" class=" form-control-label">Year:</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="Year_select" id="Year" class="form-control">
                                                        <option value="0">Please select Year</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-dot-circle-o"></i> Add
                                                </button>
                                            </div>
                                            <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                                <strong> Adding New Schedule Success!</strong>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php

                            if(isset($_POST['GV_select'])  && isset($_POST['Day_select']) && isset($_POST['Shift_select']) && isset($_POST['Location_input']) && isset($_POST['Month_Select']) && isset($_POST['Year_select'])){                            
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Admin/AddSchedule/");
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

                                $data = array('EmployeeID'=>$_POST['GV_select']
                                ,'Day' => $_POST['Day_select']
                                , 'Shift' =>$_POST['Shift_select']
                                , 'Location' => $_POST['Location_input']
                                , 'Month'=>$_POST['Month_Select']
                                , 'Year'=>$_POST['Year_select']);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                $output = curl_exec($ch);
                                $info = curl_getinfo($ch);
                                curl_close($ch);
                                if($output == 'true'){
                                ?>
                                    <script>
                                        document.getElementById('alert-addSuccess').style.display = 'block';
                                    </script>
                                <?php
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
