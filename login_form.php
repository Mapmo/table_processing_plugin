<!DOCTYPE HTML>
<html>

<head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="includes/css/main.css">
        <link rel="stylesheet" href="includes/css/buttons.css">
</head>

<body>
        <header>
                <div class="header">
                        <span class="logo"><img src="./includes/img/pptbl14.png" alt="Logo" height="100" /></span>
                        <span class="titleName">pptbl14</span>
                </div>
        </header>
        <?php
        if (isset($_GET['warn'])) {
                switch ($_GET['warn']) {
                        case 'captcha':
                                echo '<h2 class="warn">Wrong captcha</h2>';
                                break;
                        case 'data':
                                echo '<h2 class="warn">Wrong username/password</h2>';
                                break;
                }
        }
        ?>
        <div class="form_holder">
                <form action="includes/login.php" method="POST">
                        User: <input type="text" name="user" required /><br />
                        Password: <input type="password" name="pass" required /><br />
                        <img src="includes/captcha.php" alt="security code" /><br />
                        Security code: <input type="text" name="captcha" required /><br />
                        <input class="btn green" type="submit" name="submit" value="Login" />
                </form>
        </div>

        <footer>
                <div class="footer">
                        <span>Created by Mapmo, Tantanita & Dannyboy</span>
                </div>
        </footer>
</body>

</html>