<?php
define('CHUNK_SIZE', 1024*1024); // Size (in bytes) of tiles chunk

$mimetypes = [
    "xslt" => "text/xsl"
];

// Read a file and display its content chunk by chunk
function readfile_chunked($filename, $retbytes = TRUE) {
    $cnt    = 0;
    $handle = fopen($filename, 'rb');

    if ($handle === false) {
        return false;
    }

    while (!feof($handle)) {
        $buffer = fread($handle, CHUNK_SIZE);
        echo $buffer;
        ob_flush();
        flush();

        if ($retbytes) {
            $cnt += strlen($buffer);
        }
    }

    $status = fclose($handle);

    if ($retbytes && $status) {
        return $cnt;
    }

    return $status;
}

function sanitizeInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input);
    $input = stripslashes($input);

    return $input;
}


session_start();
if(!isset($_GET['export_file_extension']) || !isset($_GET['export_filename']) || !isset($_GET['file_to_save'])) {
    echo "<p>Fill the whole download form.</p>";
    exit;
}



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

//TODO if extension of uploaded file is different from the exported file then use conversion

header('Content-Type: '.$mimetypes[$exportExtension] );
header('Content-Disposition: attachment; filename='.basename($exportFilename . "." .$exportExtension));
readfile_chunked($fileToSave);