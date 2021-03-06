<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cntCol = $_POST["cntcol"];
    $cntRow = $_POST["cntrow"];
    $pathToTable = '../' . $_POST["pathToTable"];

    $spreadsheet = IOFactory::load($pathToTable);
    $worksheet = $spreadsheet->getActiveSheet();

    include("utils/utils.php");
    for ($i = 1; $i <= $cntRow; $i++) {
        for ($j = 1; $j <= $cntCol; $j++) {
            $worksheet->getCell(ToAlpha($j - 1) . $i)->setValue($_POST[$i . "|" . $j]);
        }
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save($pathToTable);
    exit;
}
