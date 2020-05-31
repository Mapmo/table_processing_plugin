<?php
session_start();
include "utils/form_validation.php";

if((ValidateCaptcha() && ValidatePasswordRetype()) === true) {
	echo "Success";
} else {
	echo "Failure";
}

?>
