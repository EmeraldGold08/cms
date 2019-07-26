<?php require_once("include/Sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/DB.php"); ?>


<?php
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