<!DOCTYPE html>
<html lang="en">

<head>
<title>Announcement </title>
</head>

<?php
    require_once('headers/header.php');
?>
<body style="background-color:powderblue;">
<?php
 if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8082/EmployeeManagement/login.php");
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/GetListAnnouncement/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

    //$data = array('username'=>$_SESSION['username']);
    $data = array();
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Announcement = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    //echo $array_Announcement;
    $test = (array)json_decode($array_Announcement,true);
?>
     <div class="content" style ="text-align:center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title" style="text-align:center; color:purple;font-size:2em">Announcement</h4>
                            </div>
                            <div class="content">
                                <div class = "row">
                                    <h4 class = "col-md-6" style="text-align:center font-size:20em"> Date Post</h4>
                                    <h4 class = "col-md-6" style="text-align:center font-size:20em"> Title</h4>
                                </div>
                                <?php
                                    foreach($test as $a){
                                        
                                    ?> 
                                        <div class = "row">
                                            <p class="col-md-6" style ="text-align:center"> <?= substr($a['datepost'], 0, 10);?></p>
                                            <a class="col-md-6" style ="text-align:center;" href="http://localhost:8082/EmployeeManagement/Employee/ViewAnnouncement.php?title=<?=$a['title']?>">
                                                <?= $a['title']?>
                                            </a>
                                        </div>
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
