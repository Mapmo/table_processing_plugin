<?php
session_start();
if (!isset($_GET['table'])) {
    include "includes/ParseFile.php";
}

echo '<form>';
echo '<label for="table">Choose table to edit:</label>';
echo '<select id="table" name="table">';
foreach (array_keys($_SESSION) as $r) {
    echo '<option value="' . $_SESSION[$r] . '">' . $r . '</option>';
}
echo '</select>';
echo '<input type="submit">';
echo '</form>';


if(!isset($_GET['table'])){
    exit;
}
//TODO on every change in table update file locally

include "includes/PrintTable.php";
define("SUPPORTED_FILE_EXTENSIONS",["xslt"]);

echo '<form action="download.php">';
echo '<label for="table">Choose a name for the exported file:</label>';
echo '<input type="text" name="export_filename" required>';
echo '<select id="extension" name="export_file_extension" required>';
foreach (SUPPORTED_FILE_EXTENSIONS as $ext) {
    echo '<option value="' .$ext .'">.'.$ext.'</option>';
}
echo '</select>';
echo '<input type="submit" value="Save as">';
echo '</form>';

exit;



