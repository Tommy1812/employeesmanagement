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
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Employee Information:</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i><a href="http://localhost:8082/EmployeeManagement/Admin/Add_New_Employee.php" style="color:white;">Add</a></button>
                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        
                                        <!-- <div class="rs-select6--dark rs-select6--sm rs-select6--dark2">
                                                <div class="row form-group">
                                                    <div class="col col-md-4" style="border-style: groove;">
                                                        <label for="file-input" class=" form-control-label" ><p style="margin-top: 5px;margin-left: 15px;color:red">Import CSV:<p></label>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <input type="file" id="file-input" name="file-input" class="form-control-file" value="Import CSV">
                                                </div>
                                            </div>
                                        </div> -->
                                        <form name="uploadfile" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                                            <input type="file" type="file" name="file" id="file"></input>

                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small" name = "submitbtn">Submit</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>EMAIL</th>
                                                <th>SUBJECT</th>
                                                <th>STATUS</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <?php
                                            $ch = curl_init();
                                            curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Admin/GetListEmployee/");
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                                        
                                            //$data = array('username'=>$_SESSION['username']);
                                            $data = array();
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                        
                                            $array_Employee = curl_exec($ch);
                                            $info = curl_getinfo($ch);
                                            curl_close($ch);
                                            $Employee = (array)json_decode($array_Employee,true);
                                        ?>
                                        <?php
                                            foreach($Employee as $t){
                                                ?>
                                                <tbody>
                                                    <tr class="tr-shadow">
                                                        <td>
                                                            <span><?= $t['id']?></span>
                                                        </td>
                                                        <td>
                                                            <span><?= $t['name']?></span>
                                                        </td>
                                                        <td><?= $t['email']?></td>
                                                        <td>
                                                            <span class="block-email"><?= $t['role']?></span>
                                                        </td>
                                                        <td>
                                                            <span class="status--process"><?php 
                                                            if($t['status'] == "1"){
                                                                echo 'Active';
                                                            }
                                                            else{
                                                                echo 'Deactive';
                                                            }
                                                            ?></span>
                                                        </td>
                                                        <td>
                                                            <div class="table-data-feature" style="float:left">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <a href="http://localhost:8082/EmployeeManagement/Admin/Edit_Employee.php?id=<?=$t['id']?>" class="zmdi zmdi-edit"></a>
                                                                </button>
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Set Deactive">
                                                                    <a href="http://localhost:8082/EmployeeManagement/Admin/Delete_Employee.php?id=<?=$t['id']?>" class="zmdi zmdi-delete"></a>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr class="spacer"></tr>
                                                </tbody>
                                                <?php
                                            }
                                        ?>
                                    </table>
                                    <div id="alert-addSuccess" class="alert alert-success" style="display: none ;text-allign:center" >
                                        <strong> Import Success!</strong>
                                    </div>
                                    <div id="alert-addFail" class="alert alert-danger" style="display: none ;text-allign:center" >
                                        <strong> Import Failed!</strong>
                                    </div>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>

                    <?php
                        if ( isset($_POST["submitbtn"]) ) {
                            if ( isset($_FILES["file"])) {
                                    //if there was an error uploading the file
                                if ($_FILES["file"]["error"] > 0) {
                                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                                }
                                else {     						
									$isEcho = 'true';
                                    $data = nl2br(file_get_contents($_FILES["file"]["tmp_name"]));
                                    //echo $data ."<br>";
                                    //echo "Convert -----"."<br>";
                                    $test = substr( $data, strpos($data, "\n")+1 );
									$test = str_replace("<br />","",$test);
                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Admin/ImportCSV/");
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
                                    $data = array('array' => $test);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                    $output = curl_exec($ch);
                                    $info = curl_getinfo($ch);
                                    curl_close($ch);
                                    if($output == "false"){
                                            $isEcho = "false";
                                            ?>
                                                <script>
                                                    document.getElementById('alert-addFail').style.display = 'block';
                                                </script>
                                            <?php
                                                echo("<meta http-equiv='refresh' content='3'>");
                                    }
                                    
                                    //print_r($allData);
                                    if($isEcho == "true"){
                                        ?>
                                            <script>
                                                document.getElementById('alert-addSuccess').style.display = 'block';
                                            </script>
                                        <?php
                                            echo("<meta http-equiv='refresh' content='3'>");
                                    }
                                }
                            } else {
                                    echo "No file selected <br />";
                            }
                        }
                    ?>
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
