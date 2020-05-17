<?php
define('CHUNK_SIZE', 1024*1024); // Size (in bytes) of tiles chunk
$mimetypes = ["xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];

// Read a file and display its content chunk by chunk
function readfile_chunked($filename) {
    $fileHandler = fopen($filename, 'rb');

    if ($fileHandler === false) {
        return false;
    }

    while (!feof($fileHandler)) {
        $buffer = fread($fileHandler, CHUNK_SIZE);
        echo $buffer;
        ob_flush();
        flush();
    }

    return fclose($fileHandler);
}

if(!isset($_GET['export_file_extension']) || !isset($_GET['export_filename']) || !isset($_GET['file_to_save'])) {
    echo "<p>Fill the whole download form.</p>";
    exit;
}


include_once "utils/utils.php";
$fileToSave = sanitizeInput($_GET['file_to_save']);
if(!file_exists($fileToSave)){
    error_log("The file ["."$fileToSave".", which the user wants to save, doesnt exit");
    echo "<p>Problem with the system, Try later</p>";
    exit;
}

$exportExtension = sanitizeInput($_GET['export_file_extension']);
$exportFilename = sanitizeInput($_GET['export_filename']);


if(empty($exportExtension) || empty($exportFilename)){
    echo "<p>Illegal usage of of symbols in the name of export file or it's extension</p>";
    exit;
}

header('Content-Type: '.$mimetypes[$exportExtension] );
header('Content-Disposition: attachment; filename='.basename($exportFilename . "." .$exportExtension));

if(!readfile_chunked($fileToSave)){
    error_log("Problem during streaming file [".$fileToSave."] to the client");
    echo "<p>Problem occurred during the file download. Please try again</p>";
}