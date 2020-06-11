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

if(!$login_query->fetch(PDO::FETCH_ASSOC)) {
	header('Location: ../index.php?warn=unknown');    
	exit;
}

$yamlPath = $targetDir = "../users/" . $userTo . "/shared_files.yml";
$name = $_POST['name'];
$owner = $_POST['owner'];
$write = $_POST['write'];

include("utils/yaml.php");

YamlAppend($yamlPath, $name, $owner, $write);

header('Location: ../index.php?ok=share');
?>
