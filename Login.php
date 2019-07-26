<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if (isset($_POST["Submit"])) {
	$Username=mysqli_real_escape_string($DB, $_POST["Username"]);
	$Password=mysqli_real_escape_string($DB, $_POST["Password"]);	
	if (empty($Username) || empty($Password)) {
		$_SESSION["ErrorMessage"]="All fields must be filled out";
		Redirect_to("Login.php");	
	} 
	else {
		$Found_account=Login_Attempt($Username, $Password);
		$_SESSION["Username"]=$Found_account['username'];
		$_SESSION["User_Id"]=$Found_account['id'];
		if ($Found_account) {
			$_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]} !";
			Redirect_to("Admin/dashboard.php");
		} else {
			$_SESSION["ErrorMessage"]="Invalid Username/password combination"; 
			Redirect_to("Login.php");
		}
		}
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Admins</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/adminstyle.css">
	<style type="text/css">
	body {
		background-color: #fff;
	}

	.border {border: 3px solid #f1f1f1;
		padding-left:20px;
		padding-right:20px;
		}
	
	.imgcontainer {
		text-align: center;
		margin: 24px 0 12px 0;
	}

	img.img {
		width: 40%;
		border-radius: 50%;
	}
	</style>
</head>
<body>
<div style="height: 10px; background-color: #27aae1;"></div>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
		<!--toggle navigation for small screen-->
		
			<a class="navbar-brand" href="blog.php">
				<img style="margin-top: -25px; " src="BlogImage/logo.png" width="87"; height="70";>
			</a>
		</div>
	</div>
</nav>
<div class="line" style="height: 10px; background-color: #27aae1;"></div>

<!--Start of Container Area-->
<div class="container-fluid">
	<!--Start of Row Area-->
	<div class="row">
		<!--Start of Main Area-->
		<div class="col-sm-offset-4 col-sm-4">
			<br>		
			<!--Form starts here-->
			<div class="border">
			<br>
			<!--Error & Successs message starts here-->
			<div><?php echo Message(); 
					   echo SuccessMessage(); 
				 ?>
			</div>
			<!--Error & Successs message ends here-->
			<h4 style="text-align: center;">Welcome Back!</h4>	
			<h2 style="text-align: center;">Login</h2>
				<form action="Login.php" method="post">
					<fieldset>
					
					<div class="imgcontainer">
					<img class="img" style="margin-left: 10px; margin-top: 10px"  src="BlogImage/avatar1.png" >
					</div>
					
					<div class="form-group">
						<label for="Username">Username:</label>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-user text-primary"></span>
							</span>
						<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
						</div>
					</div>
					<div class="form-group">
						<label for="Password">Password:</label>
						<div class="input-group">
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-lock text-primary"></span>
							</span>
						<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
						</div>
					</div>
					<br>
					<input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
					</fieldset>
					<br>
				</form>
			</div>
			<!--Form ends here-->
				</div>
		<!--End of Main Area-->
	
	</div>
	<!--End of Row Area-->
</div>
<!--End of Container Area-->
</body>
</html>