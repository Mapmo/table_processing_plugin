<?php
if(! isset($_GET['table'])) {
	include "includes/ParseFile.php";
}

echo '<form>';
	echo '<label for="cars">Choose a car:</label>';
	echo '<select id="table" name="table">';
		foreach (array_keys($xlsx) as $r) {
			$tmp = $r;
			$pattern = "/^[0-9]*\.[0-9]*-/";
			$replacement = "";
			$realFile = preg_replace($pattern, $replacement, $tmp);
			echo '<option value="'.$r.'">'.$realFile.'</option>';
		}
	echo '</select>';
	echo '<input type="submit">';
echo '</form>';

?>
