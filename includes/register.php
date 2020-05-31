<?php
session_start();
include "utils/form_validation.php";
include "utils/utils.php";

#Validates that the user successfully entered the captcha
if(ValidateCaptcha() === false) {
       	header('Location: /register.php?warn=captcha');
	exit;
}

#Validates that the user successfully entered the password twice
if(ValidatePasswordRetype() === false) {
        header('Location: /register.php?warn=retype');
	exit;
}

include "db_connection.php";
$db_connection = OpenCon();

#ADD pepper to the user input and hash it
$user = hash("sha256", $db_connection -> real_escape_string($_POST['user']) . USER_PEPPER);
$password = hash("sha256", $db_connection -> real_escape_string($_POST['pass']) . PASSWORD_PEPPER);

$get_id_query = "SELECT id FROM users WHERE user='" . $user . "'";

#Validation that the name is not already taken
$get_id = mysqli_query($db_connection, $get_id_query);
if (!$get_id) {
	die(mysqli_error($db_connection));
}
if(mysqli_num_rows($get_id) > 0) {
	header('Location: /register.php?warn=taken');
	exit;
}

#the registration itself
$register_query = "INSERT into users (user, password) VALUES ('" . $user . "', '" .  $password . "')";
$register = mysqli_query($db_connection, $register_query) || die(mysqli_error($db_connection));

$get_id = mysqli_query($db_connection, $get_id_query);

if (!$get_id) {
        die(mysqli_error($db_connection));
}

#creates the home directory of the user
$row = mysqli_fetch_row($get_id);
$id = $row[0];

$skel="../users/0";
$home="../users/" . $id;

RecursiveCopy($skel, $home);

CloseCon($db_connection);
?>
<html>
<head>
        <link rel="stylesheet" href="css/main.css">
</head>
<body>
        <h1 class="ok">Registration successful</h1>
	<a href="/login.php">Login to your account</a>
</body>
</html>
