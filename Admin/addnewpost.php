<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_Login(); ?>

<?php
if (isset($_POST["Submit"])) {
	$Title=mysqli_real_escape_string($DB, $_POST["Title"]);
	$Category=mysqli_real_escape_string($DB, $_POST["Category"]);
	$Post=mysqli_real_escape_string($DB, $_POST["Post"]);
	date_default_timezone_set("Africa/Lagos");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
	$DateTime;
	$Admin = $_SESSION['Username'];
	$Image = $_FILES["Image"]["name"];
	//This is specifying PATH where the images should be saved locally
	$Target = "Images/".basename($_FILES["Image"]["name"]);
	if (empty($Title)) {
		$_SESSION["ErrorMessage"]="Title field must be filled out";
		Redirect_to("addnewpost.php");	
	} 
	elseif (strlen($Title)<2) {
		$_SESSION["ErrorMessage"]="Title is too short";
		Redirect_to("addnewpost.php");	
	}
	else {
		global $DB;
		$Query = "INSERT INTO admin_panel(datetime,title,category,author,image,post)
		VALUES ('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
		$Execute = mysqli_query($DB, $Query);
		//The code below helps move the uploaded image into the Image folder created locally
		move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
		if ($Execute) {
			$_SESSION["SuccessMessage"]="Post Added Successfully";
			Redirect_to("addnewpost.php");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, Try Again!"; 
			Redirect_to("addnewpost.php");
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
			<h1>Add New Post</h1>

			<!--Error & Successs message starts here-->
			<div><?php echo Message(); 
					   echo SuccessMessage(); 
				 ?>
			</div>
			<!--Error & Successs message ends here-->
			
			<!--Form starts here-->
			<div>
				<form action="addnewpost.php" method="post" enctype="multipart/form-data">
					<fieldset>
					<div class="form-group">
						<label for="title">Title:</label>
						<input class="form-control" type="text" name="Title" id="title" placeholder="Title">
					</div>
					<div class="form-group">
						<label for="categoryselect">Category:</label>
						<select class="form-control" id="categoryselect" name="Category">
							<?php
								 global $DB;
									$viewquery = "SELECT * FROM category ORDER BY datetime desc";
									$Execute = mysqli_query($DB, $viewquery);
									$SrNo=0;
									while ($DataRows=mysqli_fetch_array($Execute)) {
										$id=$DataRows['id'];
										$Category=$DataRows['name'];
								  ?>
								  <option><?php echo $Category; ?></option>
								  <?php } ?>
		  
						</select>
					</div>
					<div class="form-group">
						<label for="imageselect">Select Image:</label>
						<input class="form-control" type="file" name="Image" id="imageselect">
					</div>
					<div class="form-group">
						<label for="postarea">Post:</label>
						<textarea class="form-control" type="text" name="Post" rows="20" id="postarea"></textarea>
					</div>
					<br>
					<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">
					</fieldset>
					<br>
				</form>
			</div>
			<!--Form ends here-->

			<!--Table Starts here-->
			
			<?php
			 global $DB;
				$viewquery = "SELECT * FROM category ORDER BY datetime desc";
				$Execute = mysqli_query($DB, $viewquery);
				$SrNo=0;
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					$DateTime=$DataRows['datetime'];
					$Category=$DataRows['name'];
					$Admin=$DataRows['creatorname'];
					$SrNo++;
			 } 
			  ?>
		  
		<!--End of Table-->
		
		</div>
		<!--End of Main Area-->
	
	</div>
	<!--End of Row Area-->
</div>
<!--End of Container Area-->
