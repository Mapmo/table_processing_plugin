<!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<title>Table Processing Plugin</title>
</head>

<body>
	<?php
		//The following block will clear all files from the previous session and the session itself
		session_start();
		foreach (array_keys($_SESSION) as $r) {
                                unlink($_SESSION[$r]);
                }

		session_unset();
		session_destroy();
	?>
    	<form action="visual.php" enctype="multipart/form-data" method="post">
		<label for="upload">Select files (accepts only Excel 2007+ files):</label>
		<input type="file" id="upload" name="upload[]" accept=".xlsx" multiple="multiple"><br><br>
		<input type="submit">
    	</form>
</body>

</html>
