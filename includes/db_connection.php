<?php
function OpenCon()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1234";
	$db = "tables_db";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) ;
	if ($conn -> error)
	{
		die("Connect failed: %s\n". $conn -> error);
	}
	return $conn;
}
	 
function CloseCon($conn)
{
	$conn -> close();
}
  
?>
