<?php
session_start();
include "utils/form_validation.php";

if(ValidateCaptcha() === false) {
       	header('Location: /register.php?warn=captcha');
}

if(ValidatePasswordRetype() === false) {
        header('Location: /register.php?warn=retype');
}
?>
