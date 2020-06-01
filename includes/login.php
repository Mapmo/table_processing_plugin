<?php
session_start();
include "utils/form_validation.php";

if(ValidateCaptcha()  === false) {
	header('Location: /login.php?warn=captcha');
	exit;
}

include "db_connection.php";
$db_connection = OpenCon();

#ADD pepper to the user input and hash it
$user = hash("sha256", $db_connection -> real_escape_string($_POST['user']) . USER_PEPPER);
$password = hash("sha256", $db_connection -> real_escape_string($_POST['pass']) . PASSWORD_PEPPER);

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
