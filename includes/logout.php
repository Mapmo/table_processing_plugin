<?php
	#Removes the lockfile, thus unlocking the file for editting by others
	if(isset($_POST['lock']) && $_POST['lock'] !== ".lock") {
		unlink('../' . $_POST['lock']);
	}

	session_start();
	session_unset();
	session_destroy();
	header('Location: ../');
?>
