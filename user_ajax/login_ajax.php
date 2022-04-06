<?php
    require_once("../inc/SqlDatabase.php");
  
	$db = new UiDB();
	
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];

	$result = $db->UserLogin($username,$password);

	echo $result;

?>
