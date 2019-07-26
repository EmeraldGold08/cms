<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_Login(); ?>

<?php
if (isset($_POST["Submit"])) {
	$Username=mysqli_real_escape_string($DB, $_POST["Username"]);
	$Password=mysqli_real_escape_string($DB, $_POST["Password"]);
	$Confirmpassword=mysqli_real_escape_string($DB, $_POST["Confirmpassword"]);
	date_default_timezone_set("Africa/Lagos");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
	$DateTime;
	$Admin = $_SESSION['Username'];

	if (empty($Username) || empty($Password) || empty($Confirmpassword)) {
		$_SESSION["ErrorMessage"]="All fields must be filled out";
		Redirect_to("Admins.php");	
	} 
	elseif (strlen($Password)<4) {
		$_SESSION["ErrorMessage"]="Password is too weak";
		Redirect_to("Admins.php");	
	}
	elseif ($Password!==$Confirmpassword) {
		$_SESSION["ErrorMessage"]="Password does not match";
		Redirect_to("Admins.php");	
	}
	else {
		global $DB;
		$Password = md5($Password);
		$Query = "INSERT INTO register_admin(datetime,username,password,addedby)
		VALUE ('$DateTime','$Username','$Password','$Admin')";
		$Execute = mysqli_query($DB, $Query);
		if ($Execute) {
			$_SESSION["SuccessMessage"]="Admin Added Successfully";
			Redirect_to("Admins.php");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, failed to add Admin"; 
			Redirect_to("Admins.php");
		}
	}
}
?>



<?php include "include/header.php" ?>
<!--Nav Starts here-->
<?php include "include/nav.php" ?>
<!--Nav Ends here-->

<!--Start of Main Area-->
		<div class="col-sm-10">
			<h1>Manage Admin Access</h1>

			<!--Error & Successs message starts here-->
			<div><?php echo Message(); 
					   echo SuccessMessage(); 
				 ?>
			</div>
			<!--Error & Successs message ends here-->
			
			<!--Form starts here-->
			<div>
				<form action="Admins.php" method="post">
					<fieldset>
					<div class="form-group">
						<label for="Username">Username:</label>
						<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
					</div>
					<div class="form-group">
						<label for="Password">Password:</label>
						<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
					</div>
					<div class="form-group">
						<label for="Confirmpassword">Confirm Password:</label>
						<input class="form-control" type="Password" name="Confirmpassword" id="Confirmpassword" placeholder="Retype password">
					</div>
					<br>
					<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin">
					</fieldset>
					<br>
				</form>
			</div>
			<!--Form ends here-->

			<!--Table Starts here-->
			<div class="table-responsive">
			<h1>Admin</h1>
				<table class="table table-striped table-hover">
			<br>
		   <tr>
				<th>Sr No.</th>
				<th>Date & Time</th>
				<th>Username</th>
				<th>Password</th>
				<th>Admin Added By</th>
				<th>Delete</th>
		  </tr>
			<?php
			 global $DB;
			 $Admin = "Jonathan deGreat";
				$viewquery = "SELECT * FROM register_admin ORDER BY datetime desc";
				$Execute = mysqli_query($DB, $viewquery);
				$SrNo=0;
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					$DateTime=$DataRows['datetime'];
					$Username=$DataRows['username'];
					$Password=$DataRows['password'];
					$Admin=$DataRows['addedby'];
					$SrNo++;
			?>
			<tr>
				<td><?php echo $SrNo; ?></td>
				<td><?php echo $DateTime; ?></td>
				<td><?php echo $Username; ?></td>
				<td><?php echo $Password; ?></td>
				<td><?php echo $Admin; ?></td>
				<td><a href="DelAdmin.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
			</tr>
			<?php } ?>
		  </table>
		 </div>
		<!--End of Table-->
		
		</div>
		<!--End of Main Area-->
	
	</div>
	<!--End of Row Area-->
</div>
<!--End of Container Area-->
