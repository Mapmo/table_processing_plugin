<?php
	#Removes the lockfile, thus unlocking the file for editting by others
	include("unlock_file.php");

	session_start();
	session_unset();
	session_destroy();
	header('Location: ../');
?>
