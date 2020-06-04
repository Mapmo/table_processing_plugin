<?php
session_start();
include "utils/form_validation.php";

if (ValidateCaptcha()  === false) {
        header('Location: ../login.php?warn=captcha');
        exit;
}

include "db_connection.php";
$db_connection = OpenCon();

<<<<<<< HEAD
$user = htmlentities($_POST["user"]);
$password = htmlentities($_POST["pass"]);

$login_query = $db_connection->prepare("SELECT * FROM users WHERE user = :user");

<<<<<<< HEAD
$login_query->bindParam(':user', $user);

$result = $login_query->execute() or die("Failed to query from DB!");
=======
$hash_config= parse_ini_file("configs/hash.ini");

#ADD pepper to the user input and hash it
$user = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['user']) . $hash_config['username_paper']);
$password = hash($hash_config['hash_algorithm'], $db_connection -> real_escape_string($_POST['pass']) . $hash_config['password_paper']);
>>>>>>> 26a8d8a... Extract hash configs in separate .ini file

$firstrow = $login_query->fetch(PDO::FETCH_ASSOC) or die("Not valid username or/and password.");

if (!$firstrow) {
=======
$login = mysqli_query($db_connection, $login_query);
if (!$login) {
	CloseCon($db_connection);
        die(mysqli_error($db_connection));
}
if(mysqli_num_rows($login) === 0) {
	CloseCon($db_connection);
>>>>>>> 92fa741... Add closing of connection to DB after query failure, as Daniel suggested
        header('Location: /login.php?warn=data');
        exit;
}

if (password_verify($password, $firstrow['password'])) {
        #logs the user in the system
        var_dump($firstrow);
        $_SESSION['user']  = $firstrow['user'];

        CloseCon($db_connection);
        header('Location: ../');
} else {
        die("Not valid username or/and password.");
        header('Location: /login.php?warn=data');
        exit;
}
