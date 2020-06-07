<?php
session_start();
$userTo = $_POST['userTo'];
if ($_SESSION['user'] === $userTo) {
	header('Location: /index.php?warn=self_share');
	exit;
}
?>
