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
    	case "no_files_to_upload":
      		echo "No files were selected to be uploaded.";
      		break;
		case "permissions":
			echo "Could not share/upload with the target due to technical issues error 403. CONTACT ADMIN ASAP!!! ERROR 403";
			break;
	}
	echo "</h3>";
}
?>
