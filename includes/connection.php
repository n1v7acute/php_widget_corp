<?php 
	require("constants.php");

	$sql_connect = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	
	if(!$sql_connect)
	{
		die("MySQL connection failed!". mysql_error());	
	}
	
	$sql_select_db = mysql_select_db(DB_NAME, $sql_connect);
	
	if(!$sql_select_db)
	{
		die("MySQL select database failed!" . mysql_error());	
	}
?>