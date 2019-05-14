<?php
    require_once('headers/AnnouncementHeader.php');
?>

<?php
    if(!isset($_SESSION["username"])){
        header("Location: http://localhost:8082/EmployeeManagement/login.php");
    }
    if(isset($_GET["title"])){
        $title       = $_GET["title"];
    }
?>
<?php           
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/ViewAnnouncement/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)
    $data = array('TITLE'=>$title);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $array_Announcement = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $announcement = (array)json_decode($array_Announcement);
?>


            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="top-campaign">
                                    <h3 class="title-3 m-b-30" style="text-align:center"><?= $announcement['title']?></h3>
                                    <h3 class="title-3 m-b-30" style="text-align:center"></h3>
                                    <div class="table-responsive">
                                        <table class="table table-top-campaign">
                                            <tbody>
                                                <tr>
                                                    <td>Uploaded By: <?= $announcement['idadmin']?></td>
                                                    <td>Datepost: <?= substr($announcement['datepost'], 0, 10) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h4 style="border-style: groove; margin:auto"><?= $announcement['content']?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!--END PAGE CONTAINER-->
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
