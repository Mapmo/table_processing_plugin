<!DOCTYPE html>
<html lang="en">

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<title>Table Processing Plugin</title>
    <link rel="stylesheet" href="includes/css/main.css">
</head>

<body>
	<?php
    #Removes the lockfile, thus unlocking the file for editting by others
    include("includes/unlock_file.php");

	session_start();

	#Validation that the user is logged in the system
	if(!isset($_SESSION['user'])) {
		include("includes/not_logged.php");
		exit;
	}
	?>
	<!-- Logout -->
	<form action="includes/logout.php" onsubmit="return check()">
			<input type="submit" value="Logout">
	</form>
	
	<!-- Upload file(s) form -->
	<?php include("includes/upload_file_form.php"); ?>
	
	<h2>Files that you have access to:</h2>	
	
	<!-- The list of accessible files for the user -->
	<?php

	#Warning message when the user attemts to do something wrong
	include("includes/index_warnings.php");
	include("includes/index_ok.php");
	include("includes/utils/yaml.php");
	
	#Figure the location of the shared_files.yml
	$filePath  = 'users/' . $_SESSION['user'] . '/shared_files.yml';
	
	#Validation that the user has his shared_files.yml file
	if (!file_exists($filePath)) {
		die("The file that contains information for you shared files is missing. Contact administrators ASAP");
	}
	$file = file_get_contents('users/' . $_SESSION['user'] . '/shared_files.yml');
	$parsed = YamlParse($file);

	if(empty($parsed)) { ?>
		<h3>You have no uploaded/shared files</h3>
	<?php
	} else {
		foreach ($parsed as $file) {

			#The form with the Edit button
			include("includes/edit_button.php");
	?>
		<!-- The form for sharing a file with other users -->
		<?php include("includes/share_table_form.php"); ?>
	<br/>
	<?php   
		}
	}
	?>

</body>
</html>	
