<?php
    require_once("../inc/SqlDatabase.php");
  
	$db = new UiDB();
	
	$user_id = $_REQUEST["id"];
    $marks = $_REQUEST["result"];
	

	$result = $db->InsertResult($user_id,$marks);

	echo $result;

?>
