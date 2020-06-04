<?php
session_start();
include "utils/form_validation.php";

if (ValidateCaptcha()  === false) {
        header('Location: ../login_form.php?warn=captcha');
        exit;
}

include "db_connection.php";
$db_connection = OpenCon();

$hash_config = parse_ini_file("../configs/hash.ini");

$user = hash($hash_config['hash_algorithm'], htmlentities($_POST['user']) . $hash_config['username_pepper']);
$password = hash($hash_config['hash_algorithm'], htmlentities($_POST['pass']) . $hash_config['password_pepper']);

$login_query = $db_connection->prepare("SELECT * FROM users WHERE user = :user");

$login_query->bindParam(':user', $user);

$result = $login_query->execute() or die("Failed to query from DB!");

$firstrow = $login_query->fetch(PDO::FETCH_ASSOC) or die("Not valid username or/and password.");

if (!$firstrow) {
        header('Location: ../login_form.php?warn=data');
        exit;
}

if ($password === $firstrow['password']) {
        #logs the user in the system
        var_dump($firstrow);
        $_SESSION['user']  = $firstrow['user'];

        CloseCon($db_connection);
        header('Location: ../');
} else {
        die("Not valid username or/and password.");
        header('Location: ../login_form.php?warn=data');
        exit;
}
