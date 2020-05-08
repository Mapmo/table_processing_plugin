<?php

include "SimpleXLSX.php";

$uploadedFile = $_FILES["uploadedFile"]["name"];
$splittedFilename = explode(".", $uploadedFile);
$extension = end($splittedFilename);
$newFilename = "temp." . $extension;
$targetDir = "./uploads/";
$targetFile = $targetDir . $newFilename;

move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $targetFile);

if ($xlsx = SimpleXLSX::parse($targetFile)) {
    echo '<table><tbody>';

    foreach ($xlsx->rows() as $r) {
        echo '<tr><td><div contenteditable>' . implode('</div></td><td><div contenteditable>', $r) . '</div></td></tr>';
    }
} else {
    echo SimpleXLSX::parseError();
}
