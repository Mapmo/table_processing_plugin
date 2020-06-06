<?php

$exporting_configs = parse_ini_file("../configs/exporting.ini");

$getExportFilename = $_GET['exportFilename'];
$getFileToSave = '../' . $_GET['fileТoSave'];

// Read a file and display its content chunk by chunk
function ReadfileChunked($filename,$chunk_size)
{
    $fileHandler = fopen($filename, 'rb');

    if (!$fileHandler) {
        return false;
    }

    while (!feof($fileHandler)) {
        $buffer = fread($fileHandler, $chunk_size);
        echo $buffer;
        ob_flush();
        flush();
    }

    return fclose($fileHandler);
}

if (!isset($getExportFilename) || !isset($getFileToSave)) {
    die("<p>Fill the whole download form.</p>");
}

include_once "utils/utils.php";
$fileToSave = SanitizeInput($getFileToSave);

if (!file_exists($fileToSave)) {
    error_log("The file [" . "$fileToSave" . ", which the user wants to save, doesn't exist");
    die("<p>Problem with the system, try later</p>");
}

$exportFilename = SanitizeInput($getExportFilename);

if (empty($exportFilename)) {
    echo "<p>Illegal usage of symbols in the name of export file or its extension</p>";
    exit;
}

header('Content-Type: ' . $exporting_configs["mimetypes"]['xlsx']);
header('Content-Disposition: attachment; filename=' . basename($exportFilename));

if (!ReadfileChunked($fileToSave,$exporting_configs["chunk_size"])) {
    error_log("Problem during streaming file [" . $fileToSave . "] to the client");
    echo "<p>Problem occurred during the file download. Please try again</p>";
}
