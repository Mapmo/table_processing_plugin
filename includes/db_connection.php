<?php
function OpenCon()
{
	try {
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "1234";
		$dbname  = "tables_db";

		$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

		return $conn;
	} catch (PDOException $error) {
		die($error->getMessage());
	}
}

function CloseCon(&$conn)
{
	$conn = null;
}
