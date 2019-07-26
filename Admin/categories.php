<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<?php
if (isset($_POST["Submit"])) {
	$Category=mysqli_real_escape_string($DB, $_POST["Category"]);
	date_default_timezone_set("Africa/Lagos");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
	$DateTime;
	$Admin = $_SESSION['Username'];
	if (strlen($Category)>99) {
		$_SESSION["ErrorMessage"]="Name is too long for Category";
		Redirect_to("categories.php");	
	} 
	elseif (empty($Category)) {
		$_SESSION["ErrorMessage"]="All fields must be filled out";
		Redirect_to("categories.php");	
	}
	else {
		global $DB;
		$Query = "INSERT INTO category(datetime,name,creatorname)
		VALUE ('$DateTime','$Category','$Admin')";
		$Execute = mysqli_query($DB, $Query);
		if ($Execute) {
			$_SESSION["SuccessMessage"]="Category Added Successfully";
			Redirect_to("categories.php");		
		} else {
			$_SESSION["ErrorMessage"]="Category failed to Add"; 
			Redirect_to("categories.php");
		}
	}
}
//PHP CODE TO DELETE CATEGORY
if (isset($_GET["Delete"])) {
	$IdFromURL=$_GET["Delete"];
	$DB;
	$Query = "DELETE FROM category WHERE id='$IdFromURL'";
	$Execute = mysqli_query($DB, $Query);
	if ($Execute) {
			$_SESSION["SuccessMessage"]="Category deleted Successfully";
			Redirect_to("categories.php");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, Try Again!"; 
			Redirect_to("categories.php");
		}
}
?>



<?php include "include/header.php" ?>
<!--Nav Starts here-->
<?php include "include/nav.php" ?>
<!--Nav Ends here-->

<!--Start of Main Area-->
		<div class="col-sm-10">
		<br>
		<!--Error & Successs message starts here-->
			<div><?php echo Message(); 
					   echo SuccessMessage(); 
				 ?>
			</div>
			<!--Error & Successs message ends here-->
			<div class="col-sm-5">
			<h1>Manage Categories</h1>
			
			<!--Form starts here-->
			<div>
				<form action="categories.php" method="post">
					<fieldset>
					<div class="form-group">
						<label for="categoryname">Add Category:</label>
						<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Category Name">
					</div>
					<br>
					<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">
					</fieldset>
					<br>
				</form>
			</div>
			<!--Form ends here-->
			</div>
			<!--Table Starts here-->
			<div class="table-responsive">
			<h1>Categories</h1>
				<table class="table table-striped table-hover">
			<br>
		   <tr>
				<th>Id</th>
				
				<th>Category Name</th>
				<!--<th>Category Added By</th>-->
				<th>Update</th>
				<th>Delete</th>
		  </tr>
			<?php
			 global $DB;
				$viewquery = "SELECT * FROM category ORDER BY datetime desc";
				$Execute = mysqli_query($DB, $viewquery);
				$SrNo=0;
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					
					$Category=$DataRows['name'];
					//$Admin=$DataRows['creatorname'];
					$SrNo++;
			?>


			<tr>
				<td><?php echo $SrNo; ?></td>
				
				<td><?php echo $Category; ?></td>
				<!--<td><?php echo $Admin; ?></td>-->
				<td>Update</td>
				<td><a href="categories.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
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
