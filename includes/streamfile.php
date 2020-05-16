<?php
define('CHUNK_SIZE', 1024*1024); // Size (in bytes) of tiles chunk

$mimetypes = [
    ".xslt" => "text/xsl"
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

$fileToSave = $_GET['file_to_save'];
if(!file_exists($fileToSave)){
   http_response_code(400);
   exit;
}

$exportExtension = $_GET['export_file_extension'];
$exportFilename = $_GET['export_filename'];

//TODO if extension of uploaded file is different from the exported file then use conversion

header('Content-Type: '.$mimetypes[$exportExtension] );
header('Content-Disposition: attachment; filename='.basename($exportFilename . "." .$exportExtension));
readfile_chunked($fileToSave);
?>