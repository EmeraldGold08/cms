<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>
<?php Confirm_Login(); ?>


<?php include "include/header.php" ?>
<!--Nav Starts here-->
<?php include "include/nav.php" ?>
<!--Nav Ends here-->

		<!--Start of Main Area-->
		<div class="col-sm-10">
		<br>
			<div><?php echo Message(); echo SuccessMessage(); ?></div>
			<h1>Admin Dashboard</h1>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Post  Title</th>
					<th>Date & Time</th>
					<th>Author</th>
					<th>Category</th>
					<th>Banner</th>
					<th>Comments</th>
					<th>Action</th>
					<th>Details</th>
					
				</tr>
				<?php
				global $DB; 
				$viewquery = "SELECT * FROM admin_panel ORDER by datetime desc";
				$Execute = mysqli_query($DB, $viewquery);
				$SrNo=0;
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					$Datetime=$DataRows['datetime'];
					$Title=$DataRows['title'];
					$Category=$DataRows['category'];
					$Admin=$DataRows['author'];
					$Image=$DataRows['image'];
					$Post=$DataRows['post'];
					$SrNo++;
				
				?>
				<tr>
					<td><?php echo $SrNo; ?></td>
					<td style="color: #5e5eff;"><?php if (strlen($Title)>20) {
						$Title=substr($Title, 0,20). "...";} 
						echo $Title; ?></td>
					<td><?php if (strlen($Datetime)>10) {
						$Datetime=substr($Datetime, 0,10). "...";} 
						echo $Datetime; ?></td>
					<td><?php if (strlen($Admin)>10) {
						$Admin=substr($Admin, 0,10). "...";} 
						echo $Admin; ?></td>
					<td><?php if(strlen($Category)>10) {
						$Category=substr($Category, 0,10). "...";}
						echo $Category; ?></td>
					<td><img src="Images/<?php echo $Image; ?>" width=100px; height=70px;></td>
					<td>
						<?php
						$DB;
						$QueryApproved= "SELECT COUNT(*) FROM comments 
						WHERE admin_panel_id= '$id' AND status='ON'";
						$ExecuteApproved = mysqli_query($DB, $QueryApproved);
						$RowsApproved = mysqli_fetch_array($ExecuteApproved);
						$TotalApproved = array_shift($RowsApproved);
						if ($TotalApproved>0) {
						?>
						<span class="label label-success pull-right"><?php echo $TotalApproved; ?></span>
						<?php } ?>

						<?php
						$DB;
						$QueryDisapproved= "SELECT COUNT(*) FROM comments 
						WHERE admin_panel_id= '$id' AND status='OFF'";
						$ExecuteDisapproved = mysqli_query($DB, $QueryDisapproved);
						$RowsDisapproved = mysqli_fetch_array($ExecuteDisapproved);
						$TotalDisapproved = array_shift($RowsDisapproved);
						if ($TotalDisapproved>0) {
						?>
						<span class="label label-danger"><?php echo $TotalDisapproved; ?></span>
						<?php } ?>
						
					</td>
					
					<td>
					<a href="Edit.php?Edit=<?php echo $id; ?>"><span class="btn btn-info">Edit</span></a>  
					<a href="Delete.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a>
					</td>
					<td><a href="../Fullpost.php?id=<?php echo $id; ?>" target="_blank" >
					<span class="btn btn-success">Live Preview</span></a>
					</td>
				</tr>
			<?php } ?>
			</table>
		</div>		
		</div>
		<!--End of Main Area-->
	
	</div>
	<!--End of Row Area-->
</div>
<!--End of Container Area-->

