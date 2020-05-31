<!DOCTYPE HTML>
<html>
<head>
        <meta charset="utf-8" />
</head>
<body>
        <form action="includes/login.php" method="POST">
                User: <input type="text" name="user" /><br />
                Password: <input type="password" name="pass" /><br />
                <img src="includes/captcha.php" alt="security code" /><br />
                Security code: <input type="text" name="captcha" /><br />
                <input type="submit" name="submit" value="Login" />
        </form>
</body>
</html>
