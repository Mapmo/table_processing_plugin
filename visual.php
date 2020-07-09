<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <title>Table Processing Plugin</title>
    <?php
    include "includes/utils/utils.php";
    $fileLockTimeout = parse_ini_file("configs/timeouts.ini")["file_lock_timeout"];
    if ($_POST['write'] === "1") { ?>
        <script src="includes/js/update.js"></script>
        <script type="text/javascript">
            setFileLockTimeoutSec(<?php echo $fileLockTimeout ?>)
        </script>
    <?php
    } ?>
    <script defer src="includes/js/beautify.js"></script>
    <script defer src="includes/js/cell_locking.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/css/format.css">
</head>

<body onload="return getJson()">
    <?php
    $uploadedFileName = $_POST['table'];
    $lockFile = $uploadedFileName . ".lock"; #the lock file that serves as a mutex
    $locker = locked($lockFile, $fileLockTimeout);
    if ($locker !== $_SESSION['user']) {
        header('Location: ./index.php?warn=locked&locker=' . $locker);
        exit;
    }
    ?>
    <!-- Logout -->
    <form action="includes/logout.php" onsubmit="return check()" method="post">
        <input name="lock" value="<?php echo $lockFile ?>" hidden />
        <input type="submit" value="Logout">
    </form>

    <!-- Go Back form -->
    <form action="index.php" onsubmit="return check()" method="post">
        <input name="lock" value="<?php echo $lockFile ?>" hidden />
        <input type="submit" value="Back to home">
    </form>

    <?php

    if (isset($_POST['table']) === false) {
        exit;
    }

    ?>

    <!-- Form to choose a phrase to search for in the table -->
    <form onsubmit="return check()" method="post">
        <label for="search">Choose value to search: </label>
        <input type="text" id="search" name="search" value="<?php if (isset($_POST['search'])) {
                                                                echo $_POST['search'];
                                                            } ?>" />
        <input type="text" id="table" name="table" value="<?php echo $uploadedFileName; ?>" hidden />
        <input type="text" name="write" value="<?php echo $_POST['write']; ?>" hidden />
        <input type="text" name="owner" value="<?php echo $_POST['owner']; ?>" hidden />
        <input id="searchButton" type="submit" value="Search" />
    </form>

    <br>

    <?php
    if ($_POST['write'] === "1") {
    ?>
        <div>
            <button id="boldButton" onclick="toggleBoldStyle()"><b>B</b></button>
            <button id="italicButton" onclick="toggleItalicStyle()"><i>I</i></button>
            <button id="underlineButton" onclick="toggleUnderlineStyle()"><u>U</u></button>

            <?php
            if ($_POST['owner'] == $_SESSION['user']) {
            ?>
                <button id="lockCell" onclick="toggleLockingOfCell()">Lock/Unlock Cell</button>
                <button id="lockRow" onclick="toggleLockingOfRow()">Lock/Unlock Row</button>
                <button id="lockCol" onclick="toggleLockingOfCol()">Lock/Unlock Column</button>
        <?php }
        } ?>

        <input id="rowToFormat" type="hidden" />
        <input id="colToFormat" type="hidden" />
        <input id="owner" value=<?php echo $_POST['owner'] ?> type="hidden" />
        <input id="user" value=<?php echo $_SESSION['user'] ?> type="hidden" />
        </div>

        <?php include "includes/print_table.php"; ?>

        <!-- Form to chooses how to save the table -->
        <form action="includes/streamfile.php" onsubmit="return check()">
            <label for="table">Choose a name for the exported file:</label>
            <input type="text" name="fileТoSave" value="<?php echo $uploadedFileName ?>" hidden />
            <input type="text" name="exportFilename" value="<?php echo pathinfo($uploadedFileName, PATHINFO_FILENAME) ?>" required />
            <select name="write">
                <?php
                $fileExportTypes = parse_ini_file("configs/exporting.ini")["extensions"];
                for ($i=0;$i<sizeof($fileExportTypes);$i+=1) {
                    ?>
                        <option value="<?php echo $i ?>"><?php echo ".$fileExportTypes[$i]" ?></option>
                    <?php
                }
                ?>
            </select>
            <input type="submit" value="Save as">
        </form>
</body>

</html>
