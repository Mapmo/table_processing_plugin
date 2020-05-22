<?php
$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// filter empty file names and paths
$files = array_filter($_FILES['upload']['name']);
$total = count($_FILES['upload']['name']);

for ($i = 0; $i < $total; $i++) {

    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];


    if ($tmpFilePath != "") {
        $fileName = $_FILES['upload']['name'][$i];
        $newFileName = (microtime(true)) . "-" . $fileName;
        $newFilePath = $targetDir . $newFileName;

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $_SESSION[$fileName] = $newFilePath;
        }
    }
}
