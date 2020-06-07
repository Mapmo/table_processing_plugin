<?php
#Warning message when the user attemts to do something wrong
if(isset($_GET['ok'])) {
?>
<h3 class="ok">
<?php
	switch($_GET['ok']) {
		case "share":
			echo "Shared successfully";
			break;
	}
	echo "</h3>";
}
?>
