<?php
function OpenCon()
{
	try {

        $db_configs= parse_ini_file("../configs/database.ini");

        $conn = new PDO("mysql:host=".$db_configs['db_host'].";dbname=".$db_configs["db_name"],
            $db_configs["db_user"], $db_configs["db_pass"]);

        return $conn;
	} catch (PDOException $error) {
		die($error->getMessage());
	}
}

function CloseCon(&$conn)
{
	$conn = null;
}
