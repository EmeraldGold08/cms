<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>


<?php
if (isset($_POST["Submit"])) {
	$Title=mysqli_real_escape_string($DB, $_POST["Title"]);
	$Category=mysqli_real_escape_string($DB, $_POST["Category"]);
	$Post=mysqli_real_escape_string($DB, $_POST["Post"]);
	date_default_timezone_set("Africa/Lagos");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
	$DateTime;
	$Admin = "Jonathan deGreat";
	$Image = $_FILES["Image"]["name"];
	//This is specifying PATH where the images should be saved locally
	$Target = "/Images/".basename($_FILES["Image"]["name"]);
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
		$Delete = $_GET['Delete'];
		$Delete_Query = "DELETE FROM admin_panel
		WHERE id='$Delete'";
		$Execute = mysqli_query($DB, $Delete_Query);
		//The code below helps move the uploaded image into the Image folder created locally
		move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
		if ($Execute) {
			$_SESSION["SuccessMessage"]="Post deleted Successfully";
			Redirect_to("dashboard.php");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, Try Again!"; 
			Redirect_to("dashboard.php");
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
			<h1>Delete Post</h1>

			<!--Error & Successs message starts here-->
			<div><?php echo Message(); 
					   echo SuccessMessage(); 
				 ?>
			</div>
			<!--Error & Successs message ends here-->
			
			<!--Form starts here-->
			<div>
			<?php
			global $DB; 
			$Delete = $_GET['Delete'];
			$Show_Post = "SELECT * FROM admin_panel
			WHERE id='$Delete'";
			$Execute=mysqli_query($DB, $Show_Post);
			while ($DataRows=mysqli_fetch_array($Execute)) { 
			$Title=$DataRows["title"];
			$Category=$DataRows["category"];
			$Admin=$DataRows["author"];
			$Image=$DataRows["image"];
			$post=$DataRows["post"];
}
			?>
				<form action="Delete.php?Delete=<?php echo $Delete; ?>" method="post" enctype="multipart/form-data">
					<fieldset>
					<div class="form-group">
						<label for="title">Title:</label>
						<input value="<?php echo $Title; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
					</div>
					<div class="form-group">
						<span>Current Category: </span>
						<?php echo $Category; ?>
						<br>
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
					<span>Existing Image: </span>
					<img src="Images/<?php echo $Image; ?>" width=100; height=70;>
						<br>
						<label for="imageselect">Select Image:</label>
						<input class="form-control" type="file" name="Image" id="imageselect">
					</div>
					<div class="form-group">
						<label for="postarea">Post:</label>
						<textarea class="form-control" type="text" name="Post" id="postarea"><?php echo $post; ?></textarea>
					</div>
					<br>
					<input class="btn btn-success btn-block" type="Submit" name="Submit" value="Delete Post">
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
