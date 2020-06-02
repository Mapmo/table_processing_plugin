<?php
function OpenCon()
{
	$db_configs= parse_ini_file("configs/database.ini");

	$conn = new mysqli($db_configs["db_host"], $db_configs["db_user"], $db_configs["dbpass"],$db_configs["db_name"]) ;
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
