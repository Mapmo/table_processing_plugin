<?php
session_start();

$targetDir = "../users/" . $_SESSION['user'] . "/uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// filter empty file names and paths
$files = array_filter($_FILES['upload']['name']);
$total = count($_FILES['upload']['name']);

include_once("utils/yaml.php");

for ($i = 0; $i < $total; $i++) {
    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

    if ($tmpFilePath === "") {
        header('Location: ../index.php?warn=no_files_to_upload');
        return;
    }

    #Determine the absolute path to the new name of the uploaded file
    $fileName = $files[$i];
    $newFilePath = $targetDir . $fileName;
    #If the file is already there, this for loop will determine the first suitable name for it
    if (file_exists($newFilePath)) {
        $index = 1;
        do {
            $tmp = $targetDir . '(' . $index++ . ')' . $fileName;
        } while (file_exists($tmp));

        $newFilePath = $tmp;
    }

    include("create_config_subdirectories.php");

    $newFileName = pathinfo(basename($newFilePath), PATHINFO_FILENAME);

    $beautifierPath = $targetDir . '../beautifiers/';
    $cellLockingPath = $targetDir . '../cell_locking/';
    $coeditorsPath = $targetDir . '../coeditors/';

    create_config_subdirectory($beautifierPath, $newFileName, '.json');
    create_config_subdirectory($cellLockingPath, $newFileName, '.json');
    create_config_subdirectory($coeditorsPath, $newFileName, '.yml');

    #Add the information to the shared_files.yaml file
    $yamlPath = $targetDir . '../shared_files.yml';
    $name = basename($newFilePath);
    $owner = $_SESSION['user'];
    $write = 1; #because he is the owner of the file

    try {
        YamlAppend($yamlPath, $name, $owner, $write);
    } catch (Exception $e) {
        header('Location: ../index.php?warn=permissions');
        exit;
    }

    if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
        die("Failed to move the uploaded file to the user's directory");
    }
}
header('Location: ../index.php');
