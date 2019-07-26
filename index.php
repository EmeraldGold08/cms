<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>

<?php include "include/header_main.php" ?>
<!--Nav Starts here-->
<?php include "include/nav_main.php" ?>
<!--Nav Ends here-->

<!--Main container for the body starts here-->
<div class="container">
	<div class="blog-header">
		<h1>The Complete Reponsive CMS Blog</h1>
		<p class="lead">The complete blog using PHP by Jonathan deGreat</p>
	</div>
		<!--Row for the body starts here-->
		<div class="row">
		<!--Main Blog starts here-->
			<div class="col-sm-8">
			  <?php
			 global $DB;
			 if (isset($_GET["Searchbutton"])) {
			 		$Search = $_GET["Search"];
			 		//Query when search button is active
			 		$viewquery = "SELECT * FROM admin_panel 
			 		WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR  category LIKE '%$Search%' OR post LIKE '%$Search%'";} 
			 		//Query when Category on side area is clicked
			 		elseif (isset($_GET["Category"])) {
			 			$Category = $_GET["Category"];
			 			$viewquery = "SELECT * FROM admin_panel 
			 		WHERE category='$Category' ORDER BY datetime desc";
			 		}
			 		elseif (isset($_GET["Page"])) {
			 			//Query when pagination is set/active i.e. Blog.php?Page=1
			 			$Page = $_GET["Page"];
			 			if ($Page==0 ||$Page < 1) {
			 				$ShowPost=0;
			 			} else {
			 			$ShowPost= ($Page*3)-3;}
			 			$viewquery = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT $ShowPost,3";		
			 		}
			 		else {
			 	//The default query post for blog.php and limit the maximum number of post to 4		
				$viewquery = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0, 3"; }
				$Execute = mysqli_query($DB, $viewquery);
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$PostId=$DataRows['id'];
					$Datetime=$DataRows['datetime'];
					$Category=$DataRows['category'];
					$Admin=$DataRows['author'];
					$Image=$DataRows['image']; 
					$Title=$DataRows['title'];
					$Post=$DataRows['post'];

				?>
			<div class="blogpost thumbnail">
				<img class="img-responsive img-rounded" src="Images/<?php echo $Image; ?>">
				<div class="caption">
				<h1 id="heading"><?php echo htmlentities($Title); ?></h1>
				<p  class="description">Category: <?php echo $Category; ?> | Published on <?php echo $Datetime; ?>
				  | Author: <?php echo $Admin; ?> 
				  <?php
						$DB;
						$Queryapproved= "SELECT COUNT(*) FROM comments 
						WHERE admin_panel_id='$PostId' AND status='ON'";
						$Executeapproved = mysqli_query($DB, $Queryapproved);
						$Rowsapproved = mysqli_fetch_array($Executeapproved);
						$Totalapproved = array_shift($Rowsapproved);
						if ($Totalapproved>0) {
						?>
						<span class="label label-success pull-right">comments:<?php echo $Totalapproved; ?></span>
						<?php } ?>  
				  </p>
					<p class="post">
					<?php 
					if (strlen($Post)>150) {
						$Post=substr($Post, 0,150)."..."; }
					 echo $Post; 
					 ?>
					 </p>
				</div>
				<a href="Fullpost.php?id=<?php echo $PostId; ?>"><span class="btn btn-info">Read more &rsaquo;&rsaquo;</span></a>
				
			</div>
			<hr>
			<?php } ?>
			<!--Navigation for Pagination-->
			<nav>
			 <ul class="pagination pull-left pagination-md">
			 <?php
			 //pagination that displays Previous
			 if (isset($Page)) {
			 	if ($Page>1) {
			 ?>
			 <li><a href="Blog.php?Page=<?php echo $Page-1; ?>">Prev</a></li>
			 <?php } } ?>
			<?php 
			global $DB;
			$QueryPagination="SELECT COUNT(*) FROM admin_panel";
			$ExecutePagination=mysqli_query($DB, $QueryPagination);
			$RowPagination=mysqli_fetch_array($ExecutePagination);
			$TotalPagination=array_shift($RowPagination);
			//echo $TotalPagination;
			$NumberOfPages=$TotalPagination/3;
			$NumberOfPages=ceil($NumberOfPages);
			//echo $NumberOfPages;
			for ($i=1; $i<=$NumberOfPages; $i++) {
			if (isset($Page)) {
				if ($i==$Page) {
			 ?>
			 <li class="active"><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>			 
			 <?php
			} else { ?>
				<li><a href="Blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php 
				}
			}
			 	} 
			 	?>
			 	<?php
			 	//pagination that displays NEXT
			 if (isset($Page)) {
			 	if ($Page+1<=$NumberOfPages) {
			 ?>
			 <li><a href="Blog.php?Page=<?php echo $Page+1; ?>">Next</a></li>
			 <?php } } ?>
			 </ul>
			 </nav>
			</div>
		 <!--Main Blog ends here-->
		 
		 <!--sidebar area starts here-->
			<div class="col-sm-offset-1 col-sm-3">
			<h2>About</h2>
				<p>Perhaps we have a latent tendency to get furious when someone disagrees with us or can relax only when we are working; perhaps we’re tricky about intimacy after sex or clam up in response to bewildering array of problems that emerge when we try to get close to others. We seem normal only to those who don’t know us very well. In a wiser, more self-aware society than our own, a standard question on any early dinner date would be: “And how are you crazy?”</p>
				
				<!--Category panel on side area starts here-->
				<div class="panel panel-primary">
					<div class="panel-heading">
					  <div class="panel-title">Categories</div>
					</div>
					<div class="panel-body">
						<?php
			 global $DB;
				$viewquery = "SELECT * FROM category ORDER BY datetime desc";
				$Execute = mysqli_query($DB, $viewquery);
				
				while ($DataRows=mysqli_fetch_array($Execute)) {
					$id=$DataRows['id'];
					$Category=$DataRows['name'];
					
			?>
				<a href="Blog.php?Category=<?php echo $Category; ?>">
				<span id="heading"><?php echo $Category . "<br>"; ?></span>
				</a>
			<?php } ?>
					</div>
					<div class="panel-footer">
						
					</div>
				</div>
				<!--Category panel on side area ends here-->

				<!--Recent post panel on side area starts here-->
				<div class="panel panel-primary">
					<div class="panel-heading">
					  <div class="panel-title">Recent Post</div>
					</div>
					<div class="panel-body background">
					 <?php
						global $DB;
						$viewquery = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0, 3";
						$Execute = mysqli_query($DB, $viewquery);
						while ($DataRows=mysqli_fetch_array($Execute)) {
						$PostId=$DataRows['id'];
						$Datetime=$DataRows['datetime'];
						$Image=$DataRows['image']; 
						$Title=$DataRows['title'];
						$Post=$DataRows['post'];
						if (strlen($Datetime)>11) {
						$Datetime=substr($Datetime, 0,11); }

					?>
			<div >
				<div>
				<img class="img-responsive img-rounded pull-left" src="Images/<?php echo $Image; ?>" width=70; height=60;>
				<a href="Fullpost.php?id=<?php echo $PostId; ?>">
				<p id="heading" style="margin-left: 80px"><?php echo htmlentities($Title); ?></p>
				</a>
				<p class="description" style="margin-left: 80px"><?php echo htmlentities($Datetime); ?></p><hr>
				</div>
			</div>
			<?php } ?>
					</div>
					<div class="panel-footer"></div>
				</div>
				<!--Recent post panel on side area ends here-->

				
			</div>
		 <!--sidebar area ends here-->
		</div>
		<!--Row for the body ends here-->
</div>
<!--Main container for the ends starts here-->
<?php include "include/footer.php" ?>