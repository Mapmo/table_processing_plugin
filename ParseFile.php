<?php

include "./includes/SimpleXLSX.php";

// filter empty file names and paths
$files = array_filter($_FILES['upload']['name']);

$total = count($_FILES['upload']['name']);

$targetDir = "./uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

for ($i = 0; $i < $total; $i++) {

    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

    if ($tmpFilePath != "") {
        
        $newFilePath = $targetDir . (microtime(true)) . "-" . $_FILES['upload']['name'][$i];

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {

            if ($xlsx = SimpleXLSX::parse($newFilePath)) {
                echo '<table><tbody>';

                foreach ($xlsx->rows() as $r) {
                    echo '<tr><td><div contenteditable>' . implode('</div></td><td><div contenteditable>', $r) . '</div></td></tr>';
                }
            } else {
                echo SimpleXLSX::parseError();
            }
        }
    }

    echo "------------------------------";
}
