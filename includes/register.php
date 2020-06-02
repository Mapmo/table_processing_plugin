<?php
session_start();
include "utils/form_validation.php";
include "utils/utils.php";

#Validates that the user successfully entered the captcha
if (ValidateCaptcha() === false) {
	header('Location: /register.php?warn=captcha');
	exit;
}

#Validates that the user successfully entered the password twice
if (ValidatePasswordRetype() === false) {
	header('Location: /register.php?warn=retype');
	exit;
}

include "db_connection.php";
$db_connection = OpenCon();

$hash_config= parse_ini_file("configs/hash.ini");

$user = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['user']) . $hash_config['username_paper']);
$password = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['pass']) . $hash_config['password_paper']);

$get_id_query = $db_connection->prepare("SELECT id FROM users WHERE user = :user");

$get_id_query->bindParam(':user', $user);

$result = $get_id_query->execute() or die("Failed to query from DB!");

#Validation that the name is not already taken
$get_id = $get_id_query->fetch(PDO::FETCH_ASSOC);

if ($get_id) {
	CloseCon($db_connection);
	header('Location: ../register.php?warn=taken');
	exit;
}

#the registration itself
$register_query = $db_connection->prepare("INSERT into users (user, password) VALUES (:user, :password)");

$register_query->bindParam(':user', $user);
$register_query->bindParam(':password', $password);

$register = $register_query->execute();

if (!$register) {
	CloseCon($db_connection);
	die("Failed to query from DB!");
}

$result = $get_id_query->execute() or die("Failed to query from DB!");

$get_id = $get_id_query->fetch(PDO::FETCH_ASSOC);

if (!$get_id) {
	CloseCon($db_connection);
	die("Error!");
}

$id = $get_id['id'];

#creates the home directory of the user

$skel = "../users/0";
$home = "../users/" . $id;

RecursiveCopy($skel, $home);

CloseCon($db_connection);
?>
<html>

<head>
	<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<h1 class="ok">Registration successful</h1>
	<a href="./login.php">Login to your account</a>
</body>

</html>