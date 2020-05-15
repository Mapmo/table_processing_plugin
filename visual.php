<?php
	session_start();
	if(! isset($_GET['table'])) {
		include "includes/ParseFile.php";
	}

	echo '<form>';
		echo '<label for="table">Choose table to edit:</label>';
		echo '<select id="table" name="table">';
			foreach (array_keys($_SESSION) as $r) {
				echo '<option value="'.$_SESSION[$r].'">'.$r.'</option>';
			}
		echo '</select>';
		echo '<input type="submit">';
	echo '</form>';

	if(isset($_GET['table'])){
		include "includes/PrintTable.php";
	}

