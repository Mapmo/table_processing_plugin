<?php
session_start();
if (!isset($_GET['table'])) {
    include "includes/ParseFile.php";
}

echo '<head><script defer src="js/update.js"></script></head>';
echo '<form onsubmit="return check()">';
echo '<label for="table">Choose table to edit :</label>';
echo '<select id="table" name="table">';
foreach (array_keys($_SESSION) as $r) {
    echo '<option value="' . $_SESSION[$r] . '">' . $r . '</option>';
}
echo '</select>';
echo '<input type="submit"/>';
echo '</form>';


if (!isset($_GET['table'])) {
    exit;
}

$uploadedFileName = $_GET['table'];

echo '<form onsubmit="return check()">';
echo '<label for="search">Choose value to search: </label>';
echo '<input type="text" id="search" name="search">';
echo '<input type="text" id="table" name="table" value="' . $uploadedFileName .'" hidden>';
echo '<input type="submit"/>';
echo '</form>';


include "includes/PrintTable.php";
define("SUPPORTED_FILE_EXTENSIONS", ["xlsx"]);

$nameOfTable = pathinfo(explode('-', $uploadedFileName)[1], PATHINFO_FILENAME);

echo '<form action="streamfile.php" onsubmit="return check()">';
echo '<label for="table">Choose a name for the exported file:</label>';
echo '<input type="text" name="file_to_save" value="' . $uploadedFileName . '" hidden>';
echo '<input type="text" name="export_filename" value="' . $nameOfTable . '" required>';
echo '<select id="extension" name="export_file_extension" required>';
foreach (SUPPORTED_FILE_EXTENSIONS as $ext) {
    echo '<option value="' . $ext . '">.' . $ext . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Save as">';
echo '</form>';

exit;
