<!doctype html>
<html lang="vi" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	  
	<!-- Bootstrap CSS-->
	<link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
	<title>Schedule</title>
	<base target="_blank">
</head>
<?php
	ob_start();
	session_start();
	$username = $_SESSION["username"];
	if(isset($_GET["employeeid"])){
		$employeeid       = $_GET["employeeid"];
	}

	if(isset($_GET["employeeid"])){
		$year       = $_GET["year"];
	}
    
    if(isset($_GET["employeeid"])){
		$month       = $_GET["month"];
	}
?>

<?php                                     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/viewSchedule/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

	$data = array('employeeid'=>$employeeid,'day'=>2,'year'=>$year,'month'=>$month);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	$array_Monday_Schedule = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	$Monday = (array)json_decode($array_Monday_Schedule,true);                           
?>

<?php                                     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/viewSchedule/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

	$data = array('employeeid'=>$employeeid,'day'=>3,'year'=>$year,'month'=>$month);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	$array_Tueday_Schedule = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	$Tueday = (array)json_decode($array_Tueday_Schedule,true);                           
?>

<?php                                     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/viewSchedule/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

	$data = array('employeeid'=>$employeeid,'day'=>4,'year'=>$year,'month'=>$month);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	$array_Wednesday_Schedule = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	$Wednesday = (array)json_decode($array_Wednesday_Schedule,true);                           
?>

<?php                                     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/viewSchedule/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

	$data = array('employeeid'=>$employeeid,'day'=>5,'year'=>$year,'month'=>$month);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	$array_Thursday_Schedule = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	$Thursday = (array)json_decode($array_Thursday_Schedule,true);                           
?>

<?php                                     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/viewSchedule/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

	$data = array('employeeid'=>$employeeid,'day'=>6,'year'=>$year,'month'=>$month);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	$array_Friday_Schedule = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	$Friday = (array)json_decode($array_Friday_Schedule,true);                           
?>

<?php                                     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/Employee/viewSchedule/");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

	$data = array('employeeid'=>$employeeid,'day'=>7,'year'=>$year,'month'=>$month);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

	$array_Saturday_Schedule = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	$Saturday = (array)json_decode($array_Saturday_Schedule,true);                           
?>
<body>
	<div class="container">
		<div class="row" style="background-color:#f2f2f4; width:140px; margin:5px;">

			<div class = "col-md-4" >
				<b>Employee ID:</b> <?php echo $employeeid ;?>
			</div>
			<br>
            <div class = "col-md-4">
			<strong>Month:</strong> <?php echo $month ;?>
			</div>
			<br>
			<div class = "col-md-4">
			<strong>Year:</strong> <?php echo $year ;?>
			</div>
            
			<br>
		</div>

	</div>
<div style="text-align: center; font-size:70px; color:#8c42f4;"><h1>SCHEDULE</h1></div>
<div class="cd-schedule loading">
	<div class="timeline">
		<ul>
			<li><span>07:00</span></li>
			<li><span>07:30</span></li>
			<li><span>08:00</span></li>
			<li><span>08:30</span></li>
			<li><span>09:00</span></li>
			<li><span>09:30</span></li>
			<li><span>10:00</span></li>
			<li><span>10:30</span></li>
			<li><span>11:00</span></li>
			<li><span>11:30</span></li>
			<li><span>12:00</span></li>
			<li><span>12:30</span></li>
			<li><span>13:00</span></li>
			<li><span>13:30</span></li>
			<li><span>14:00</span></li>
			<li><span>14:30</span></li>
			<li><span>15:00</span></li>
			<li><span>15:30</span></li>
			<li><span>16:00</span></li>
			<li><span>16:30</span></li>
			<li><span>17:00</span></li>
			<li><span>17:30</span></li>
			<li><span>18:00</span></li>
		</ul>
	</div> <!-- .timeline -->

	<div class="events">
		<ul>
			<li class="events-group">
				<div class="top-info" style ="background-color: lightblue;"><span>Monday</span></div>
				<ul>
					<?php
						foreach($Monday as $D){
							$timeStart = $D['timeStart'];
							$timeEnd = $D['timeEnd'];
							$location = $D['location'];
					?>
						<li class="single-event" data-start= "<?php echo $timeStart?>" data-end= "<?php echo $timeEnd?>"  data-content="event-yoga-1" data-event="event-1">
							<a href="#0">
								<em class="event-name">Location: <?php echo $location?></em>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style ="background-color: coral;"><span>Tuesday</span></div>

				<ul>
					<?php
						foreach($Tueday as $D){
							$timeStart = $D['timeStart'];
							$timeEnd = $D['timeEnd'];
							$location = $D['location'];
					?>
						<li class="single-event" data-start= "<?php echo $timeStart?>" data-end= "<?php echo $timeEnd?>"  data-content="event-restorative-yoga" data-event="event-2">
							<a href="#0">
								<em class="event-name">Location: <?php echo $location?></em>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style ="background-color: #92a8d1;"><span>Wednesday</span></div>

				<ul>
					<?php
						foreach($Wednesday as $D){
							$timeStart = $D['timeStart'];
							$timeEnd = $D['timeEnd'];
							$location = $D['location'];
					?>
						<li class="single-event" data-start= "<?php echo $timeStart?>" data-end= "<?php echo $timeEnd?>"  data-content="event-rowing-workout" data-event="event-3">
							<a href="#0">
								<em class="event-name">Location: <?php echo $location?></em>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style ="background-color: rgb(201, 76, 76);"><span>Thursday</span></div>

				<ul>
					<?php
						foreach($Thursday as $D){
							$timeStart = $D['timeStart'];
							$timeEnd = $D['timeEnd'];
							$location = $D['location'];
					?>
						<li class="single-event" data-start= "<?php echo $timeStart?>" data-end= "<?php echo $timeEnd?>"  data-content="event-abs-circuit" data-event="event-1">
							<a href="#0">
								<em class="event-name">Location: <?php echo $location?></em>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style ="background-color: rgba(201, 76, 76, 0.3);"><span>Friday</span></div>

				<ul>
					<?php
						foreach($Friday as $D){
							$timeStart = $D['timeStart'];
							$timeEnd = $D['timeEnd'];
							$location = $D['location'];
					?>
						<li class="single-event" data-start= "<?php echo $timeStart?>" data-end= "<?php echo $timeEnd?>"  data-content="event-yoga-1" data-event="event-2">
							<a href="#0">
								<em class="event-name">Location: <?php echo $location?></em>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info" style ="background-color: hsl(89, 43%, 51%);"><span>Saturday</span></div>

				<ul>
					<?php
						foreach($Saturday as $D){
							$timeStart = $D['timeStart'];
							$timeEnd = $D['timeEnd'];
							$location = $D['location'];
					?>
						<li class="single-event" data-start= "<?php echo $timeStart?>" data-end= "<?php echo $timeEnd?>"  data-content="event-yoga-1" data-event="event-2">
							<a href="#0">
								<em class="event-name">Location: <?php echo $location?></em>
							</a>
						</li>
					<?php
						}
					?>
				</ul>
			</li>
		</ul>
	</div>

	<div class="event-modal">
		<header class="header">
			<div class="content">
				<span class="event-date"></span>
				<h3 class="event-name"></h3>
			</div>

			<div class="header-bg"></div>
		</header>

		<div class="body">
			<div class="event-info"></div>
			<div class="body-bg"></div>
		</div>

		<a href="#0" class="close">Close</a>
	</div>

	<div class="cover-layer"></div>
</div> <!-- .cd-schedule -->
<script src="js/modernizr.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script>
	if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>