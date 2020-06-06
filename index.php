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

		<!-- Upload file(s) form -->
		<form action="includes/parse_file.php" enctype="multipart/form-data" method="post">
			<label for="upload">Select files (accepts only Excel 2007+ files):</label>
			<input type="file" id="upload" name="upload[]" accept=".xlsx" multiple="multiple"><br><br>
			<input type="submit">
		</form>

		<h2>Files that you have access to:</h2>	
		<?php 
			$filePath  = 'users/' . $_SESSION['user'] . '/shared_files.yml';
			if (file_exists($filePath)) {
			    $file = file_get_contents('users/' . $_SESSION['user'] . '/shared_files.yml');
			    $parsed = yaml_parse($file);
		?>
		<?php
			    foreach ($parsed as $file) {
		?>
				<form action="visual.php" method="post">
					<input name ="table" value="<?php echo "users/" . $file['owner'] . '/uploads/' . $file['name']; ?>" hidden />
					<?php 
					echo $file['owner'] . ': ' . $file['name'] . ' - ';
						
					switch($file['write']) {
					    case 0:
						 echo "readony";
						break;
					    case 1:
						echo "writeable";
						break;
					    default:
						echo "Corrupted";
						break;
					}?>
					<input type="submit" value="Edit"/>
				</form>
				<br/>
		<?php   
			}
		    } else { ?>
			<h3>You have no uploaded/shared files</h3>
	<?php
 		   } 
	} else { ?>
	<h1>You are currently not logged in the system.</h1>
	<a href="login_form.php">Login</a>
	<a href="register_form.php">Register</a>
	<?php } ?>
</body>

</html>
