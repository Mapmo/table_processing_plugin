<?php
$targetDir = "users/" . $_SESSION['user'] . "/uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// filter empty file names and paths
$files = array_filter($_FILES['upload']['name']);
$total = count($_FILES['upload']['name']);

for ($i = 0; $i < $total; $i++) {

    $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

    if ($tmpFilePath !== "") {

        $fileName = $files[$i];
        $newFilePath = $targetDir . $fileName;
	if (file_exists($newFilePath)) {
		$i = 1;
		do {
			$tmp = $newFilePath . '(' . $i++ . ')';
		} while(file_exists($tmp));
		
		$newFilePath = $tmp;
	}

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            $_SESSION[$fileName] = $newFilePath;
        }
    }
}
