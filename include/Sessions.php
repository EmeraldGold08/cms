<?php
session_start();
function Message() {
	if (isset($_SESSION["ErrorMessage"])) {
		$Output="<div class=\"alert alert-danger\">";
		$Output.= htmlentities($_SESSION["ErrorMessage"]);
		$Output.= "</div>";
		//When a page is loaded for the first time, the session won't be loaded since it has been set to nul
		$_SESSION["ErrorMessage"]=null; 
		return $Output;
	}
}

function SuccessMessage() {
	if (isset($_SESSION["SuccessMessage"])) {
		$Output="<div class=\"alert alert-success\">";
		$Output.= htmlentities($_SESSION["SuccessMessage"]);
		$Output.= "</div>";
		//When a page is loaded for the first time, the session won't be loaded since it has been set to nul
		$_SESSION["SuccessMessage"]=null; 
		return $Output;
	}
}
?>