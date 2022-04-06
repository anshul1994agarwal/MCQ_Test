<?php
    require_once("../inc/SqlDatabase.php");
  
	$db = new UiDB();
	
	$username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
	$password = $_REQUEST["password"];

	$result = $db->UserSignup($username,$email,$password);

	echo $result;

?>
