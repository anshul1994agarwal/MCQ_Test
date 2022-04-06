<?php

	session_start();

	$_SESSION["userIDTesting"] = "";
	$_SESSION["name"] = "";

	header("Location: index.php"); 


	session_destroy();

?>