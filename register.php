<!DOCTYPE HTML>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="includes/css/main.css">
</head>
<body>
<?php
if (isset($_GET['warn'])) {
        switch ($_GET['warn']) {
                case 'captcha':
                        echo '<h2 class="warn">Wrong captcha</h2>';
                        break;
		case 'retype':
			echo '<h2 class="warn">Passwords do not match</h2>';
			break;
        }
}
?>
        <form action="includes/register.php" method="POST">
                User: <input type="text" name="user" /><br />
                Password: <input type="password" name="pass" /><br />
                Retype password: <input type="password" name="pass2" /><br />
                <img src="includes/captcha.php" alt="security code" /><br />
                Security code: <input type="text" name="captcha" /><br />
                <input type="submit" name="submit" value="Register" />
        </form>
</body>
</html>
