<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<?php
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$DB;
	$Admin = $_SESSION['Username'];
	$Query = "UPDATE comments SET status='ON', approvedby='$Admin' WHERE id='$IdFromURL'";
	$Execute = mysqli_query($DB, $Query);
	if ($Execute) {
			$_SESSION["SuccessMessage"]="Comment Approved Successfully";
			Redirect_to("Comments.php");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, Try Again!"; 
			Redirect_to("Comments.php");
		}
}
?>
