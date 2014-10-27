<?php
	session_start();
	if (isset($_SESSION["LOGIN_PHP"])){
		unset($_SESSION["LOGIN_PHP"]);	
	}
	header("Location:login.php");
?>