<?php require_once("DB.php"); ?>
<?php require_once("Sessions.php"); ?>
<?php
//page redirection function
function Redirect_to($New_Location) {
	header("Location:".$New_Location);
		exit;
}
//user login function
function Login_Attempt($Username, $Password) {
	global $DB;
	$Query = "SELECT * FROM register_admin WHERE username='$Username' AND password='$Password'";
	$Execute = mysqli_query($DB, $Query);
	if ($admin=mysqli_fetch_assoc($Execute)) {
		return $admin;
	}else {
		return null;
	}
}

function Login() {
	if (isset($_SESSION["User_Id"])) {
		return true;
	}
}

function Confirm_Login() {
	if (!Login()) {
		$_SESSION["ErrorMessage"]="Login Required";
		Redirect_to("Login.php");
		} 
}
?>