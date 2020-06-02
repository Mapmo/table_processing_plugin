<?php
function OpenCon()
{
<<<<<<< HEAD
	try {
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
		$dbname  = "tables_db";

		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

		return $conn;
	} catch (PDOException $error) {
		die($error->getMessage());
=======
	$db_configs= parse_ini_file("configs/database.ini");

	$conn = new mysqli($db_configs["db_host"], $db_configs["db_user"], $db_configs["dbpass"],$db_configs["db_name"]) ;
	if ($conn -> error)
	{
		die("Connect failed: %s\n". $conn -> error);
>>>>>>> 64dc838... Extract database configs in separate .ini file
	}
}

function CloseCon(&$conn)
{
	$conn = null;
}
<<<<<<< HEAD
=======

?>
>>>>>>> 64dc838... Extract database configs in separate .ini file
