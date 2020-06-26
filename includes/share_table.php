<?php
session_start();
$userTo = $_POST['userTo'];

if ($_SESSION['user'] === $userTo) {
	header('Location: ../index.php?warn=self_share');
	exit;
}

include("db_connection.php");
$db_connection = OpenCon();

$hash_config = parse_ini_file("../configs/hash.ini");

$user = hash($hash_config['hash_algorithm'], htmlentities($userTo) . $hash_config['username_pepper']);

$login_query = $db_connection->prepare("SELECT user FROM users WHERE user = :user");

$login_query->bindParam(':user', $user);

CloseCon($db_connection);

$result = $login_query->execute() || die("Failed to query from DB!");

if (!$login_query->fetch(PDO::FETCH_ASSOC)) {
	header('Location: ../index.php?warn=unknown');
	exit;
}

$yamlPath = $targetDir = "../users/" . $userTo . "/shared_files.yml";
$name = $_POST['name'];
$owner = $_POST['owner'];
$write = $_POST['write'];

$tableName = pathinfo($name)['filename'];
$pathCoeditors =  "../users/" . $owner . "/coeditors/" . $tableName . ".yml";

include("utils/yaml.php");

$files = YamlParse(file_get_contents($yamlPath));

foreach ($files as $file) {
	if ($file['owner'] === $owner && $file['name'] === $name && $file['write'] === $write) {
		header('Location: ../index.php?warn=shared_file_exists');
		exit;
	}
}

try {
	YamlAppend($yamlPath, $name, $owner, $write);
	YamlAddCoeditor($pathCoeditors, $userTo);
} catch (Exception $e) {
	header('Location: ../index.php?warn=permissions');
	exit;
}

header('Location: ../index.php?ok=share');
