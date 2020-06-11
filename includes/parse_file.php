<?php
session_start();

$targetDir = "../users/" . $_SESSION['user'] . "/uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// filter empty file names and paths
$files = array_filter($_FILES['upload']['name']);
$total = count($_FILES['upload']['name']);

for ($i = 0; $i < $total; $i++) {
    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

    if ($tmpFilePath === "") {
        die("Empty path given");
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

    #Create beautifiers subdirectory of users/$_SESSION['user'] if it doesn't exist
    $beautifierPath = $targetDir . '../beautifiers/';
    if (!file_exists($beautifierPath)) {
        mkdir($beautifierPath, 0777, true);
    }
    #Create beautifier file for the new table in users/$_SESSION['user']/beautifiers directory
    $jsonPath = $beautifierPath . pathinfo(basename($newFilePath), PATHINFO_FILENAME) . '.json';
    $jsonFile = fopen($jsonPath, 'a');

    #Add the information to the shared_files.yaml file

	include("utils/yaml.php");
	
	$yamlPath = $targetDir . '../shared_files.yml';
	$name = basename($newFilePath);
	$owner = $_SESSION['user'];
	$write = 1; #because he is the owner of the file
	YamlAppend($yamlPath, $name, $owner, $write);   
 
    if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
        die("Failed to move the uploaded file to the user's directory");
    }
}
header('Location: ../index.php');
