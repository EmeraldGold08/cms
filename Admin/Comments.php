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
			<div><?php echo Message(); echo SuccessMessage(); ?></div>
			<h1>Un-Approved Comments</h1>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Date & Time</th>
					<th>Comment By</th>
					<th>Comments</th>
					<th>Approve</th>
					<th>Action</th>
					<th>Details</th>
				</tr>
				<?php
				global $DB; 
				$viewquery = "SELECT * FROM comments WHERE status='OFF' ORDER by datetime desc ";
				$Execute = mysqli_query($DB, $viewquery);
				$SrNo=0;
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					$CommentDatetime=$DataRows['datetime'];
					$Commentname=$DataRows['name'];
					$Comments=$DataRows['comment'];
					$CommentPostId=$DataRows['admin_panel_id'];
					$SrNo++;
				
				?>
				<tr>
					<td><?php echo htmlentities($SrNo); ?></td>
					<td><?php if (strlen($CommentDatetime)>10) {
						$CommentDatetime=substr($CommentDatetime, 0,10). "...";} 
						echo htmlentities($CommentDatetime); ?></td>
					<td style="color: #5e5eff;"><?php if (strlen($Commentname)>20) {
						$Commentname=substr($Commentname, 0,20). "...";} 
						echo htmlentities($Commentname); ?></td>
					<td><?php if (strlen($Comments)>10) {
						$Comments=substr($Comments, 0,10). "...";} 
						echo htmlentities($Comments); ?></td>
					<td><a href="ApprovedComments.php?id=<?php echo $id; ?>"><span class="btn btn-success">Approve</span></a>  </td>
					<td>
					<a href="DelComment.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a>
					</td>
					<td><a href="Fullpost.php?id=<?php echo $CommentPostId; ?>" target="_blank" >
					<span class="btn btn-primary">Live Preview</span></a></td>
				</tr>
			<?php } ?>
			</table>
		</div>

		<h1>Approved Comments</h1>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
					<th>No</th>
					<th>Date & Time</th>
					<th>Comment By</th>
					<th>Comments</th>
					<th>Approved by</th>
					<th>Dis-Approve</th>
					<th>Action</th>
					<th>Details</th>
				</tr>
				<?php
				global $DB;
				$Admin=$_SESSION['Username']; 
				$viewquery = "SELECT * FROM comments WHERE status='ON' ORDER by datetime desc ";
				$Execute = mysqli_query($DB, $viewquery);
				$SrNo=0;
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					$CommentDatetime=$DataRows['datetime'];
					$Commentname=$DataRows['name'];
					$Comments=$DataRows['comment'];
					$Approvedby=$DataRows['approvedby'];
					$CommentPostId=$DataRows['admin_panel_id'];
					$SrNo++;
				
				?>
				<tr>
					<td><?php echo htmlentities($SrNo); ?></td>
					<td><?php if (strlen($CommentDatetime)>10) {
						$CommentDatetime=substr($CommentDatetime, 0,10). "...";} 
						echo htmlentities($CommentDatetime); ?></td>
					<td style="color: #5e5eff;"><?php if (strlen($Commentname)>20) {
						$Commentname=substr($Commentname, 0,20). "...";} 
						echo htmlentities($Commentname); ?></td>
					<td><?php if (strlen($Comments)>10) {
						$Comments=substr($Comments, 0,10). "...";} 
						echo htmlentities($Comments); ?></td>
					<td><?php echo htmlentities($Approvedby); ?></td>	
					<td><a href="DisapprovedComments.php?id=<?php echo $id; ?>"><span class="btn btn-warning">Dis-Approve</span></a>  </td>
					<td>
					<a href="DelComment.php?Delete=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a>
					</td>
					<td><a href="Fullpost.php?id=<?php echo $CommentPostId; ?>" target="_blank" >
					<span class="btn btn-primary">Live Preview</span></a></td>
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
