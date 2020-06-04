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

<<<<<<< HEAD
<<<<<<< HEAD
$user = htmlentities($_POST["user"]);
$password = password_hash(htmlentities($_POST["pass"]), PASSWORD_DEFAULT);
=======
$hash_config= parse_ini_file("configs/hash.ini");

#ADD pepper to the user input and hash it
$user = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['user']) . $hash_config['username_paper']);
$password = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['pass']) . $hash_config['password_paper']);
>>>>>>> 26a8d8a... Extract hash configs in separate .ini file
=======
$hash_config= parse_ini_file("configs/hash.ini");

$user = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['user']) . $hash_config['username_paper']);
$password = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['pass']) . $hash_config['password_paper']);
>>>>>>> a9c2f49... Re-add changes configuration files

$get_id_query = $db_connection->prepare("SELECT id FROM users WHERE user = :user");

$get_id_query->bindParam(':user', $user);

$result = $get_id_query->execute() or die("Failed to query from DB!");

#Validation that the name is not already taken
<<<<<<< HEAD
$get_id = $get_id_query->fetch(PDO::FETCH_ASSOC);

if ($get_id) {
	CloseCon($db_connection);
	header('Location: ../register.php?warn=taken');
=======
$get_id = mysqli_query($db_connection, $get_id_query);
if (!$get_id) {
	CloseCon($db_connection);
	die(mysqli_error($db_connection));
}
if(mysqli_num_rows($get_id) > 0) {
	header('Location: /register.php?warn=taken');
>>>>>>> 92fa741... Add closing of connection to DB after query failure, as Daniel suggested
	exit;
}

#the registration itself
<<<<<<< HEAD
$register_query = $db_connection->prepare("INSERT into users (user, password) VALUES (:user, :password)");

$register_query->bindParam(':user', $user);
$register_query->bindParam(':password', $password);

$register = $register_query->execute();
=======
$register_query = "INSERT into users (user, password) VALUES ('" . $user . "', '" .  $password . "')";
$register = mysqli_query($db_connection, $register_query);

if(!$register) {
	CloseCon($db_connection);
	die(mysqli_error($db_connection));
}
>>>>>>> 92fa741... Add closing of connection to DB after query failure, as Daniel suggested

if (!$register) {
	CloseCon($db_connection);
	die("Failed to query from DB!");
}

$result = $get_id_query->execute() or die("Failed to query from DB!");

$get_id = $get_id_query->fetch(PDO::FETCH_ASSOC);

if (!$get_id) {
	CloseCon($db_connection);
<<<<<<< HEAD
	die("Error!");
=======
        die(mysqli_error($db_connection));
>>>>>>> 92fa741... Add closing of connection to DB after query failure, as Daniel suggested
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