<!DOCTYPE html>
<html lang="en">
<title>Employee Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="login_Style/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login_Style/css/util.css">
	<link rel="stylesheet" type="text/css" href="login_Style/css/main.css">
	<!--===============================================================================================-->
	<link href="css/theme.css" rel="stylesheet" media="all">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
if(isset($_SESSION["username"]) && isset($_SESSION["role"])){
	if($_SESSION["role"] == '1'){
		header('Location: http://localhost:8082/EmployeeManagement/Admin/Admin_Account.php');
	}
	elseif($_SESSION["role"] == '0'){
		header('Location: http://localhost:8082/EmployeeManagement/Employee/Announcement.php');
	}
}
?>

<body>
<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); ?>
<div class="limiter">
	<div class="container-login100">
		<div class="wrap-login100 p-t-50 p-b-90">
			<form class="login100-form validate-form flex-sb flex-w" method="post">
					<span class="login100-form-title p-b-51">
						Login
					</span>
				<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
					<input class="input100" type="text" name="username" placeholder="Username">
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
					<input class="input100" type="password" name="password" placeholder="Password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn m-t-17">
					<button class="login100-form-btn">
						Login
					</button>
				</div>
			</form>
			<div id="alert-addFail" class="alert alert-danger" style="display: none ; float: center; text-allign:center" >
				<strong> Wrong username or password!!!! Please retype information</strong>
			</div>
		</div>
		<?php
		if (isset($_POST['username']) && isset($_POST['password']))
		{
            
			// Send username/password to Tomcat server for authenticating
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/EmployeesManagement/rest/EmployeesManagement/login/");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded')); // In Java: @Consumes(MediaType.APPLICATION_FORM_URLENCODED)

			//$data = array('username'=>$_POST['username'],'password'=>$_POST['password']);
			$data = array('username'=>$_POST['username'],'password'=>MD5($_POST['username'].$_POST['password']));
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

			$output = curl_exec($ch);
			$info = curl_getinfo($ch);
			curl_close($ch);
			//If the server returns TRUE, then print something
			if($output == "1")
			{
				//session_start();
				$_SESSION["username"]          = $_POST['username']; 
				$_SESSION["password"]          = $_POST['password']; 
				$_SESSION["role"]  = $output;
				header("Location: http://localhost:8082/EmployeeManagement/Admin/Admin_Account.php");
				
			}
			else if($output == "0")
			{
				//session_start();
				$_SESSION["username"]          = $_POST['username'];
				$_SESSION["password"]          = $_POST['password']; 
				$_SESSION["role"]  = $output;
				header("Location: http://localhost:8082/EmployeeManagement/Employee/Announcement.php");
			}
			else if($output == "99"){
				?>
			 		<script>
						document.getElementById('alert-addFail').style.display = 'block';
					</script>
			 	<?php
			}
		}
		?>
	</div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="login_Style/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/bootstrap/js/popper.js"></script>
<script src="login_Style/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/daterangepicker/moment.min.js"></script>
<script src="login_Style/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="login_Style/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script src="login_Style/js/main.js"></script>

</body>
</html>