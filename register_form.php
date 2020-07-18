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
                        case 'retype':
                                echo '<h2 class="warn">Passwords do not match</h2>';
                                break;
                        case 'taken':
                                echo '<h2 class="warn">Name already taken</h2>';
                                break;
                }
        }
        ?>
        <div class="form_holder">
                <form action="includes/register.php" method="POST">
                        User: <input type="text" name="user" required /><br />
                        Password: <input type="password" name="pass" required /><br />
                        Retype password: <input type="password" name="pass2" required /><br />
                        <img src="includes/captcha.php" alt="security code" /><br />
                        Security code: <input type="text" name="captcha" required /><br />
                        <input class="btn orange" type="submit" name="submit" value="Register" />
                </form>
        </div>

        <footer>
                <div class="footer">
                        <span>Created by Mapmo, Tantanita & Dannyboy</span>
                </div>
        </footer>
</body>

</html>