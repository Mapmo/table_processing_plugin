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

DEFINE("USER_PEPPER", "jert5-49$3423k,tge?234");
DEFINE("PASSWORD_PEPPER", "m[45=3ojg=*ew3m%34wtAN");
  
?>
