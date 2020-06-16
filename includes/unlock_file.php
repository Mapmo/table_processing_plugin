<?php
    #Removes the lockfile, thus unlocking the file for editting by others
    if(isset($_POST['lock']) && $_POST['lock'] !== ".lock") {
        if (basename($_SERVER['PHP_SELF']) == "index.php") {
			unlink($_POST['lock']);
		} else { 
			unlink('../' . $_POST['lock']);
		}
    }
?>
