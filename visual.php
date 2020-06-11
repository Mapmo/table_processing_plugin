<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <title>Table Processing Plugin</title>
<?php
	include "includes/utils/utils.php";
	if($_POST['write'] === "1") { ?>
    	<script defer src="includes/js/update.js"></script>
<?php	
	} ?>
   
<script defer src="includes/js/beautify.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/css/beautify.css">
</head>

<body onload="return getJson()">
    <!-- Logout -->
    <form action="includes/logout.php" onsubmit="return check()">
        <input type="submit" value="Logout">
    </form>

    <!-- Go Back form -->
    <form action="index.php" onsubmit="return check()">
        <input type="submit" value="Back to home">
    </form>

    <?php

    if (!isset($_POST['table'])) {
        exit;
    }
	
    $uploadedFileName = $_POST['table'];
    $lockFile = $uploadedFileName . ".lock";
	$locker = locked();
	if($locker !== $_SESSION['user']) {
		header('Location: /index.php?warn=locked&locker=' . $locker);
		exit;
	}
    ?>

    <!-- Form to choose a phrase to search for in the table -->
    <form onsubmit="return check()" method="post">
        <label for="search">Choose value to search: </label>
        <input type="text" id="search" name="search" value="<?php if (isset($_POST['search'])) {
                                                                echo $_POST['search'];
                                                            } ?>" />
        <input type="text" id="table" name="table" value="<?php echo $uploadedFileName; ?>" hidden />
        <input type="text" name="write" value="<?php echo $_POST['write']; ?>" hidden />
        <input id="searchButton" type="submit" value="Search" />
    </form>

    <br>
    <div>
        <button id="boldButton" onclick="toggleBoldStyle()"><b>B</b></button>
        <button id="italicButton" onclick="toggleItalicStyle()"><i>I</i></button>
        <button id="underlineButton" onclick="toggleUnderlineStyle()"><u>U</u></button>
        <input id="rowToBeautify" type="hidden">
        <input id="colToBeautify" type="hidden">
    </div>

    <?php include "includes/print_table.php"; ?>

    <!-- Form to chooses how to save the table -->
    <form action="includes/streamfile.php" onsubmit="return check()">
        <label for="table">Choose a name for the exported file:</label>
        <input type="text" name="fileТoSave" value="<?php echo $uploadedFileName ?>" hidden />
        <input type="text" name="exportFilename" value="<?php echo basename($uploadedFileName); ?>" required />
        <input type="submit" value="Save as">
    </form>
</body>

</html>
