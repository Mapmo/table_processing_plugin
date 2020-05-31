<!DOCTYPE html>
<html lang="en">

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<title>Table Processing Plugin</title>
</head>

<body>
	<?php
	session_start();
	if(isset($_SESSION['user'])) { 
	?>
		<!-- Logout -->
    		<form action="includes/logout.php" onsubmit="return check()">
        		<input type="submit" value="Logout">
   		 </form>

		<form action="visual.php" enctype="multipart/form-data" method="post">
			<label for="upload">Select files (accepts only Excel 2007+ files):</label>
			<input type="file" id="upload" name="upload[]" accept=".xlsx" multiple="multiple"><br><br>
			<input type="submit">
		</form>

	<?php } else { ?>
	<h1>You are currently not logged in the system.</h1>
	<a href="login.php">Login</a>
	<a href="register.php">Register</a>
	<?php } ?>
</body>

</html>
