<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Schedule</title>

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

</head>
<?php
    require_once('headers/header.php');
?>
<?php
    
?>
<body style="background-color:powderblue;">
    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Please Select:</h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2" style="font-size:1.5em;margin-top: 15px;">
                                            Month:
                                        </div>
                                        <div class="col-md-8">
                                            <select name = "Month_select" style="width: 250px;height:25px;text-align: center;background-color: #F2F2F2;border: 1px solid #E4E4E4;font-family: Arial;font-size:1.2em;margin-top: 20px;">
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
                                   <div class="row">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="col-md-2" style="font-size:1.5em;margin-top: 15px;">
                                            Year:
                                        </div>
                                        <div class="col-md-8">
                                            <select name = "Year_select" style="width: 250px;height:25px;text-align: center;background-color: #F2F2F2;border: 1px solid #E4E4E4;font-family: Arial;font-size:1.2em;margin-top: 20px;">
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer">
                                        <div class = "row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-primary" style="width:12%;margin-top:20px;">
                                                    View
                                                </button>
                                            </div>
                                        </div>
                                    <div>
                                </form>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['Year_select'])){                            
                                $NVID = $_SESSION['username'];
                                $Year = $_POST['Year_select'];
                                $Month = $_POST['Month_select'];

                                header("Location: http://localhost:8082/EmployeeManagement/Employee/Schedule/ViewSchedule.php?employeeid=". $NVID ."&year=". $Year."&month=". $Month);
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

</body>

</html>
