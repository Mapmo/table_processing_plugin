<?php
session_start();
if (!isset($_GET['table'])) {
    include "includes/parse_file.php";
}

echo '<head><script defer src="js/update.js"></script></head>';
echo '<form onsubmit="return check()">';
echo '<label for="table">Choose table to edit:</label>';
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

include "includes/PrintTable.php";
define("SUPPORTED_FILE_EXTENSIONS", ["xlsx"]);

$uploadedFileName = $_GET['table'];
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
