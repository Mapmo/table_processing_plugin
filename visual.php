<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_GET['table'])) {
    include "includes/parse_file.php";
}
?>

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <title>Table Processing Plugin</title>
    <script defer src="js/update.js"></script>
</head>

<body>

<!-- Form to choose which table to display -->	
    <form onsubmit="return check()">
        <label for="table">Choose table to edit:</label>
        <select id="table" name="table">
            <?php
            foreach (array_keys($_SESSION) as $r) {
                echo '<option value="' . $_SESSION[$r] . '">' . $r . '</option>';
            }
            ?>
        </select>
        <input type="submit" />
    </form>

<?php

if (!isset($_GET['table'])) {
    exit;
}

$uploadedFileName = $_GET['table'];
?>

<!-- Form to choose a phrase to search for in the table -->	
	<form onsubmit="return check()">
		<label for="search">Choose value to search: </label>
		<input type="text" id="search" name="search"/>
		<input type="text" id="table" name="table" value="<?php echo $uploadedFileName; ?>" hidden/>
		<input type="submit"/>
	</form>

<?php
include "includes/print_table.php";
define("SUPPORTED_FILE_EXTENSIONS", ["xlsx"]);

$nameOfTable = pathinfo(explode('-', $uploadedFileName)[1], PATHINFO_FILENAME);



?>

<!-- Form to chooses how to save the table -->	
    <form action="streamfile.php" onsubmit="return check()">
        <label for="table">Choose a name for the exported file:</label>
        <input type="text" name="fileТoSave" value=<?php echo $uploadedFileName ?> hidden>
        <input type="text" name="exportFilename" value=<?php echo $nameOfTable ?> required>
        <select id="extension" name="exportFileExtension" required>
            <?php
            foreach (SUPPORTED_FILE_EXTENSIONS as $ext) {
                echo '<option value="' . $ext . '">.' . $ext . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Save as">
    </form>
</body>
</html>

