<!DOCTYPE HTML>
<html>
<head>
        <meta charset="utf-8" />
</head>
<body>
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
