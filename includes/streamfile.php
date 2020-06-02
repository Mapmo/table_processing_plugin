<?php

$exporting_configs = parse_ini_file("configs/exporting.ini");

$getExportFileExtension = $_GET['exportFileExtension'];
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

if (!isset($getExportFileExtension) || !isset($getExportFilename) || !isset($getFileToSave)) {
    echo "<p>Fill the whole download form.</p>";
    exit;
}

include_once "utils/utils.php";
$fileToSave = SanitizeInput($getFileToSave);
if (!file_exists($fileToSave)) {
    error_log("The file [" . "$fileToSave" . ", which the user wants to save, doesn't exist");
    echo "<p>Problem with the system, try later</p>";
    exit;
}

$exportExtension = SanitizeInput($getExportFileExtension);
$exportFilename = SanitizeInput($getExportFilename);

if (empty($exportExtension) || empty($exportFilename)) {
    echo "<p>Illegal usage of symbols in the name of export file or its extension</p>";
    exit;
}

header('Content-Type: ' . $exporting_configs["mimetypes"][$exportExtension]);
header('Content-Disposition: attachment; filename=' . basename($exportFilename . "." . $exportExtension));

if (!ReadfileChunked($fileToSave,$exporting_configs["chunk_size"])) {
    error_log("Problem during streaming file [" . $fileToSave . "] to the client");
    echo "<p>Problem occurred during the file download. Please try again</p>";
}
