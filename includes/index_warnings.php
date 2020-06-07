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
	}
	echo "</h3>";
}
?>
