<?php
#Warning message when the user attemts to do something wrong
if(isset($_GET['warn'])) {
?>
<h3 class="warn">
<?php
	switch($_GET['warn']) {
		case "self_share":
			echo "Cannot share with yourself";
			break;
		case "unknown":
			echo "Could not find user";
			break;
		case "locked":
			echo "Locked by user " . $_GET['locker'];
			break;
		case "shared_file_exists":
            echo "The selected file is already shared with the user";
            break;
	}
	echo "</h3>";
}
?>
