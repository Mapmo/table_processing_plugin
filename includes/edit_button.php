<!-- Used in index.php to display a button Edit that leads to the visual.php page, where the user can edit the table -->
<form action="visual.php" method="post">
	<input name ="table" value="<?php echo "users/" . $file['owner'] . '/uploads/' . $file['name']; ?>" hidden />
	<input name ="write" value="<?php echo $file['write']; ?>" hidden />
	<?php
	echo $file['owner'] . ': ' . $file['name'] . ' - ';

	switch($file['write']) {
		case 0:
		echo "readony";
		break;
		case 1:
		echo "writeable";
		break;
		default:
		echo "Corrupted";
		break;
	}?>
	<input type="submit" value="Edit"/>
</form>

