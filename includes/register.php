<?php
session_start();
include "utils/form_validation.php";

if(ValidateCaptcha() === false) {
       	header('Location: /register.php?warn=captcha');
}

if(ValidatePasswordRetype() === false) {
        header('Location: /register.php?warn=retype');
}

include "db_connection.php";
$db_connection = OpenCon();
$login_query = "INSERT into users (user, password) VALUES ('" . $_POST['user'] . "', '" .  $_POST['pass'] . "')";
$login=mysqli_query($db_connection, $login_query) || die(mysqli_error($db_connection));

CloseCon($db_connection);
?>
<html>
<head></head>
<body>
        <h1>Registration successful</h1>
</body>
</html>
