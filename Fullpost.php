<?php require_once("include/DB.php"); ?>
<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php
if (isset($_POST["Submit"])) {
	$Name=mysqli_real_escape_string($DB, $_POST["Name"]);
	$Email=mysqli_real_escape_string($DB, $_POST["Email"]);
	$Comment=mysqli_real_escape_string($DB, $_POST["Comment"]);
	
	date_default_timezone_set("Africa/Lagos");
	$CurrentTime = time();
	$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
	$DateTime;
	$PostIdFromURL=$_GET["id"];
	
	if (empty($Name) || empty($Email) || empty($Comment)) {
		$_SESSION["ErrorMessage"]="All fields are required";
	} 
	elseif (strlen($Comment)>500) {
		$_SESSION["ErrorMessage"]="Only 500 characters are allowed in comment";
	}
	else {
		global $DB;
		$Query = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,admin_panel_id)
		VALUES ('$DateTime','$Name','$Email','$Comment','pending','OFF','$PostIdFromURL')";
		$Execute = mysqli_query($DB, $Query);
		if ($Execute) {
			$_SESSION["SuccessMessage"]="Comment Submitted Successfully";
			Redirect_to("Fullpost.php?id={$PostIdFromURL}");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, Try Again!"; 
			Redirect_to("Fullpost.php?id={$PostIdFromURL}");
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Full Blog Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/publicstyle.css">
	<style type="text/css">	
	.commentblock {
		background-color: #f6f7f9;
	}
	.commentinfo {
		color: #365899;
		font-family: sans-serif;
		font-size: 1.1em;
		font-weight: bold;
		padding-top: 10px;
	}
	</style>
</head>
<body>
<div style="height: 10px; background-color: #27aae1;"></div>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
		<!--toggle navigation for small screen-->
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<a class="navbar-brand" href="blog.php">
				<img style="margin-top: -25px; " src="BlogImage/logo.png" width="87"; height="70";>
			</a>
		</div>
		<div class="collapse navbar-collapse" id="collapse" >
		<ul class="nav navbar navbar-nav">
			<li><a href="#">Home</a></li>
			<li class="active"><a href="blog.php">Blog</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Feature</a></li>
		</ul>
		<form action="blog.php" class="navbar-form navbar-right">
			<div class="form-group">
				<input class="form-control" type="text" placeholder="Search" name="Search">
			</div>
			<button class="btn btn-default" name="Searchbutton">Go</button>
		</form>
		</div>
	</div>
</nav>
<div class="line" style="height: 10px; background-color: #27aae1;"></div>
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
			 		$viewquery = "SELECT * FROM admin_panel 
			 		WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR  category LIKE '%$Search%' OR post LIKE '%$Search%'";} 
			 		else {
			 			$PostIdFromURL=$_GET["id"];
				$viewquery = "SELECT * FROM admin_panel WHERE id='$PostIdFromURL' ORDER BY datetime desc"; }
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
				<p  class="description">Category: <?php echo $Category; ?> | Published on <?php echo $Datetime; ?>  | Author: <?php echo $Admin; ?> </p>
					<p class="post">
					<?php echo  nl2br($Post); ?>
					 </p>
				</div>
				
			</div>
			<hr>
			<?php } ?>
			<h5>Comments</h5>
			<?php
			global $DB;
			$PostIdFromURL=$_GET["id"];
			$ExtractingCommentsQuery="SELECT * FROM comments 
			WHERE admin_panel_id='$PostIdFromURL' AND status='ON' ";
			$Execute = mysqli_query($DB, $ExtractingCommentsQuery);
			while ($DataRows=mysqli_fetch_array($Execute)) {
					$CommentDatetime=$DataRows['datetime'];
					$Commentname=$DataRows['name'];
					$Comments=$DataRows['comment'];
				?>
				
				<div class="commentblock">
					<img style="margin-left: 10px; margin-top: 10px" class="pull-left" src="BlogImage/Profile.png" width=80px; height="80px">
					<p style="margin-left: 100px" class="commentinfo"><?php echo $Commentname; ?></p>
					<p style="margin-left: 100px" class="description"><?php echo $CommentDatetime; ?> </p>
					<p style="margin-left: 100px"><?php echo $Comments ?></p>
				</div>
				<hr>
<?php } ?>			

			<h3>Drop your comments below</h3>
			<!--comment area starts here-->
				<div>
				<form action="Fullpost.php?id=<?php echo $PostIdFromURL; ?>" method="post" enctype="multipart/form-data">
					<fieldset>
					<div class="form-group">
						<label for="name">Name:</label>
						<input class="form-control" type="text" name="Name" id="name" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input class="form-control" type="email" name="Email" id="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="comment">Comment:</label>
						<textarea class="form-control" type="text" name="Comment" id="comment"></textarea>
					</div>
					<br>
					<input class="btn btn-primary" type="Submit" name="Submit" value="Add Comment">
					</fieldset>
					<br>
				</form>
			<!--Error & Successs message starts here-->
			<?php echo Message(); 
				  echo SuccessMessage(); 
				 ?>
			</div>
			<!--comment area Ends here-->
			</div>
		 <!--Main Blog ends here-->

		 <!--sidebar area starts here-->
			<div class="col-sm-offset-1 col-sm-3">
			<h2>Test</h2>
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
<div id="footer">
	<p>All rights reserved | &copy; JO 2019 </p>
</div>
<div style="height: 10px; background-color: #27AAE1;"></div>
</body>
</html>