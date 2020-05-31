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
	}
}
?>
        <form action="includes/login.php" method="POST">
                User: <input type="text" name="user" /><br />
                Password: <input type="password" name="pass" /><br />
                <img src="includes/captcha.php" alt="security code" /><br />
                Security code: <input type="text" name="captcha" /><br />
                <input type="submit" name="submit" value="Login" />
        </form>
</body>
</html>
