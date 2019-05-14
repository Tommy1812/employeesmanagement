<!DOCTYPE html>
<html lang="en">

<head>
<title>Salary </title>
</head>

<?php
    require_once('headers/header.php');
?>
<body style="background-color:powderblue;">
<?php
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/ViewSalary/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    $data = array('ID'=>$_SESSION['username']);
    //$data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Salary = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    //echo $array_Announcement;
    $test = (array)json_decode($array_Salary,true);
    //print_r($test);
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header" style="border-bottom: margin:auto; padding-bottom: 7px;">
                                <h4 class="title" style="text-align:center; color:powderblue;font-size:2em">Salary Table</h4>
                            </div>
                            <div class="content">
                                <div class = "row">
                                    <div class = "col-md-4" style="text-align:center; padding-bottom: 5px;font-size:1.5em">Month</div>
                                    <div class = "col-md-4" style="text-align:center; padding-bottom: 5px;font-size:1.5em">Year</div>
                                    <div class = "col-md-4" style="text-align:center; padding-bottom: 5px;font-size:1.5em">Salary</div>
                                </div>
                                <hr>
                                <?php
                                    foreach($test as $a){
                                    ?> 
                                    <div class="row">
                                        <div class = "col-md-4" style="text-align:center; padding-bottom: 5px;"><?= $a['month']?></div>
                                        <div class = "col-md-4" style="text-align:center; padding-bottom: 5px;"><?= $a['year']?></div>
                                        <div class = "col-md-4" style="text-align:center; padding-bottom: 5px;"><?= $a['total']?></div>
                                    </div>
                                    <hr>
                                    <?php
                                    }
                                ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
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
