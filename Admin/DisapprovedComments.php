<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>

<?php
if (isset($_GET["id"])) {
	$IdFromURL=$_GET["id"];
	$DB;
	$Query = "UPDATE comments SET status='OFF' WHERE id='$IdFromURL'";
	$Execute = mysqli_query($DB, $Query);
	if ($Execute) {
			$_SESSION["SuccessMessage"]="Comment Dis-approved Successfully";
			Redirect_to("Comments.php");		
		} else {
			$_SESSION["ErrorMessage"]="Something went wrong, Try Again!"; 
			Redirect_to("Comments.php");
		}
}
?>
