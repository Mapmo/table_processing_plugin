<?php
function ValidateCaptcha() {
	if((isset($_SESSION['captcha']) && isset($_POST['captcha'])) === false) {
		die("You don't belong to the ValidateCaptcha function");
	}

	return $_SESSION['captcha'] === $_POST['captcha'];
}

function ValidatePasswordRetype() {
	if((isset($_POST['pass']) && isset($_POST['pass2'])) === false) {
		die("You don't belong to function ValidatePasswordRetype");
	}
	
	return $_POST['pass'] === $_POST['pass2'];
}
?>
