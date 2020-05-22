<?php
define('CHUNK_SIZE', 1024 * 1024); // Size (in bytes) of tiles chunk
$mimetypes = ["xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"];

// Read a file and display its content chunk by chunk
function ReadfileChunked($filename)
{
    $fileHandler = fopen($filename, 'rb');

    if (!$fileHandler) {
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

if (!isset($_GET['exportFileExtension']) || !isset($_GET['exportFilename']) || !isset($_GET['fileToSave'])) {
    echo "<p>Fill the whole download form.</p>";
    exit;
}


include_once "utils/utils.php";
$fileToSave = SanitizeInput($_GET['fileToSave']);
if (!file_exists($fileToSave)) {
    error_log("The file [" . "$fileToSave" . ", which the user wants to save, doesn't exist");
    echo "<p>Problem with the system, try later</p>";
    exit;
}

$exportExtension = SanitizeInput($_GET['exportFileExtension']);
$exportFilename = SanitizeInput($_GET['exportFilename']);


if (empty($exportExtension) || empty($exportFilename)) {
    echo "<p>Illegal usage of symbols in the name of export file or its extension</p>";
    exit;
}

header('Content-Type: ' . $mimetypes[$exportExtension]);
header('Content-Disposition: attachment; filename=' . basename($exportFilename . "." . $exportExtension));

if (!ReadfileChunked($fileToSave)) {
    error_log("Problem during streaming file [" . $fileToSave . "] to the client");
    echo "<p>Problem occurred during the file download. Please try again</p>";
}
