<?php
$jsonStr = file_get_contents('php://input');
$jsonArr = json_decode($jsonStr, true);
$jsonFileLocation = "../" . $jsonArr["jsonFilePath"];
file_put_contents($jsonFileLocation,  json_encode($jsonArr["content"]));

if(is_writeable($jsonFileLocation) === false) {
    throw new Exception("Error 403, permission to " . $jsonFileLocation. " denied");
}
