<?php
session_start();
include "utils/form_validation.php";

if(ValidateCaptcha()  === false) {
	header('Location: /login.php?warn=captcha');
}
?>
