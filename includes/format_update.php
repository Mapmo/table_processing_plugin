<?php
$jsonStr = file_get_contents('php://input');
$jsonArr = json_decode($jsonStr, true);
$jsonFileLocation = "../" . $jsonArr["jsonFilePath"];
file_put_contents($jsonFileLocation,  json_encode($jsonArr["content"]));
