<?php
session_start();
include "utils/form_validation.php";

if(ValidateCaptcha()  === false) {
	header('Location: /login.php?warn=captcha');
	exit;
}

include "db_connection.php";
$db_connection = OpenCon();

$hash_config= parse_ini_file("configs/hash.ini");

#ADD pepper to the user input and hash it
$user = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['user']) . $hash_config['username_paper']);
$password = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['pass']) . $hash_config['password_paper']);

$login_query = "SELECT id FROM users WHERE user='" . $user . "' AND password='" . $password . "'";

$login = mysqli_query($db_connection, $login_query);
if (!$login) {
	CloseCon($db_connection);
        die(mysqli_error($db_connection));
}
if(mysqli_num_rows($login) === 0) {
	CloseCon($db_connection);
        header('Location: /login.php?warn=data');
        exit;
}

#logs the user in the system
$row = mysqli_fetch_row($login);
$_SESSION['user']  = $row[0];

CloseCon($db_connection);
header('Location: /');
?>
