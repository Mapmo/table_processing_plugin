<?php
require __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function toAlpha($num){
    return chr(substr("000".($num+65),-3));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cntCol = $_POST["cntcol"];
    $cntRow = $_POST["cntrow"];
    $pathToTable = $_POST["pathToTable"];

    $spreadsheet = IOFactory::load("example.xlsx");
    $worksheet = $spreadsheet->getActiveSheet();

    for ($i = 1; $i <= $cntRow; $i++) {
        for ($j = 1; $j <= $cntCol; $j++) {
            $worksheet->getCell(toAlpha($j - 1) . $i)->setValue($_POST[$i . "|" . $j]);
        }
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save($pathToTable);
    exit;
}