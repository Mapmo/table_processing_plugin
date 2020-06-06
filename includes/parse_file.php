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
	$i = 1;
	do {
	    $tmp = $targetDir . '(' . $i++ . ')' . $fileName;
	} while(file_exists($tmp));
	
	$newFilePath = $tmp;
    }	

    #Add the information to the shared_files.yaml file
    $yaml_path = $targetDir . '../shared_files.yml';
    $shared = fopen($yaml_path, 'a');
    $name = "- name: " . basename($newFilePath) . "\n";
    $owner = "  owner: " . $_SESSION['user'] . "\n";
    $write = "  write: 1\n\n";

    fwrite($shared, $name);
    fwrite($shared, $owner);
    fwrite($shared, $write);
    fwrite($shared, ""); #for empty line
}

if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
	die("Failed to move the uploaded file to the user's directory");
}

header('Location: ../index.php');
